<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "capsule";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$titre0 = $_SESSION['titre'];
$id = $_SESSION['id'];
$files = $_SESSION['fichiers'];

mysqli_query($conn,"DELETE FROM capsula WHERE userid='$id'AND titre ='$titre0' ");
mysqli_query($conn,"DELETE FROM files WHERE userid='$id'AND titre ='$titre0' ");

if (file_exists($files)){
If (unlink($files)) {
    header("Location: ../bienvenue.php?id=".$_SESSION['id']);
} else {
    header("Location: ../bienvenue.php?id=".$_SESSION['id']);
}
}












header("Location: ../bienvenue.php?id=".$_SESSION['id']);
?>