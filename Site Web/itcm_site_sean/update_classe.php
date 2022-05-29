<?php

require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$nom = $_POST['nom'];
$titulaire = $_POST['titulaire'];

require_once ("connection_bdd.php");

$ps100 = $pdo->prepare("UPDATE classes SET CLASSE=?,TITULAIRE=? WHERE ID=?");
$params100=array($nom,$titulaire,$id);
$ps100->execute($params100);

header("location:afficher_classes.php");
?>