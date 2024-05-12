<?php

use app\core\database\mysql\MySqlManager;
use app\utils\JWTManager;
use app\utils\Session;

Session::start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if file was uploaded without errors
    if (isset($_FILES["courseFile"]) && $_FILES["courseFile"]["error"] == 0) {
        $targetDir = realpath(__DIR__ . '/../uploads/') . '/'; 
        $targetFile = $targetDir . basename($_FILES["courseFile"]["name"]);

        // Check file type to ensure it's a video file
        $allowedExtensions = array("mp4");
        $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error_msg'] = "Only MP4 file types are allowed, ";
            exit;
        }

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES["courseFile"]["tmp_name"], $targetFile)) {
            // Extract form data
            $title = $_POST["courseName"];
            $description = $_POST["courseDescription"];
            $difficulty = $_POST["difficulty"];
            $lessonCount = isset($_POST["lessonCount"]) && is_numeric($_POST["lessonCount"]) ? intval($_POST["lessonCount"]) : 0;
            $price = isset($_POST["price"]) && is_numeric($_POST["price"]) ? number_format(floatval(str_replace(',', '', $_POST["price"])), 2, '.', '') : '0.00';
            $courseType = isset($_POST["isPaid"]) ? "Paid" : "Free";

            $jwtManager = new JWTManager();
            $token = $token = $_COOKIE['jwtToken'];
            $username = $jwtManager->getUsername($token);

            $uploadedBy = $username;

            // Insert course data into db
            $result = MySqlManager::insertCourse(MySqlManager::getConnection(), $title, $description, $difficulty, $lessonCount, $price, $courseType, $_FILES["courseFile"]["name"], $uploadedBy);

            // Check is there was an error in the db insertion
            if (isset($result['Success'])) {
                $_SESSION['success_msg'] = 'Your course was uploaded successfully';
            } elseif (isset($result['Error'])) {
                $_SESSION['error_msg'] = 'There was an error during the upload.' . $result['Error'];
                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }
            }
        } else {
            $lastError = error_get_last();
            $_SESSION['error_msg'] = "Error moving uploaded file: " . $lastError['message'];
        }
    } else {
        $errorMessage = '';
        switch ($_FILES["courseFile"]["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                $errorMessage .= "The uploaded file exceeds the upload_max_filesize<br>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errorMessage .= "The uploaded file exceeds the MAX_FILE_SIZE directive specified in the form.<br>";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errorMessage .= "The uploaded file was only partially uploaded.<br>";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errorMessage .= "No file was uploaded.<br>";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errorMessage .= "Missing a temporary folder.<br>";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errorMessage .= "Failed to write file to disk.<br>";
                break;
            case UPLOAD_ERR_EXTENSION:
                $errorMessage .= "A PHP extension stopped the file upload.<br>";
                break;
            default:
                $errorMessage .= "Unknown upload error.<br>";
                break;
        }
        $_SESSION['error_msg'] = "No video file was uploaded or an error occurred.<br>" . $errorMessage;
    }
}

header("Location: http://codecademyre.com/upload");

exit;
