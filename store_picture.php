<?php
session_start();

if ($_FILES['picture']['error'] === UPLOAD_ERR_NO_FILE
|| empty($_POST['title'])) {
  header('Location: home.php');
  exit;
}

echo !isset($_POST['title']);

require_once 'connection.php';

$picture=$_FILES['picture']['name'];

$folder='pictures/';

move_uploaded_file($_FILES['picture']['tmp_name'], "$folder".$picture);

$request = "INSERT INTO
pictures (iduser, title, tags, favcount, folder, name)
VALUES
(:iduser, :title, :tags, :favcount, :folder, :name);";
$stmt = $conn->prepare($request);
$stmt->bindValue(':iduser', $_SESSION['iduser']);
$stmt->bindValue(':title', $_POST['title']);
$stmt->bindValue(':tags', $_POST['tags']);
$stmt->bindValue(':favcount', 0);
$stmt->bindValue(':folder', "$folder".$picture);
$stmt->bindValue(':name', $picture);
$stmt->execute();
header('Location: home.php');
?>
