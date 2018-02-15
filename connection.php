<?php
try {
  $conn = new PDO('mysql:dbname=g3;host=localhost', 'root', 'siPHP3MR3');
} catch (PDOException $exception) {
  die($exception->getMessage());
}
?>
