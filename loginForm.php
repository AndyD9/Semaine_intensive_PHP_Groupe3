<?php
session_start();
require_once 'connection.php';

if (isset($_GET['login'])) {
  echo "<h1 class='displayErrorMsg'>Incorrect username/password combination!</h1>";
}
if (isset($_SESSION['iduser'])) {
  header('Location: home.php');
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styleLogin.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <title>Just Pix - Login</title>
</head>
<body>
  <div class="loginPage-container">
    <div class="login-container">
      <form action="doLogin.php" method="post">
        <div class="login-logo">
        </div>
        <div class="login-title">
          <h2>Welcome to JustPix</h2>
        </div>
        <div class="login-username">
          <input type="text" name="username" placeholder="username">
        </div>
        <div class="login-password">
          <input type="password" name="password" placeholder="password">
        </div>
        <div class="login-btn">
          <input type="submit" name="login" value="Login">
        </div>
      </form>
      <div class="login-signUp">
        <a href="registerForm.php">SIGN UP</a>
      </div>
    </div>
  </div>
  <script src="js/main.js" charset="utf-8"></script>
</body>
</html>
