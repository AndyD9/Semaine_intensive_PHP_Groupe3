<?php
session_start();

require 'connection.php';

if(isset($_POST['login'])){
  $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
  $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

  $sql = "SELECT iduser, username, password FROM users WHERE username = :username";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':username', $username);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if($user === false || $username !== $user['username']){
    die(header('Location: loginForm.php?login=false'));
  } else{
    $validPassword = password_verify($passwordAttempt, $user['password']);

    if($validPassword){
      $_SESSION['iduser'] = $user['iduser'];
      $_SESSION['logged_in'] = time();

      header('Location: home.php');
      exit;
    } else{
      die(header('Location: loginForm.php?login=false'));
    }
  }
}
