<?php
session_start();
unset($_SESSION);
$_SESSION = array();
session_destroy();
session_write_close();
header('Location: connexion.php');
die;
?>