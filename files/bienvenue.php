<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/stylebvn.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "Vous devez être connecté à un compte";
    header('location: index.php');
}


if(isset($_GET['id']) AND $_GET['id'] > 0) {
  $getid = intval($_GET['id']);
  $requser = $bdd->prepare('SELECT * FROM user WHERE id = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();
}
if(isset($_SESSION['id']) AND $userinfo['id'] != $_SESSION['id']) {
   header("Location: bienvenue.php?id=".$_SESSION['id']);
}

?>
<?php
  function goProfil() {
    header("Location: profile.php?id=".$_SESSION['id']); 
   }

  if (isset($_GET['hello'])) {
    goProfil();
  }


  function goHome() {
    header("Location: bienvenue.php?id=".$_SESSION['id']); 
   }

  if (isset($_GET['salut'])) {
    goHome();
  }


  
?>
<title>Accueil</title>
<div class="wrap">
  <div class="menu-drop-btn">
    <input type="checkbox">
    <svg width="60" height="60">
        <circle cx="15" cy="30" r="5"></circle>
      <circle cx="30" cy="30" r="5"></circle>
      <circle cx="45" cy="30" r="5"></circle>
    </svg>
    <div class="drop-menu">
    <a style="font-family: 'Nunito', sans-serif; font-weight:700;"href="?salut=true"><i class="fa-solid fa-house"></i> Accueil</a>
      <a style="font-family: 'Nunito', sans-serif;font-weight:700;"href="?hello=true"><i class="fa-solid fa-user"></i> Mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;font-weight:700;"href="mdpmodif.php"><i class="fa-solid fa-pen-to-square"></i> Éditer mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;font-weight:700;"href="#"><i class="fa-solid fa-book"></i> À propos</a>
      <a style="font-family: 'Nunito', sans-serif;font-weight:700;" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter</a>
    </div>
  </div>
</div>
<a class="creabtn" href="crea.php"><i class="fa-solid fa-circle-plus"></i></a>
<center><h1>Mes Capsules</h1></center>
<center><hr></center>

<?php

      $id = $_SESSION['id'];
      $username = $_SESSION['pseudo'];
      $sql = "SELECT titre, date_open FROM capsula WHERE userid = $id";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              ?> 
              <a class="caps"name="capsule"style="text-decoration:none;"  href='capsule.php?title=<?php echo $row['titre'];?>&date=<?php echo $row['date_open'];?>'>
                <div  class="capdiv">
                  <h2 name="titre"> <?php echo $row['titre']; ?> </h2><label class="un">ouvrable:</label><h1 class="date"><?php echo $row['date_open']?></h1>
                </div>
              </a>
          <br>
              <?php
          }
      } else {
        ?>
        <h3> Vous n'avez pas de capsules enregistrées<br><a class="lien" href="crea.php">créez-en une</a></h2>
        <?php
      } 
?>

</html>

