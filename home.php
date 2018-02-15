<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['iduser'])) {
  die(header('Location: loginForm.php'));
}

$requestPix = "SELECT * FROM pictures ORDER BY idpictures DESC;";
$stmt = $conn->prepare($requestPix);
$stmt->execute();

$requestUserData = "SELECT * FROM users WHERE iduser =".$_SESSION['iduser'].";";
$stmt2 = $conn->prepare($requestUserData);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC)
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/styleHome.css">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <title>JustPix - Home</title>
</head>
<body>
  <header>
    <div class="header-logoCcontainer">
      <img src="pictures/logojp.png" alt="logo" height="80px" width="80px" onclick="home()">
    </div>
    <div class="header-searchBar">
      <input type="search" placeholder="Search photos">
    </div>
    <div class="header-library">
      <a href="library.php" class="fas fa-folder" style="font-size:6vh;"></a>
    </div>
    <div class="header-upload">
      <i class="fas fa-upload" style="font-size: 6vh;"></i>
    </div>
    <div class="header-profilePicture">
      <img src="#" alt="">
      <div></div>
    </div>
  </header>
  <div class="main-container">
    <span></span>
    <h2>Trending</h2>
    <h2>New</h2>
    <span></span>
  </div>
  <?php while(false !== $row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
    <div class="img-container">
      <div class="img-150-300">
        <img src="<?=$row['folder']?>" alt="">
        <div class="imghover"></div>
      </div>
    </div>
  <?php endwhile;?>

  <div class="upload-overlay">
    <div class="upload-close-overlay">
      <i class="far fa-times-circle" style="font-size: 6vh;"></i>
    </div>
    <div class="upload-container">
      <form action="store_picture.php" method="post" enctype="multipart/form-data">
        <div class="upload-title">
          <label for="title">Title</label>
          <br>
          <input type="text" name="title">
        </div>
        <div class="upload-tags">
          <label for="tags">Tags</label>
          <br>
          <input type="text" name="tags">
        </div>
        <div class="upload-picture">
          <label for="picture">Upload a picture</label>
          <br>
          <input type="file" name="picture">
        </div>
        <div class="upload-submit">
          <input type="submit" value="Upload">
        </div>
      </form>
    </div>
  </div>

  <div class="profil-overlay">
    <div class="profil-container">
      <div class="profile-picture">
        <div class="aaa"></div>
        <!-- <img src="" alt=""> -->
        <p class="edit edit-profilePicture">edit</p>
      </div>
      <div class="profile-info-container">
        <div class="profile-close-overlay">
          <img src="pictures/cancel.png" alt="">
        </div>
        <div class="profil-name">
          <div class="profile-name-title">
            <h2>Username</h2>
          </div>
          <p><?=$row2['username']?></p>
        </div>
        <div class="profil-email">
          <form action="doUpdateMail.php" method="post" enctype="multipart/form-data">
            <h2>Mail</h2>
            <input type="email" name="mail" placeholder="<?=$row2['mail']?>">
            <input type="submit" name="Edit" value="Edit">
          </div>
          <div class="profil-logOut">
            <div class="profil-logOut-box">
              <a href="logout.php">LOGOUT</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    var uploadBtn = document.querySelector('.header-upload');
    var uploadOverlay = document.querySelector('.upload-overlay');
    var closeBtn = document.querySelector('.upload-close-overlay');
    var profilOverlay = document.querySelector('.profil-overlay');
    var profileCloseOverlay = document.querySelector('.profile-close-overlay');
    var profilePictureBtn = document.querySelector('.header-profilePicture');

    uploadBtn.addEventListener('click', function(){
      uploadOverlay.style.display = 'block';
    });

    window.addEventListener('keyup', function(event){
      if (event.keyCode === 27) {
        uploadOverlay.style.display = '';
      }
    });

    closeBtn.addEventListener('click', function(){
      uploadOverlay.style.display = '';
    });

    profilePictureBtn.addEventListener('click', function(){
      profilOverlay.style.display = 'block';
    });

    profileCloseOverlay.addEventListener('click', function(){
      profilOverlay.style.display = '';
    });

    window.addEventListener('keyup', function(event){
      if (event.keyCode === 27) {
        profilOverlay.style.display = '';
      }
    });

    function home() {
      window.location.href = "home.php"
    }
    </script>
  </body>
  </html>
