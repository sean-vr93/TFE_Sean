<?php
	$nom = $_POST ['nom'];
	$prenom = $_POST ['prenom'];
	$email = $_POST ['email'];
    $login = $_POST ['login'];
    $password = $_POST ['password'];
	
	require_once ("connection_bdd.php");
	// prepare statement
	$ps=$pdo->prepare("INSERT INTO users (EMAIL,LOGIN,PASSWORD,NOM,PRENOM) VALUES (?,?,?,?,?)");
	$params=array($email,$login,$password,$nom,$prenom);
	$ps->execute($params);
	header("location:index.php");
?>