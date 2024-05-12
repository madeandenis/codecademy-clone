<?php
  use app\utils\FlashMessage;
  use app\utils\Session;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Register</title>
</head>
<body>
  <a class="header-logo" href="http://codecademyre.com">
    <img src="assets/logo/logoBlue.png" alt="Logo" class="logo">
  </a>
  <?php
    $flashMessage = new FlashMessage();
    $flashMessage->setPageType('signup');
    $flashMessage->displayErrorMessage();
    $flashMessage->displaySuccessMessage();

    Session::end();
  ?>
  <div class="auth-form">
    <form id="signupForm" method="post">
        <h1>Get started for free</h1>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="password-input-box">
              <input class="password-input" type="password" id="password" name="password" required>
              <i class="fas fa-eye show-password"></i>
            </div>
        </div>
        <div class="password-checklist">
          <h4 class="checklist-title">Password should be</h4>
          <ul class="checklist">
              <li class="list-item">At least 8 character long</li>
              <li class="list-item">At least 1 number</li>
              <li class="list-item">At least 1 lowercase letter</li>
              <li class="list-item">At least 1 uppercase letter</li>
              <li class="list-item">At least 1 special character</li>
          </ul>
        </div>
        <div class="form-group">
            <button type="submit" id="signupButton">Signup</button>
        </div>
        <p>By signing up for Codecademy, you agree to Codecademy's <span class="policy">Terms of Service</span> &amp; <span class="policy">Privacy Policy</span>.</p>
        <h2>Or sign up using:</h2>
        <div class="social-buttons">
          <img src="assets/icon/icons8-google-48.png" href="#">
          <img src="assets/icon/icons8-facebook-48.png" href="#">
          <img src="assets/icon/icons8-linkedin-48.png" href="#">
          <img src="assets/icon/icons8-github-48.png" href="#">
          <img src="assets/icon/icons8-stack-overflow-48.png" href="#">
        </div>
        <div class="auth-section">
          <p>Already have an account?</p>
          <a href="http://codecademyre.com/login">Log in</a>
        </div>
    </form>
  </div>   
  
  <script src="assets/js/auth.js"></script>
</body>
</html>
