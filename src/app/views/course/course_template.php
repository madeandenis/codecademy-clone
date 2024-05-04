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
                font-family: Apercu, sans-serif;
                background-color: #FFF0E5;
                color: #10162F;
                width: 80%;
                max-width: 700px;
                margin: 10vh auto;
                padding: 30px;
                border-radius: 5px;
            }

            .course-title {
                width: 80%;
                font-weight: 700;
                font-size: 44px;
                font-weight: bold;
            }

            .course-description {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif, sans-serif;
                width: 80%;
                font-size: 20px;
                margin-top: 18px;
                padding-bottom: 50px;

            }

            .course-info {
                margin-top: 20px;
            }

            .course-info-item {
                font-size: 18px;
            }

            .course-info-item span {
                font-weight: 700;
                font-size: 21px;
            }

            .course-column-left {
                text-align: center;
                float: left;
                width: 50%;
            }

            .course-column-right {
                text-align: center;
                float: right;
                width: 50%;
            }

            .enroll-button-container {
                text-align: center;
            }

            .enroll-button {
                margin-top: 40px;
                background-color: #3A10E5;
                display: inline-block;
                padding: 10px 40px;
                color: white;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: opacity 0.3s ease-in-out;
            }

            .enroll-button:hover {
                opacity: 0.9;
            }
        </style>
    </head>

    <body>
        <div class="course-container">
            <h1 class="course-title">{{TITLE}}</h1>
            <p class="course-description">{{DESCRIPTION}}</p>
            <div class="course-info">
                <div class="course-column-left">
                    <div class="course-info-item">Skill level: <br><span>{{DIFFICULTY}}</span></div>
                </div>
                <div class="course-column-right">
                    <div class="course-info-item">Time to complete: <br><span>{{LESSON_COUNT}} lessons</span></div>
                </div>
                <div class="enroll-button-container">
                    <a onclick="submitEnrollment()" class="enroll-button">Enroll Now for {{PRICE}}</a>
                </div>
            </div>
        </div>
        <script>
            function submitEnrollment() {
                const currentURL = window.location.href;
                const matches = currentURL.match(/\d+$/);

                if (matches) {
                    const courseId = matches[0];
                    const params = { 'course_id': courseId };

                    const requestOptions = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(params)
                    };

                    fetch('https://codecademyre.com/enroll', requestOptions)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.login_request === true) {
                                window.location.href = "https://codecademyre.com/login";
                            } else {
                                const enrollBtn = document.querySelector('.enroll-button');
                                enrollBtn.textContent = data.response_msg;
                                enrollBtn.style.backgroundColor = '#010813';
                                enrollBtn.disabled = true;
                                setTimeout(() => {
                                    window.location.href = currentURL + '/lesson/1';;
                                }, 1000);
                            }
                        })
                        .catch(error => {
                            console.error('Fetch Error:', error);
                        });
                } else {
                    console.error('No matches found in the URL');
                }

            }
        </script>
    </body>

</html>