<!DOCTYPE html>
<html>
  <head>
    <title>CodeCademyReplica</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="public/js/script.js"></script>
  </head>

  <body>
    <header>
      <nav>
        <div class="nav-left">
          <a href="http://localhost/demo/JavaCourseSite">
            <img src="public/logo/logoBlue.png" alt="Logo" class="logo" onmouseover="changeImage(this)" onmouseout="restoreImage(this)">
          </a>
          <!-- Dashboard access link - ADMIN Role -->
          <? #php require '../src/App/WebComponents/controlPanelLink.php' ?>
          <ul class="menu">
            <li><a href="http://localhost/demo/JavaCourseSite">Catalog</a></li>
            <li><a href="http://localhost/demo/JavaCourseSite">Resources</a></li>
            <li><a href="http://localhost/demo/JavaCourseSite/pricing">Pricing</a></li>
          </ul>
        </div>
        <div class="nav-right">
          <ul class="desktop-nav">
            <li><img src="public/icon/searchIcon.png" alt="searchIcon" class="searchIcon"></li>
            <li><a href="http://localhost/demo/JavaCourseSite/login" class="login">Log in</a></li>
            <li><a href="http://localhost/demo/JavaCourseSite/signup" class="signup" id="signUpIndex">Sign Up</a></li>
          </ul>
          <ul class="mobile-nav">
            <li><a href="http://localhost/demo/JavaCourseSite/login" class="login">Log in</a></li>
            <li><img src="public/icon/menuIcon.png" alt="menuIcon" class="menuIcon" onclick="openNav()"></li>
          </ul>        
        </div>
      </nav>
    </header>

    <div id="mobile-fullscrenMenu" class="overlay">
      <div class="overlay-header">
        <a href="http://localhost/demo/JavaCourseSite"><img src="public/logo/logoBlue.png" alt="Logo" class="logo" onmouseover="changeImage(this)" onmouseout="restoreImage(this)"></a>
        <a class="closebtn" onclick="closeNav()">&times;</a>
      </div>
      <form id="searchBox">
        <img src="public/icon/searchIcon.png">
        <input type="text" name="search" placeholder="Search our catalog">
      </form>
      <div class="overlay-content">
        <a href="http://localhost/demo/JavaCourseSite">Catalog</a>
        <a href="http://localhost/demo/JavaCourseSite">Resources</a>
        <a href="http://localhost/demo/JavaCourseSite/pricing">Pricing</a>
        <a href="http://localhost/demo/JavaCourseSite/quiz">Take our quiz</a>
      </div>
      <div class="hline"></div>
      <div class="overlay-login">
          <a href="http://localhost/demo/JavaCourseSite/signup" class="signup"  onclick="closeNav()">Sign Up</a>
          <a href="http://localhost/demo/JavaCourseSite/login" class="signup"  onclick="closeNav()">Log in</a>
      </div>
    </div>

    <section class="hero-section" id="signUP">
      <img src="public/images/heroImg.jpg" class="heroImage" alt="hero-image">
      <div class="right-side">
        <div class="hero-content">
          <h1>Millions are learning to code for free on Codecademy. Join us!</h1>
          <!-- Create a html view frame -->
        </div>
      </div>
    </section>  
      

    <div class="course-heading-title" id="courses">
      <p>Start Learning</p>
      <h1>Popular Courses</h1>
    </div>

    <section class="course-section">
      <div class="course-container">
        <div class="course-type">
          <p>Free course</p>
        </div>
        <div class="course-description">
          <h3>Intro to ChatGPT</h3>
          <p>Learn about ChatGPT, one of the most advanced AI systems available today, and dive into the world of Generative AI.</p>
        </div>
        <div class="dotted-line">.................................</div>
        <div class="course-subsol">
          <img src="public/icon/icons8-no-connection-24.png">
          <p><b>Beginner</b> friendly</p>
          <p><b>7</b> Lessons</p>
        </div>
      </div>

      <div class="course-container">
        <div class="course-type">
          <p>Free course</p>
        </div>
        <div class="course-description">
          <h3>Learn HTML</h3>
          <p>Start at the beginning by learning HTML basics — an important foundation for building and editing web pages.</p>
        </div>
        <div class="dotted-line">.................................</div>
        <div class="course-subsol">
          <img src="public/icon/icons8-no-connection-24.png">
          <p><b>Beginner</b> friendly</p>
          <p><b>6</b> Lessons</p>
        </div>
      </div>

      <div class="course-container">
        <div class="course-type">
          <p>Free course</p>
        </div>
        <div class="course-description">
          <h3>Learn JavaScript</h3>
          <p>Learn how to use JavaScript — a powerful and flexible programming language for adding website interactivity.</p>
        </div>
        <div class="dotted-line">.................................</div>
        <div class="course-subsol">
          <img src="public/icon/icons8-no-connection-24.png">
          <p><b>Beginner</b> friendly</p>
          <p><b>7</b> Lessons</p>
        </div>
      </div>
      
      <div class="course-container">
        <div class="course-type">
          <p>Free course</p>
        </div>
        <div class="course-description">
          <h3>Learn SQL</h3>
          <p>In this SQL course, you’ll learn how to manage large datasets and analyze real data using the standard data management language.</p>
        </div>
        <div class="dotted-line">.................................</div>
        <div class="course-subsol">
          <img src="public/icon/icons8-no-connection-24.png">
          <p><b>Beginner</b> friendly</p>
          <p><b>7</b> Lessons</p>
        </div>
      </div>
    </section>

    <div class="course-heading-title">  
        <button class="link-button">Explore Full Catalog</button>
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
        <a href="http://localhost/demo/JavaCourseSite/quiz"><button class="link-button">Take the quiz</button></a>
        </div>
      </div>
      <div class="right-side-quiz">
        <img src="public/svg/blueWindow.svg">
      </div>
    </section>

    <div class="stories-section">
      <div class="background-pattern"></div>
      <h2>Stories from real people</h2>
      <p id="antetP">Watch and read stories from the Codecademy community.</p>
      <div class="stories-container">
        <div class="story">
          <img src="public/images/person1.jpg" alt="learner portrait">
          <h3>Technical Analyst to Front-End Engineer in 6 Months </h3>
          <p>Cristina T., Front-End Engineer @ Grid Dynamics, Guadalajara</p>
        </div>
        <div class="story">
          <img src="public/images/person2.jpg" alt="learner portrait">
          <h3>Freelancer to Developing Apps for NASA</h3>
          <p>De'Shaun B., Associate Software Engineer, Winter Park</p>
        </div>
        <div class="story">
          <img src="public/images/person3.jpg" alt="learner portrait">
          <h3>Lessons from a Product Owner turned Engineer</h3>
          <p>Serena I., Software Developer @ Adidas, South Holland</p>
        </div>
        <div class="story">
          <img src="public/images/person4.jpg" alt="learner portrait">
          <h3>From Film to Full-Stack Engineer in 11 Months</h3>
          <p>Julia J., Ruby on Rails Developer, São Paulo</p>
        </div>
      </div>
    </div>

    <section class="business-section">
      <div class="left-side-business">
        <img src="public/logo/logoWhite.png">
        <div class="business-text">
          <h1>Level up your team's skills<h1>
        <br>
        <p>Give your team the knowledge, experience, and confidence they need to tackle any problem.</p>
        <button class="link-button">Explore business plans</button>
        </div>
      </div>
      <div class="right-side-business">
        <img src="public/svg/combSVG.svg">
      </div>
    </section>
    
    <section class="business-section signupReturn">
      <div class="right-side-business">
        <img src="public/images/signUpEnd.webp">
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
      <div class="footer-container">

        <div class="footer-column">
          <h4>Career building</h4>
          <ul>
            <li>Career paths</li>
            <li>Career services</li>
            <li>Interview prep</li>
            <li>Professional certification</li>
          </ul>
          <h4>Mobile</h4>
            <img src="public/icon/appStore.png">
            <img src="public/icon/googlePlay.png">
        </div>
        <div class="footer-column">
          <h4>Plans</h4>
          <ul>
            <li>Paid memberships</li>
            <li>For Students</li>
            <li>Business solutions</li>
          </ul>
          <h4>Community</h4>
          <ul>
            <li>Forums</li>
            <li>Chapters</li>
            <li>Events</li>
          </ul>
        </div>

        <div class="vertical-divider"></div>

        <div class="footer-column">
          <h4>Subjects</h4>
          <ul>
            <li>AI</li>
            <li>Cloud Computing</li>
            <li>Computer Science</li>
            <li>Cybersecurity</li>
            <li>Data Science</li>
            <li>Game Development</li>
            <li>Machine Learning</li>
            <li>Web Design</li>
            <li>Web Development</li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Languages</h4>
          <ul>
            <li>C / C++</li>
            <li>C#</li>
            <li>HTML & CSS</li>
            <li>JAVA</li>
            <li>JavaScript</li>
            <li>Kotlin</li>
            <li>PHP</li>
            <li>Python</li>
            <li>SQL</li>
          </ul>
        </div>
      </div>

      <div class="horizontal-divider"></div>

      <div class="footerPolicy">
        <ul>
            <li>Privacy policy</li>
            <li>|</li>
            <li>Cookie policy</li>
            <li>|</li>
            <li>Do Not Sell My Personal Information</li>
            <li>|</li>
            <li>Terms</li>
          </ul>
          <br> 
          <p>Made with  <span class="hearth">&#10084;</span> by Denis &copy; 2023</p>      
      </div>

    </footer>

  </body>
</html>
