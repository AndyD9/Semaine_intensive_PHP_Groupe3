
<?php
session_start();
$con  = mysqli_connect("localhost","root","root","g3");
if (!$con){
    die("Connection Failed : " . mysqli_connect_errno());
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <title>RANDOM IMG</title>
</head>
<body>
<?php
$email = $password = $error = "";
$errorflag = false;

$erroremail = "<h3 class='erroremail'>Email Required...!</h3>";
$errorpassword = "<h3 class='errorpassword'>Password Required...!</h3>";

if (isset($_POST["submit"])){
    if (empty($_POST["email"])){
        echo $erroremail;
        $errorflag = false;
    }elseif (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        $erroremail = "<h3 class='erroremail'>Invalid Email...!</h3>";
        echo $erroremail;
        $errorflag = false;
    }else{
        $email = validation_input($_POST["email"]);
        $errorflag = true;
    }

    if (empty($_POST["password"])){
        echo $errorpassword;
        $errorflag = false;
    }else{

        $len = strlen($_POST["password"]);
        if ($len > 15 || $len < 3){
            $errorpassword = "<h3 class='errorpassword'>Password Must Between 3 to 15 Characters</h3>";
            echo $errorpassword;
            $errorflag= false;
        }else{
            $password = validation_input($_POST["password"]);
            $errorflag = true;
        }
    }


    if ($errorflag = true){

        $query = "SELECT * FROM users WHERE mail = '$_POST[email]' AND password = '$_POST[password]'";
        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_array($result);
        if ($row > 0){
            $_SESSION["user_id"] = $row["id"];
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/assets/HTML/mainPage.php';
            header('Location: '. $home_url);
        }else {
            $error = "Username or Password Not Match...!";

        }

    }



}


function validation_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>
  <div class="loginPage-container">
    <div class="login-container">
        <form action="login.php" method="post">
      <div class="login-logo">

      </div>
        <div class="login-title">
          <h2>Welcome to Mynd</h2>
        </div>
        <div class="login-email">
          <input type="email" name="email" placeholder="E-mail">
        </div>
        <div class="login-password">
          <input type="password" name="password" placeholder="Password">
        </div>
        <div class="login-btn">
            <input type="submit" id="sub" name="submit" value="Sign In">
        </div>
        <span class="messageError" style="color: red"><?php echo $error; ?></span>
        <div class="login-other">
          <p>Or</p>
        </div>
        <div class="login-facebook">
          <div class="login-facebook-img">
          <img src="assets/img/facebook.png" alt="">
        </div>
          <a href="#">Continue with facebook</a>
        </div>
        <div class="login-google">
          <div class="login-google-img">
            <img src="assets/img/Google.png" alt="">
          </div>
          <a href="#">Continue with google</a>
        </div>
        <div class="login-signUp">
          <h3>Sign up</h3>
        </div>
        </form>
    </div>
  </div>
  <div class="signUp-overlay">
    <div class="signUp-container">
        <div class="signUp-title">
          <h2>SignUp</h2>
        </div>
        <div class="signUp-name">
          <h3>Enter your name</h3>
          <input type="text" placeholder="Name" required>
        </div>
        <div class="signUp-lastName">
          <h3>Enter your lastname</h3>
          <input type="text" placeholder="Lastname" required>
        </div>
        <div class="signUp-email">
          <h3>enter your emaail</h3>
          <input type="email" placeholder="example@email.com" required>
        </div>
        <div class="signUp-submit">
          <input type="submit" value="submit">
      </div>

    </div>
  </div>

  <script src="assets/js/main.js" charset="utf-8"></script>
</body>
</html>
