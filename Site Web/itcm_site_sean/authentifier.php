<?php
require_once ("connection_bdd.php");
$login = $_POST['login'];
$pass = $_POST['password'];

$ps = $pdo->prepare("SELECT * FROM users WHERE LOGIN=? AND PASSWORD=?");
$params=array($login,$pass);
$ps->execute($params);
if ($user=$ps->fetch()){
	session_start();
	$_SESSION['PROFILE']=$user;
	header("location:index.php");}
else {
	header("location:connexion.php");}
?>
