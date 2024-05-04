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
        <style>
            body {
                display: flex;
                justify-content: center;    
                --dot-bg: #010813;
                --dot-color: whitesmoke;
                --dot-size: 0.6px;
                --dot-space: 25px;
                background:
                    linear-gradient(90deg, var(--dot-bg) calc(var(--dot-space) - var(--dot-size)), transparent 1%) center / var(--dot-space) var(--dot-space),
                    linear-gradient(var(--dot-bg) calc(var(--dot-space) - var(--dot-size)), transparent 1%) center / var(--dot-space) var(--dot-space),
                    var(--dot-color);
            }

            .course-container {
                display: inline-block;
                justify-content: center;
                font-family: Apercu, sans-serif;
                background-color: #FDF0E5;
                color: #10162F;
                margin: 5vh auto;
                padding-left: 30px;
                padding-right: 30px;
                border-radius: 5px;
            }
        </style>
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