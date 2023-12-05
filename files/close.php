<?php
session_start();
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);
$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');

include_once("random.php");

if(isset($_GET['id']) AND $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
}
// FICHIERS IMAGES VIDEOS

if(isset($_POST['submit'])){
                    $uploadDate = date('Y-m-d H:i:s');
                    $userid = $_SESSION['id'];
                    $username = $_SESSION['pseudo'];
                    $textuser = mysqli_real_escape_string($conn, $_POST['letexte']);
                    $title = mysqli_real_escape_string($conn, $_POST['titre']);
                    $date = date('Y-m-d', strtotime($_POST['opendate']));
                    $insert = $conn->query("INSERT INTO capsula (liaison, userpseudo, userid, titre, usertext, date_time, date_open) VALUES ('$liaison', '$username', '$userid', '$title', '$textuser', '$uploadDate', '$date')");
    
                       
    $e1= "uploads/";
    $e2= $_SESSION['pseudo'] . ' ' . $_SESSION['id']."/";
    $emplacement = $e1.$e2;
    $uploadsDir = $emplacement;

    if (!file_exists($uploadsDir)) {
        $dossier = $_SESSION['pseudo'] . ' ' . $_SESSION['id'] ;
        mkdir("uploads/$dossier");
    }
    $allowedFileType = array('jpg','png','jpeg', 'mp4', 'webm', 'mp3', 'gif', 'jfif');

    // Velidate if files exist
    if (!empty(array_filter($_FILES['files']['name']))) {

        // Loop through file items
        foreach($_FILES['files']['name'] as $id=>$val){
            // Get files upload path
            $fileName        = $_FILES['files']['name'][$id];
            $tempLocation    = $_FILES['files']['tmp_name'][$id];
            $targetFilePath  = $uploadsDir . $fileName;
            $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $uploadDate      = date('Y-m-d H:i:s');
            $uploadOk = 1;
            if(in_array($fileType, $allowedFileType)){
                    if(move_uploaded_file($tempLocation, $targetFilePath)){

                        $userid = $_SESSION['id'];
                        $username = $_SESSION['pseudo'];
                        $textuser = mysqli_real_escape_string($conn, $_POST['letexte']);
                        $title = mysqli_real_escape_string($conn, $_POST['titre']);
                    
                        $sqlVal = "('".$liaison."''".$userid."', '".$username."', '".$fileName."')";

                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
                    }
                
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Only .jpg, .jpeg and .png file formats allowed."
                );
            }
            // Add into MySQL database
            if(!empty($sqlVal)) {
                $insert = $conn->query("INSERT INTO files (userid, userpseudo, images, liaison, titre) VALUES ('$userid', '$username', '$fileName', '$liaison', '$title')");
                
                if($insert) {
                    
                    
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Files coudn't be uploaded due to database error."
                    );
                }
            }
        }
    } else {
        // Error
        $response = array(
            "status" => "alert-danger",
            "message" => "Please select a file to upload."
        );
    }
} 

header("Location: bienvenue.php?id=".$_SESSION['id']);


?>