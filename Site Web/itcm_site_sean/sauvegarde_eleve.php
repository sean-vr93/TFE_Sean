<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$annee = $_POST['annee'];
$classe = $_POST['classe'];
require_once ("connection_bdd.php");
$ps60=$pdo->prepare("INSERT INTO eleves (NOM,PRENOM,EMAIL,ANNEE,CLASSE) VALUES (?,?,?,?,?)");
$params60=array($nom,$prenom,$email,$annee,$classe);
$ps60->execute($params60);
	
header("location:afficher_eleves.php");
?>
