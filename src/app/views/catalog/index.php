<?php
use app\utils\CourseUtil;
use app\core\database\mysql\MySqlManager;
use app\utils\PublicUI;

$CourseUtil = new CourseUtil(MySqlManager::getConnection());
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Catalog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="assets/js/catalog.js"></script>
  </head>

  <body>
    <header>
      <?php
      PublicUI::renderHeader();
      ?>
    </header>
    <div class="catalog-section">
      <div class="filter-sidebar">
        <h2>
          <i class="fa-solid fa-filter"></i>
          Filter
          <span onclick="clearFilters()">Clear filters</span>
        </h2>

        <!-- Filter by Level -->
        <div class="filter-section">
          <label>Level:</label>
          <div class="checkbox-wrapper">
            <div class="custom-checkbox" data-filter="level" data-value="beginner"></div>
            <span>Beginner</span>
          </div>
          <div class="checkbox-wrapper">
            <div class="custom-checkbox" data-filter="level" data-value="intermediate"></div>
            <span>Intermediate</span>
          </div>
          <div class="checkbox-wrapper">
            <div class="custom-checkbox" data-filter="level" data-value="advanced"></div>
            <span>Advanced</span>
          </div>
        </div>

        <!-- Filter by Price -->
        <div class="filter-section">
          <label>Price:</label>
          <div class="checkbox-wrapper">
            <div class="custom-checkbox" data-filter="price" data-value="free"></div>
            <span>Free</span>
          </div>
          <div class="checkbox-wrapper">
            <div class="custom-checkbox" data-filter="price" data-value="paid"></div>
            <span>Paid</span>
          </div>
        </div>

        <!-- Filter by Lessons to Complete -->
        <div class="filter-section">
          <label>Lessons to Complete:</label>
          <div class="radio-wrapper">
            <input type="radio" name="lessons" id="less_than_5" data-value="less_than_5">
            <label for="less_than_5">Less than 5 lessons</label>
          </div>
          <div class="radio-wrapper">
            <input type="radio" name="lessons" id="5_to_10" data-value="5_to_10">
            <label for="5_to_10">5-10 lessons</label>
          </div>
          <div class="radio-wrapper">
            <input type="radio" name="lessons" id="10_to_20" data-value="10_to_20">
            <label for="10_to_20">10-20 lessons</label>
          </div>
          <div class="radio-wrapper">
            <input type="radio" name="lessons" id="20_to_60" data-value="20_to_60">
            <label for="20_to_60">20-60 lessons</label>
          </div>
          <div class="radio-wrapper">
            <input type="radio" name="lessons" id="60_plus" data-value="60_plus">
            <label for="60_plus">60+ lessons</label>
          </div>
        </div>

        <!-- Apply Filter Button -->
        <button class="apply-btn" onclick="applyFilters()">Apply Filters</button>
      </div>

      <!-- Displayed Courses Container -->
      <div class="courses-container">

      </div>
    </div>

    <footer>
      <?php
      PublicUI::renderFooter();
      ?>
    </footer>

  </body>

</html>