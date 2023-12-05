<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/creastyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@800&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/39ca104589.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">

    </head>
    <?php
        session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');
        if (!isset($_SESSION['email'])) {
            $_SESSION['msg'] = "Vous devez être connecté à un compte";
            header('location: index.php');
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
    <div class="drop-menu">
    <a style="font-family: 'Nunito', sans-serif;"href="?salut=true"><i class="fa-solid fa-house"></i> Accueil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="?hello=true"><i class="fa-solid fa-user"></i> Mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="mdpmodif.php"><i class="fa-solid fa-pen-to-square"></i> Éditer mon profil</a>
      <a style="font-family: 'Nunito', sans-serif;"href="#"><i class="fa-solid fa-book"></i> À propos</a>
      <a style="font-family: 'Nunito', sans-serif;" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Se déconnecter</a>
    </div>
  </div>
</div>
<center><h1>Créer votre capsule</h1></center>
<center><hr></center>

<form action="close.php" method="POST" enctype="multipart/form-data">
<label class="lbltext">Qu'avez vous à dire ?</label><label class="lblfile">Ajouter des images/vidéos</label><br>
<textarea maxlength="16" name="titre" class="titre" placeholder="Titre de votre capsule" required></textarea><br>
<textarea name="letexte" class="texte" placeholder="Contenu textuel de votre capsule.."></textarea>
        <input type="file" name="files[]" accept="image/png, image/gif, image/jpeg, video/mp4" multiple/>
        <div class="datecss"><input type="date" id="datePickerId" required id="datePickerId" name="opendate" class="pickdate"/></div>
        <label class="lbldate">Sélectionnez la date de déblocage de votre capsule</label>
<script>
datePickerId.min = new Date().toISOString().split("T")[0];

  </script>

  <button type="submit" class="submit" name="submit">Fermer ma capsule</button>
</form>



</html>