<?php
session_start();
 
$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM user WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();}
?>
<?php
         if(isset($_SESSION['id']) AND $userinfo['id'] != $_SESSION['id']) {
            header("Location: bienvenue.php?id=".$_SESSION['id']);
         }
         ?>
<html>
   <head>
   <link rel="stylesheet" href="css/profilestyle.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>
      <title>Profil de <?php echo $userinfo['pseudo']; ?></title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
      <br>
         <h2 style="">Bonjour, <?php echo $userinfo['pseudo']; ?> !</h2>
         <br /><br />
         <h1>Votre Email : <?php echo $userinfo['email']; ?></h1>
         <br />
         <h1>Date de création du compte :  <?php echo $userinfo['date']; ?></h1>
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="mdpmodif.php">Éditer mon profil</a>
      </div> 

      <?php


function goHome() {
  header("Location: bienvenue.php?id=".$_SESSION['id']); 
 }

if (isset($_GET['camion'])) {
  goHome();
}

?>

     <div class="wrap">
       <div class="menu-drop-btn">
         <input type="checkbox">
         <svg width="60" height="60">
             <circle cx="15" cy="30" r="5"></circle>
           <circle cx="30" cy="30" r="5"></circle>
           <circle cx="45" cy="30" r="5"></circle>
         </svg>
         <div style="text-align:left;"class="drop-menu">
         <a style="font-family: 'Nunito', sans-serif;"href="?camion=true"><i class="fa-solid fa-house"></i> Accueil</a>
           <a style="font-family: 'Nunito', sans-serif;"href="#"><i class="fa-solid fa-user"></i> Mon profil</a>
           <a style="font-family: 'Nunito', sans-serif;"href="mdpmodif.php"><i class="fa-solid fa-pen-to-square"></i> Éditer mon profil</a>
           <a style="font-family: 'Nunito', sans-serif;"href="#"><i class="fa-solid fa-book"></i> À propos</a>
           <a style="font-family: 'Nunito', sans-serif;" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter</a>
         </div>
       </div>
     </div>
     
   </body>
</html>
<?php   
}
?>
