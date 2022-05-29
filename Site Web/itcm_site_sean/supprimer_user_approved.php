<?php

require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}

$id = $_GET['id'];
require_once ("connection_bdd.php");

$ps = $pdo->prepare("DELETE FROM users WHERE ID=?"); 
$params = array($id); 
$ps->execute($params); 

header("location:verifier_comptes.php");
?>