<?php

use app\core\database\mysql\MySqlManager;
use app\utils\JWTManager;
use app\utils\Session;
use app\utils\FileUtils;
use app\exceptions\FileUploadException;

// TODO - Check if a course with the same title already exists

Session::start();

// Check and modify the php.ini

// $phpIniFile = php_ini_loaded_file();
// $uploadMaxFilesize = ini_get('upload_max_filesize');
// $postMaxSize = ini_get('post_max_size');
// $maxInputTime = ini_get('max_input_time');
// $maxExecutionTime = ini_get('max_execution_time');

// echo "Loaded php.ini file: " . $phpIniFile . "<br>";
// echo "upload_max_filesize: " . $uploadMaxFilesize . "<br>";
// echo "post_max_size: " . $postMaxSize . "<br>";
// echo "max_input_time: " . $maxInputTime . "<br>";
// echo "max_execution_time: " . $maxExecutionTime . "<br>";
// exit;

// Restart php-fpm service after modified values

if (!isset($_FILES["courseFile"])) {
    $_SESSION['error_msg'] = "No video file was uploaded or an error occurred.";
    header("Location: https://codecademyre.com/upload");
    exit;
}

// Check for upload errors 
if ($_FILES["courseFile"]["error"] != 0) {
    $errorMessage = '';
    switch ($_FILES["courseFile"]["error"]) {
        case UPLOAD_ERR_INI_SIZE:
            $errorMessage .= FileUploadException::UPLOAD_ERR_INI_SIZE . "<br>";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $errorMessage .= FileUploadException::UPLOAD_ERR_FORM_SIZE . "<br>";
            break;
        case UPLOAD_ERR_PARTIAL:
            $errorMessage .= FileUploadException::UPLOAD_ERR_PARTIAL . "<br>";
            break;
        case UPLOAD_ERR_NO_FILE:
            $errorMessage .= FileUploadException::UPLOAD_ERR_NO_FILE . "<br>";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $errorMessage .= FileUploadException::UPLOAD_ERR_NO_TMP_DIR . "<br>";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $errorMessage .= FileUploadException::UPLOAD_ERR_CANT_WRITE . "<br>";
            break;
        case UPLOAD_ERR_EXTENSION:
            $errorMessage .= FileUploadException::UPLOAD_ERR_EXTENSION . "<br>";
            break;
        default:
            $errorMessage .= "Unknown upload error.<br>";
            break;
    }
    $_SESSION['error_msg'] = $errorMessage;
    header("Location: https://codecademyre.com/upload");
    exit;
}

// Define the uploaded file and its type
$uploadedFile = $_FILES["courseFile"];
$uploadedFileType = strtolower($uploadedFile["type"]);

// Define the allowed file types
$allowedTypes = array("video/mp4","video/mpeg");

// Check if the uploaded file type is in the allowed types
if (!in_array($uploadedFileType, $allowedTypes)) {
    $allowedTypesString = implode(", ", $allowedTypes);
    $_SESSION['error_msg'] = $uploadedFileType . " is not allowed.<br>" . "Only the following file types are allowed: $allowedTypesString";
    header("Location: https://codecademyre.com/upload");
    exit;
}

// Sanitize the uploaded file name
$uploadedFileName = FileUtils::sanitizeFileName($uploadedFile["name"]);

// Define the target directory and file location
$targetDirLocation = realpath(__DIR__ . '/../uploads/') . '/'; 
$targetFileLocation = $targetDirLocation . $uploadedFileName;

// Move file from temporary location to target location
if (!(move_uploaded_file($_FILES["courseFile"]["tmp_name"], $targetFileLocation))) {
    $lastError = error_get_last();
    $_SESSION['error_msg'] = "Error moving uploaded file: " . $lastError['message'];
    header("Location: https://codecademyre.com/upload");
    exit;
}

// Extract form data
$title = getFormData('courseName', 'string', '');
$description = getFormData('courseDescription', 'string', '');
$difficulty = getFormData('difficulty', 'string', '');
$lessonCount = getFormData('lessonCount', 'int', 0);
$price = getFormData('price', 'float', 0.00);
$courseType = getFormData('isPaid', 'bool', false) ? 'Paid' : 'Free';

// Extract username
$jwtManager = new JWTManager();
$token = $_COOKIE['jwtToken'];
$username = $jwtManager->getUsername($token);

$result = MySqlManager::insertCourse(MySqlManager::getConnection(), $title, $description, $difficulty, $lessonCount, $price, $courseType, $uploadedFileName, $username);

if (isset($result['Success'])) {
    $_SESSION['success_msg'] = 'Your course was uploaded successfully';
    header("Location: https://codecademyre.com/upload");
    exit;
} 
elseif (isset($result['Error'])) {
    $_SESSION['error_msg'] = 'There was an error during the upload.' . $result['Error'];
    if (file_exists($targetFile)) {
        unlink($targetFile);
    }
    header("Location: https://codecademyre.com/upload");
    exit;
}
else{
    'There was an error during the upload.';
    header("Location: https://codecademyre.com/upload");
    exit;
}



// Helper methods
function getFormData($key, $type, $default = null) {
    if (!isset($_POST[$key])) {
        return $default;
    }

    $value = $_POST[$key];

    switch ($type) {
        case 'int':
            return is_numeric($value) ? intval($value) : $default;
        case 'float':
            $value = str_replace(',', '', $value);
            return is_numeric($value) ? floatval($value) : $default;
        case 'bool':
            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
        default:
            return htmlspecialchars(trim($value));
    }
}

     