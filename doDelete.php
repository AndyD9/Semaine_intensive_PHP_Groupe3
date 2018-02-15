<?php
session_start();
if (!isset($_SESSION["iduser"])) {
  die(header('Location: loginForm.php'));
}

if(!isset($_GET['deletePicture'])) {
  die(header('Location: library.php'));
}

require_once "connection.php";

$requete = "DELETE FROM
pictures
WHERE
idpictures = :idpictures
AND
iduser = :iduser;";
$stmt = $conn->prepare($requete);
$stmt->bindValue(':idpictures', $_GET['deletePicture']);
$stmt->bindValue(':iduser', $_SESSION['iduser']);
$stmt->execute();
header('Location: library.php');
?>
