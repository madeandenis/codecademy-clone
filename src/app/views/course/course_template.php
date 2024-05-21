<!DOCTYPE html>
<html lang="en">

    <head>
        <title>{{TITLE}}</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="../../../assets/css/public/course-style.css">
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
            function extractCourseId() {
                const currentURL = window.location.href;
                // Match the last set of digits
                const courseIdMatch = currentURL.match(/\d+$/);
                return courseIdMatch ? courseIdMatch[0] : null;
            }

            function submitEnrollment() {

                const courseId = extractCourseId();
                if (!courseId) {
                    console.error('No matches found in the URL');
                    return;
                }

                const params = { course_id: courseId };

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
                    .then(data => handleResponse(data))
                    .catch(error => {
                        console.error('Fetch Error:', error);
                    });

            }
            function handleResponse(data) {
                const enrollBtn = document.querySelector('.enroll-button');

                if (data.error === 'Authentication required') {
                    window.location.href = "https://codecademyre.com/login";
                } else if (data.error) {
                    enrollBtn.textContent = data.error;
                    enrollBtn.style.backgroundColor = '#010813';
                    enrollBtn.disabled = true;
                    setTimeout(() => {
                        location.reload(true);
                    }, 1000);
                } else {
                    enrollBtn.textContent = data.response_msg;
                    enrollBtn.style.backgroundColor = '#010813';
                    enrollBtn.disabled = true;
                    setTimeout(() => {
                        window.location.href = window.location.href + '/lesson/1';
                    }, 1000);
                }
            }
        </script>
    </body>

</html>