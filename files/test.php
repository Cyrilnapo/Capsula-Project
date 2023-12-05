<?php

session_start();
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "capsule";

$conn = new mysqli($servername, $username, $password, $dbname);


 $current = strtotime(date("Y-m-d"));
 $date    = strtotime("2022-05-12");

 $datediff = $date - $current;
 $difference = floor($datediff/(60*60*24));

 if($difference > 1 OR $difference > 0)
 {
    echo 'C PAS BON';
 }
 else
 {
    echo 'C BON';
 }  

?>


 