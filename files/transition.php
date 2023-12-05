<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);

$bdd = new PDO('mysql:host=localhost;dbname=capsule', 'root', 'root');


$id = $_SESSION['id'];
$sql = "SELECT liaison, titre FROM capsula WHERE userid = $id";
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$liaison = $row['liaison'];
$title = $row['titre'];

header("Location: capsule.php?capsule=".$liaison."&titre=".$title);

?>