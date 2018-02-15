<?php
session_start();

require_once "connection.php";

$requete = "UPDATE users SET mail = :mail WHERE iduser = :iduser;";

$stmt = $conn->prepare($requete);
$stmt->bindValue(':mail', $_POST['mail']);
$stmt->bindValue(':iduser', $_SESSION['iduser']);
$stmt->execute();
header('Location: home.php');
?>
