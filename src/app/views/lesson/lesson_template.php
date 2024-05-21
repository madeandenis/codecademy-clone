<?php
use app\utils\PublicUI;

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{TITLE}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../../../assets/css/public/lesson-style.css">
    </head>

    <body>
        <div class="course-container">
            <h1>{{LESSON}}<h2>
            <video controls width="800" height="500" autoplay muted>
                <source src="{{VIDEO_API}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </body>

</html>