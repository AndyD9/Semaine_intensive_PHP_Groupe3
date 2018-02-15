<?php
session_start();

require_once 'connection.php';

if(isset($_POST['register'])){

  $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
  $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
  $mail = !empty($_POST['mail']) ? trim($_POST['mail']) : null;

  $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':username', $username);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['num'] > 0){
    die(header('Location: registerForm.php?registration=false'));
  }

  $sql = "SELECT COUNT(mail) AS num FROM users WHERE mail = :mail";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':mail', $mail);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if($row['num'] > 0){
    die(header('Location: registerForm.php?registration=false'));
  }

  $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));

  $sql = "INSERT INTO users (username, password, mail) VALUES (:username, :password, :mail)";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':username', $username);
  $stmt->bindValue(':password', $passwordHash);
  $stmt->bindValue(':mail', $mail);

  $result = $stmt->execute();

  if($result){
    echo 'Thank you for registering with our website.';
    header('Location: loginForm.php');
    exit;
  }
}
?>
