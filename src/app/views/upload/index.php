<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Course Upload</title>
        <link rel="stylesheet" href="assets/css/public/upload-style.css">
        <link rel="stylesheet" href="assets/css/public/flash-message-style.css">
    </head>

    <body>
        <?php
        use app\utils\FlashMessage;
        $flashMessage = new FlashMessage();
        $flashMessage->displayFlashMessage();
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
        <script src="assets/js/flashMessage.js"></script>
    </body>

</html>