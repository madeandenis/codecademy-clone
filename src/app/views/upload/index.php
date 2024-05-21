<?php
use app\utils\FlashMessage;
use app\utils\Session;
Session::start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Upload</title>
        <style>
            body {
                --dot-bg: #010813;
                --dot-color: whitesmoke;
                --dot-size: 0.6px;
                --dot-space: 25px;
                background:
                    linear-gradient(90deg, var(--dot-bg) calc(var(--dot-space) - var(--dot-size)), transparent 1%) center / var(--dot-space) var(--dot-space),
                    linear-gradient(var(--dot-bg) calc(var(--dot-space) - var(--dot-size)), transparent 1%) center / var(--dot-space) var(--dot-space),
                    var(--dot-color);
                font-family: Apercu, sans-serif;
            }

            .course-upload-container {
                background-color: #FFF0E5;
                color: #10162F;
                width: 80%;
                max-width: 700px;
                margin: 10vh auto;
                padding: 10px;
                border-radius: 5px;
            }

            .course-upload-container h2 {
                text-align: center;
                font-weight: 700;
                font-size: 35px;
                font-weight: bold;
                font-family: 'Poppins', sans-serif;
            }

            .course-upload-container .form-group {
                padding-left: 40px;
                padding-right: 40px;
                padding-bottom: 30px;
            }

            .course-upload-container label {
                font-size: 18px;
                font-weight: 700;
                display: block;
            }

            .course-upload-container input[type="text"],
            .course-upload-container textarea,
            .course-upload-container select {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 16px;
            }

            .form-group input[type="number"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 16px;
            }

            .form-group.checkbox {
                display: flex;
                align-items: center;
            }

            .form-group.checkbox label {
                display: flex;
                align-items: center;
            }

            .form-group.checkbox input[type="checkbox"] {
                margin-left: 10px;
            }

            .course-upload-container button[type="submit"] {
                width: 50%;
                background-color: #3A10E5;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 12px 20px;
                font-size: 16px;
                font-weight: 700;
                cursor: pointer;
                transition: background-color 0.3s ease-in-out;
                margin: 0 auto;
                margin-bottom: 20px;
                display: block;
            }

            .course-upload-container button[type="submit"]:hover {
                background-color: #2d0a9f;
            }

            .course-upload-container input[type="file"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 16px;
                background-color: #f9f9f9;
                cursor: pointer;
            }


            .course-upload-container input[type="file"]::-webkit-file-upload-button::before {
                content: 'Select File';
            }

            .course-upload-container input[type="file"]::-webkit-file-upload-button {
                visibility: hidden;
            }

            .course-upload-container input[type="file"]::before {
                content: 'No file chosen';
                display: inline-block;
                padding: 10px 20px;
                border-radius: 5px;
                border: 1px solid #ccc;
                background-color: #3A10E5;
                color: whitesmoke;
                font-weight: 700;
                cursor: pointer;
            }

            .error-container,
            .success-container {
                position: relative;
                display: inline-block;
                left: 50%;
                transform: translate(-50%, 50%);
                width: 350px;
                padding: 15px;
                justify-content: center;
                flex-direction: column;
                background-color: white;
                border: 1px solid black;
            }

            #loginBody .error-container {
                transform: translate(-50%, 150%);
            }

            .error,
            .success {
                font-size: 14px;
                font-weight: 550;
                font-family: 'Apercu', sans-serif;
                list-style-type: none;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 15px;
            }

            .error span {
                position: absolute;
                font-size: 20px;
                color: #df6d6d;
                transform: translate(-120%, -7%);
                padding-right: 5px;
            }

            .success span {
                position: absolute;
                font-size: 16px;
                color: #539220;
                transform: translate(-120%, -7%);
                padding-right: 5px;
            }
        </style>
    </head>

    <body>
        <?php
        $flashMessage = new FlashMessage();
        $flashMessage->setPageType('upload');
        
        // Display Response instead of 2 methods
        $flashMessage->displayErrorMessage();
        $flashMessage->displaySuccessMessage();
        ?>
        <div class="course-upload-container">
            <h2>Upload Your Course</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="courseName">Course Name:</label><br>
                    <input type="text" id="courseName" name="courseName">
                </div>

                <div class="form-group">
                    <label for="courseDescription">Course Description:</label><br>
                    <textarea id="courseDescription" name="courseDescription" rows="4" cols="50"></textarea>
                </div>

                <div class="form-group">
                    <label for="courseFile">Select Course File:</label><br>
                    <input type="file" id="courseFile" name="courseFile">
                </div>

                <div class="form-group">
                    <label for="difficulty">Difficulty:</label><br>
                    <select id="difficulty" name="difficulty">
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lessonCount">Lesson Count:</label><br>
                    <input type="number" id="lessonCount" name="lessonCount" min="1">
                </div>

                <div class="form-group checkbox">
                    <label for="isPaid">Is the Course Paid?</label>
                    <input type="checkbox" id="isPaid" name="isPaid">
                </div>

                <div id="priceContainer" style="display: none;">
                    <div class="form-group">
                        <label for="price">Price:</label><br>
                        <input type="number" id="price" name="price" step="0.01" min="0">
                    </div>
                </div>

                <button type="submit">Upload Course</button>
            </form>
        </div>
        <script>
            document.getElementById('isPaid').addEventListener('change', function () {
                var priceContainer = document.getElementById('priceContainer');
                if (this.checked) {
                    priceContainer.style.display = 'block';
                } else {
                    priceContainer.style.display = 'none';
                }
            });
        </script>
    </body>

</html>