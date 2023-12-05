
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/modifstyle.css">
<script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>

<br><br><br><br><br>
<body>
<title>Édition profil</title>
  <style>
  
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  width:400px;
  border-radius:8px;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
.success{
    padding: 20px;
  background-color: green;
  color: white;
  width:400px;
  border-radius:8px;
}
.closebtn:hover {
  color: black;
}
</style>
<form action="" method ='post'>
<center>
<h1>Modification du profil</h1>
<?php
    session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "Vous devez être connecté à un compte";
    header('location: index.php');
}
$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');
if(isset($_SESSION['id'])) {
  $requser = $bdd->prepare("SELECT * FROM user WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();
  if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
     $newpseudo = htmlspecialchars($_POST['newpseudo']);
     $insertpseudo = $bdd->prepare("UPDATE user SET pseudo = ? WHERE id = ?");
     $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
     header('Location: profile.php?id='.$_SESSION['id']);
  }
  if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email']) {
    if(filter_var($_POST['newmail'], FILTER_VALIDATE_EMAIL)) {
      $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
      $reqmail->execute(array($_POST['newmail']));
      $mailexist = $reqmail->rowCount();
      if ($mailexist >0){
        ?>
          <center>
          <div class="alert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
          <i class="fa-solid fa-circle-exclamation"></i> <a style="font-family: 'Nunito', sans serif;">Un compte existe déja avec cet email</a>
          </div>
          <br>
          </center>
          <?php
      }
      else{
     $newmail = htmlspecialchars($_POST['newmail']);
     $insertmail = $bdd->prepare("UPDATE user SET email = ? WHERE id = ?");
     $insertmail->execute(array($newmail, $_SESSION['id']));
     header('Location: profile.php?id='.$_SESSION['id']);
      }
  }

  }
  if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
     $mdp1 = sha1($_POST['newmdp1']);
     $mdp2 = sha1($_POST['newmdp2']);
     if($mdp1 == $mdp2) {
        $insertmdp = $bdd->prepare("UPDATE user SET mdp = ? WHERE id = ?");
        $insertmdp->execute(array($mdp1, $_SESSION['id']));
        header('Location: profile.php?id='.$_SESSION['id']);
     } elseif ($mdp1 != $mdp2) {
      ?>
      <center>
      <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <i class="fa-solid fa-circle-exclamation"></i> <a style="font-family: 'Nunito', sans serif;">Les mots de passes ne correspondent pas</a>
      </div>
      <br>
      </center>
      <?php
     }
  }
?>
    
    <?php
  function runMyFunction() {
    header("Location: profile.php?id=".$_SESSION['id']); 
   }

  if (isset($_GET['hello'])) {
    runMyFunction();
  }
  function goHome() {
    header("Location: bienvenue.php?id=".$_SESSION['id']); 
   }

  if (isset($_GET['salut'])) {
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
    <a style="font-family: 'Nunito', sans-serif;"href="?salut=true"><i class="fa-solid fa-house"></i> Accueil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="?hello=true"><i class="fa-solid fa-user"></i> Mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="mdpmodif.php"><i class="fa-solid fa-pen-to-square"></i> Éditer mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="#"><i class="fa-solid fa-book"></i> À propos</a>
      <a style="font-family: 'Nunito', sans-serif;" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter</a>
    </div>
  </div>
</div>
          
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label><br>
               <input type="text" name="newpseudo" autocomplete="off" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mail :</label><br>
               <input type="text" name="newmail" autocomplete="off" placeholder="Mail" value="<?php echo $user['email']; ?>" /><br /><br />
               <label>Mot de passe :</label><br>
               <input type="password" name="newmdp1" autocomplete="off" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label><br>
               <input type="password" name="newmdp2" autocomplete="off" placeholder="Confirmation" /><br /><br />

               <button type="submit" class="button button2"><i style="font-size:20px;"class="fa-solid fa-pen-to-square"></i> Mettre à jour </button>      
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
      
   </body>
   <?php   
}
else {
   header("Location: connexion.php");
}
?>
</center>
</body>

</html>

