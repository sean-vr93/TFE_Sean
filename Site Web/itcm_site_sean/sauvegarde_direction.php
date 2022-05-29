<?php
require_once ("connection_bdd.php");
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];

$ps60=$pdo->prepare("INSERT INTO directions (NOM,PRENOM,EMAIL) VALUES (?,?,?)");
$params60=array($nom,$prenom,$email);
$ps60->execute($params60);

header("location:afficher_directions.php");
?>
