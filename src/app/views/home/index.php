<?php 
  use app\utils\CourseUtil;
  use app\core\database\mysql\MySqlManager;
  use app\utils\PublicUI;
?>

<!DOCTYPE html>
<html>
  <head>
    <title>CodeCademyReplica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
    <script src="assets/js/utils.js"></script>
  </head>

  <body>
    <header>
      <?php 
        PublicUI::renderHeader();
      ?>
    </header>

    <section class="hero-section" id="signUP">
      <div class="hero-left-side">
        <h1>Millions are learning <br> to code for free on Codecademy. Join us!</h1>
        <img src="assets/images/heroImg.jpg" class="heroImage" alt="hero-image">
      </div>
      <div class="hero-right-side">
        <div class="hero-content">
          <div class="iframe-container">
            <iframe src="../signup#signupForm"></iframe>
          </div>
        </div>
      </div>
    </section>  
      

    <div class="course-heading-title" id="courses">
      <p>Start Learning</p>
      <h1>Popular Courses</h1>
    </div>

    <section class="course-section">
      <?php 
        $CourseUtil = new CourseUtil(MySqlManager::getConnection());
        $courses = $CourseUtil->getCoursesAsHtml($CourseUtil->getCourses(limit:8));
        foreach ($courses as $course) {
          echo $course;
        }
      ?>
    </section>

    <div class="course-heading-title">  
        <a href="https://codecademyre.com/catalog">
          <button class="link-button">Explore Full Catalog</button>
        </a>
    </div>

    <section class="join-section">
      <div class="join-big">
        <h1>Join in on something big</h1>
      </div>
      <div class="join-learners">
        <h1><span class="numbers">50M</span><br> Learners</h1>
        <h1><span class="numbers">190+</span><br> Countries</h1>
        <h1><span class="numbers">3.7B</span><br> Code submits</h1>
      </div>  
    </section>

    <section class="quiz-section">
      <div class="left-side-quiz">
        <div class="quiz-text">
          <h1>Not sure where to start?</h1>
        <br>
        <p>This short quiz will sort you out. Answer a few simple questions to get personal career advice and course recommendations.</p>
        <a href="https://codecademyre.com/quiz"><button class="link-button">Take the quiz</button></a>
        </div>
      </div>
      <div class="right-side-quiz">
        <img src="assets/svg/blueWindow.svg">
      </div>
    </section>

    <div class="stories-section">
      <div class="background-pattern"></div>
      <h2>Stories from real people</h2>
      <p id="antetP">Watch and read stories from the Codecademy community.</p>
      <div class="stories-container">
        <div class="story">
          <img src="assets/images/person1.jpg" alt="learner portrait">
          <h3>Technical Analyst to Front-End Engineer in 6 Months </h3>
          <p>Cristina T., Front-End Engineer @ Grid Dynamics, Guadalajara</p>
        </div>
        <div class="story">
          <img src="assets/images/person2.jpg" alt="learner portrait">
          <h3>Freelancer to Developing Apps for NASA</h3>
          <p>De'Shaun B., Associate Software Engineer, Winter Park</p>
        </div>
        <div class="story">
          <img src="assets/images/person3.jpg" alt="learner portrait">
          <h3>Lessons from a Product Owner turned Engineer</h3>
          <p>Serena I., Software Developer @ Adidas, South Holland</p>
        </div> 
        <div class="story">
          <img src="assets/images/person4.jpg" alt="learner portrait">
          <h3>From Film to Full-Stack Engineer in 11 Months</h3>
          <p>Julia J., Ruby on Rails Developer, São Paulo</p>
        </div>
      </div>
    </div>

    <section class="business-section">
      <div class="left-side-business">
        <img src="assets/logo/logoWhite.png">
        <div class="business-text">
          <h1>Level up your team's skills<h1>
        <br>
        <p>Give your team the knowledge, experience, and confidence they need to tackle any problem.</p>
        <button class="link-button">Explore business plans</button>
        </div>
      </div>
      <div class="right-side-business">
        <img src="assets/svg/combSVG.svg">
      </div>
    </section>
    
    <section class="business-section signupReturn">
      <div class="right-side-business">
        <img src="assets/images/signUpEnd.webp">
      </div>
      <div class="left-side-business">
        <div class="business-text">
          <h1>Start for free<h1>
        <br>
        <p>If you’ve made it this far, you must be at least a little curious. Sign up and take the first step toward your goals.</p>
         <a href="#signUP"><button class="link-button">Sign Up</button></a>
        </div>
      </div>
    </section>

    <footer>
      <?php 
        PublicUI::renderFooter();
      ?>
    </footer>

  </body>
</html>
