<?php
if (isset($_GET['registration'])) {
  echo "<h1 class='displayErrorMsg'>This username/mail already exists!</h1>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styleLogin.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <title>JustPix - Register</title>
</head>
<body>
  <div class="registerPage-container">
    <div class="register-container">
      <div class="register-title">
      <h1>Register</h1>
    </div>
      <form action="doRegister.php" method="post">
        <div class="register-username">
        <input type="text" id="username" name="username" placeholder="Username"><br>
      </div>
      <div class="register-password">
        <input type="password" id="password" name="password" placeholder="Password"><br>
      </div>
      <div class="register-mail">
        <input type="email" id="mail" name="mail" placeholder="Mail"><br>
      </div>
      <div class="register-btn">
        <input type="submit" name="register" value="Register"></button>
      </div>
      </form>
    </div>
</div>
</body>
</html>
