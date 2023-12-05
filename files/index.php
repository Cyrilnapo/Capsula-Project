

<?php
	$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');
	
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erreur de connexion à la base de donnéee" . $conn->connect_error);
}

?>
	
<!DOCTYPE html>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
<br><br><br><br>
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
.sucess{
	padding: 20px;
  background-color: green;
  color: white;
  width:400px;
  border-radius:8px;
  font-family:'Nunito', sans-serif;
}
.closebtn:hover {
  color: black;
}
</style>
<body>
<form action="" method='post'>
<center>
<title>Inscription</title>
<h1>Inscription</h1>

<?php
session_start();
if(isset($_SESSION['id'])){
	header("Location: bienvenue.php?id=".$_SESSION['id']);
}

if(isset($_POST['adduser'])) {
	
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
	   $pseudolength = strlen($pseudo);
	   if($pseudolength <= 255) {
		  if($mail == $mail2) {
			 if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				$reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
				$reqmail->execute(array($mail));
				$mailexist = $reqmail->rowCount();
				if($mailexist == 0) {
				   if($mdp == $mdp2) {
					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
						$ip = $_SERVER['HTTP_CLIENT_IP'];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					} else {
						$ip = $_SERVER['REMOTE_ADDR'];
					}
					  $insertmbr = $bdd->prepare("INSERT INTO user(pseudo, email, mdp, ip) VALUES(?, ?, ?, ?)");
					  $insertmbr->execute(array($pseudo, strtolower($mail), $mdp, $ip));

					  
					  ?>
					  <center>
					  <div class="sucess">
					  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					  <strong>Succès !</strong> Votre compte a bien été crée, veuillez vous <a style="color:#66afe9;" href="connexion.php">connecter</a>
					  </div>
					  <br>
					  </center>
					  <?php
		                  } else {
							?>
							<center>
							<div class="alert">
							<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
							<strong>Attention !</strong> Les mots de passes ne correspondent pas
							</div>
							<br>
							</center>
							<?php
						 }
					  } else {
						?>
						<center>
						<div class="alert">
						<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
						<strong>Erreur !</strong> Cet E-mail est déjà utilisé essayez peut être de <a style="color:#66afe9;" href = connexion.php>vous connectez</a>
						</div>
						<br>
						</center>
						<?php
					}
				   } else {
					  $erreur = "Votre adresse mail n'est pas valide !";
				   }
				} else {
					?>
					<center>
					<div class="alert">
					<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
					<strong>Erreur !</strong> Les emails ne correspondent pas
					</div>
					<br>
					</center>
					<?php
				}
			 } else {
				$erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
			 }
		  } else {
			 $erreur = "Tous les champs doivent être complétés !";
		  }
	   }
	   ?>
	<input style ="font-family:'Nunito', sans-serif;" type="text" name="pseudo" placeholder="Votre nom" autocomplete="off" maxlength="24" required >
<br><br><br>
<input style ="font-family:'Nunito', sans-serif;" type="email" name="mail" placeholder="Email" autocomplete="off" required >
<br><br>
<input style ="font-family:'Nunito', sans-serif;"type="email" name="mail2" placeholder="Confirmer email" autocomplete="off" required>

<br><br><br>
<input style ="font-family:'Nunito', sans-serif;" type="password" name="mdp" placeholder="Mot de passe" autocomplete="off" required>
<br><br>
<input style ="font-family:'Nunito', sans-serif;" type="password" name="mdp2" placeholder="Confirmer mot de passe" autocomplete="off" required>
<br><br>
<button name="adduser" class="button button2"><i style="font-size:20px;"class="fa-solid fa-user-plus"></i> S'inscrire </button>
<br>
<a href = connexion.php style="color:rgba(0, 0, 0, 0.774);font-size:15px;font-weight:700;font-family:'Nunito', sans-serif;">Je possède déjà un compte</a>

</center>
</body>



</html>
