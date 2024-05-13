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
    <title>Login</title>
</head>
<body id="loginBody">
      <a class="header-logo" href="https://codecademyre.com">
        <img src="assets/logo/logoBlue.png" alt="Logo" class="logo">
      </a>
      <?php
        $flashMessage = new FlashMessage();
        $flashMessage->setPageType('login');
        $flashMessage->displayErrorMessage();
        $flashMessage->displaySuccessMessage();

        Session::end();
      ?>
      <div class="auth-form">
        <form id="loginForm" method="post">
            <h1>Log in to <a href="https://codecademyre.com">Codecademy</a></h1>
            <div class="form-group">
              <label for="username_or_email">Email or Username</label>
              <input type="text" id="username_or_email" name="username_or_email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="password-input-box">
                <input class="password-input" type="password" id="password" name="password" required>
                <i class="fas fa-eye show-password"></i>
              </div>
            </div>
            <a class="reset-link" href="https://codecademyre.com">I forgot my password</a>
            <div class="form-group">
                <button type="submit" id="loginButton">Login</button>
            </div>
            <h2>Or log in using:</h2>
            <div class="social-buttons">
              <img src="assets/icon/icons8-google-48.png" href="#">
              <img src="assets/icon/icons8-facebook-48.png" href="#">
              <img src="assets/icon/icons8-linkedin-48.png" href="#">
              <img src="assets/icon/icons8-github-48.png" href="#">
              <img src="assets/icon/icons8-stack-overflow-48.png" href="#">
            </div>
            <div class="auth-section">
              <p>Not a member yet?</p>
              <a href="https://codecademyre.com/signup">Sign up for free</a>
            </div>
        </form>
    </div>  

    <script src="assets/js/auth.js"></script>
</body>
</html>