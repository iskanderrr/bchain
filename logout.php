<?php 
require_once 'pdo.php';
$_SESSION['connecte']="0";

session_destroy();

header("Location: login.php");

?>