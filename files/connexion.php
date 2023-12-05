



<!DOCTYPE html>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/styleco.css">
<script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>
<br><br><br><br><br><br><br><br><br><br>
<body>
   <title>Connexion</title>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  width:400px;
  border-radius:8px;
  font-family:'Nunito', sans-serif;
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

.closebtn:hover {
  color: black;
}
</style>
<form action="" method ='post'>
<center>
<h1>Connexion</h1>
<?php
    session_start();
    $bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');
    if(isset($_SESSION['id'])){
      header("Location: bienvenue.php?id=".$_SESSION['id']);
   }
    if(isset($_POST['userco'])) {
      $mailconnect = htmlspecialchars(strtolower($_POST['mailconnect']));
      $mdpconnect = sha1($_POST['mdpconnect']);
      if(!empty($mailconnect) AND !empty($mdpconnect)) {
         $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? AND mdp = ?");
         $requser->execute(array($mailconnect, $mdpconnect));
         $userexist = $requser->rowCount();
         if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['email'] = $userinfo['email'];
            header("Location: bienvenue.php?id=".$_SESSION['id']);
         } else {
            ?>
					<center>
					<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					Mauvais mail ou mot de passe
					</div>
					<br>
					</center>
					<?php
         }
      } else {
         $erreur = "Tous les champs doivent être complétés !";
      }
   }
   ?>
<input style ="font-family:'Nunito', sans-serif;"type="email" name="mailconnect" placeholder="Email" autocomplete="off" required >
<br><br>
<input style ="font-family:'Nunito', sans-serif;" type="password" name="mdpconnect" placeholder="Mot de passe" autocomplete="off" required>
<br><br>
<button name="userco" class="button button2"><i class="fa-solid fa-right-to-bracket"></i> Se connecter</button>
<br>
<a href = index.php style="color:rgba(0, 0, 0, 0.774);font-size:15px;font-weight:700;font-family:'Nunito', sans-serif;" >Je ne possède pas de compte</a>

</center>
</body>
<style>
</style>



</html>