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
      <a class="header-logo" href="http://codecademyre.com:8080">
        <img src="assets/logo/logoBlue.png" alt="Logo" class="logo">
      </a>
      <?php
        session_start();

        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-container">';
            echo '<li class="success">' . '<span>&#10004;</span>' . $_SESSION['success_message'] . '</li>';
            echo '</div>';
            unset($_SESSION['success_message']);
            header("refresh:2;url=http://codecademyre.com:8080/home");
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-container">';
            echo '<li class="error">' . '<span>&times;</span>' . $_SESSION['error_message'] . '</li>';
            echo '</div>';
            unset($_SESSION['error_message']);
        }
      ?>
      <div class="auth-form">
        <form id="loginForm" method="post">
            <h1>Log in to <a href="http://codecademyre.com:8080">Codecademy</a></h1>
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
            <a class="reset-link" href="http://codecademyre.com:8080">I forgot my password</a>
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
              <a href="http://codecademyre.com:8080/signup">Sign up for free</a>
            </div>
        </form>
    </div>  

    <script src="assets/js/auth.js"></script>
</body>
</html>