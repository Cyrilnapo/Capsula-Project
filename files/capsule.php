<link rel="stylesheet" href="css/capsulestyle.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
<!DOCTYPE html>
<html>
<div class="delete">
<button type="button" class="btn btn-danger">
  <i class="glyphicon glyphicon-trash"></i> Supprimer ma capsule
</button>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.js'></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css'><link rel="stylesheet" href="delete button/style.css">
<script>
$('button').click(function(){
  function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
  }
  swal({
  title: 'Êtes-vous sûr ?',
  text: "La capsule sera supprimée définitivement",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Annuler',
  confirmButtonText: 'Oui je suis sûr'
}).then(function() {
  swal({
    title:'Supprimée',
    text:'Capsule détruite avec succès',
    type:'success',
  }).then(function() {
    window.location="delete button/deletecap.php";
    
  })


})
})

</script>

</html>
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);

$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');


$id = $_SESSION['id'];
$opendate = $_GET["date"];

$_SESSION['date'] = $opendate;

if($opendate != $_SESSION['date']){
  header("location: bienvenue.php?id=".$id);

}



$current = strtotime(date("Y-m-d"));
$date    = strtotime($opendate);

$datediff = $date - $current;
$difference = floor($datediff/(60*60*24));
if($difference > 1 OR $difference > 0)
{
   ?><center><a class = "non"><?php echo "Capsule indisponible car elle n'a pas atteinte ça date d'ouverture"; ?> </center></a><?php
}
else
{
  $titre = $_GET['title'];
  
  $username = $_SESSION['pseudo'];
  $sql = "SELECT usertext FROM capsula WHERE userid = '$id' AND titre = '$titre' ";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $texte = $row['usertext'];
  $_SESSION['titre'] = $titre;
?>
<center><div class="textdiv"><a class="titre"><?php echo $titre; ?></a><br><br><a class="texte"><?php echo $row['usertext']; ?></a></div></center><br><br><br>
<?php
$sql = "SELECT images FROM files WHERE userid = '$id' AND titre = '$titre' ";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);



if ($resultCheck > 0) {
  while ($cap = mysqli_fetch_assoc($result)){

        $emplacement = "uploads/".$_SESSION['pseudo'] . ' ' . $_SESSION['id']."/".$cap['images'];
        $emplacement2 = "../uploads/".$_SESSION['pseudo'] . ' ' . $_SESSION['id']."/".$cap['images'];
        $_SESSION['fichiers'] = $emplacement2;

        $mime = mime_content_type($emplacement);

              if(strstr($mime, "video/")){ ?>

                    <center>
                    <video width="1100" height="auto" src="<?php echo $emplacement; ?>" controls > <?php echo " ";
                    ?></center><?php
              }else if(strstr($mime, "image/")){ ?>
                    <center>
                    <img class ="images" src="<?php echo $emplacement; ?>" /><?php echo " ";
                    ?></center><?php
              }?>
        
        
        
        <?php
  }
}

}  






      

      
?>
