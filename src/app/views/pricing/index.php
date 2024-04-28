<?php 
  use app\components\public\PricingSection;
  use app\core\database\mysql\MySqlManager;
  use app\utils\PublicUI;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pricing</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="assets/js/script.js"></script>
  </head>
  <body>

    <header>
        <?php 
            PublicUI::renderHeader();
        ?>
    </header>

    <h1 class="course-heading-title pricing">Find a plan that fits your goals</h1>
    
    <section class="pricing-section">
        <?php 
            $pricingSection = new PricingSection(MySqlManager::getConnection());
            $pricingSection->displayPricePlans($pricingSection->getPricePlans());
        ?>
    </section>

      <h1 class="course-heading-title questions-heading">Frequently asked questions</h1>

        <div class="accordion-body">
          <div class="accordion">
            <h1>General</h1>
             
              <div class="accordion-container">
                <div class="label">What's the difference between Basic, Plus, and Pro?</div>
                <div class="content">The Basic plan gives you access to free courses and the ability to start some more advanced courses.<br><br>
                  Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Pro is for those looking to start or advance their career. In addition to all the features from Basic and Plus, Pro includes career paths, interview prep skill paths, code challenges, and career services.<br><br>Pro learners can also earn professional certifications in select career paths. To earn a professional certification, you need to pass a series of exams. Exams consist of multiple choice and coding questions. Professional certifications are currently available for Full-Stack Engineer, Front-End Engineer, Back-End Engineer, Data Scientist: Machine Learning, Data Scientist: Analytics, and Computer Science.                 
                </div>
              </div>
               
              <div class="accordion-container">
                <div class="label">Do I need to know how to code before signing up?</div>
                <div class="content">The Basic plan gives you access to free courses and the ability to start some more advanced courses.<br><br>
                  Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Pro is for those looking to start or advance their career. In addition to all the features from Basic and Plus, Pro includes career paths, interview prep skill paths, code challenges, and career services.<br><br>Pro learners can also earn professional certifications in select career paths. To earn a professional certification, you need to pass a series of exams. Exams consist of multiple choice and coding questions. Professional certifications are currently available for Full-Stack Engineer, Front-End Engineer, Back-End Engineer, Data Scientist: Machine Learning, Data Scientist: Analytics, and Computer Science.                 
                </div>
              </div>
               
              <div class="accordion-container">
                <div class="label">What are skill paths and career paths?</div>
                <div class="content">The Basic plan gives you access to free courses and the ability to start some more advanced courses.<br><br>
                  Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Pro is for those looking to start or advance their career. In addition to all the features from Basic and Plus, Pro includes career paths, interview prep skill paths, code challenges, and career services.<br><br>Pro learners can also earn professional certifications in select career paths. To earn a professional certification, you need to pass a series of exams. Exams consist of multiple choice and coding questions. Professional certifications are currently available for Full-Stack Engineer, Front-End Engineer, Back-End Engineer, Data Scientist: Machine Learning, Data Scientist: Analytics, and Computer Science.                 
                </div>
              </div>
               
              <div class="accordion-container">
                <div class="label">What's the difference between a certificate of completion and a professional certification?</div>
                <div class="content">The Basic plan gives you access to free courses and the ability to start some more advanced courses.<br><br>
                  Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Pro is for those looking to start or advance their career. In addition to all the features from Basic and Plus, Pro includes career paths, interview prep skill paths, code challenges, and career services.<br><br>Pro learners can also earn professional certifications in select career paths. To earn a professional certification, you need to pass a series of exams. Exams consist of multiple choice and coding questions. Professional certifications are currently available for Full-Stack Engineer, Front-End Engineer, Back-End Engineer, Data Scientist: Machine Learning, Data Scientist: Analytics, and Computer Science.                 
                </div>
              </div>
               
              <div class="accordion-container">
                <div class="label">Do you offer a student discount?</div>
                <div class="content">The Basic plan gives you access to free courses and the ability to start some more advanced courses.<br><br>
                  Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Both Plus and Pro include everything in Basic, plus extra content and features like real-world projects, guided paths, and quizzes and practice to test your skills as you learn.<br><br>Pro is for those looking to start or advance their career. In addition to all the features from Basic and Plus, Pro includes career paths, interview prep skill paths, code challenges, and career services.<br><br>Pro learners can also earn professional certifications in select career paths. To earn a professional certification, you need to pass a series of exams. Exams consist of multiple choice and coding questions. Professional certifications are currently available for Full-Stack Engineer, Front-End Engineer, Back-End Engineer, Data Scientist: Machine Learning, Data Scientist: Analytics, and Computer Science.                 
                </div>
              </div>       
          </div>
        </div>


        <footer>
            <?php 
                PublicUI::renderFooter();
            ?>
        </footer>

  </body>
</html>
