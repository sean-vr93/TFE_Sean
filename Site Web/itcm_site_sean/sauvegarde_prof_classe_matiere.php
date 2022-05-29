<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$annee = $_POST['annee'];
$prof = $_POST['prof'];
$matiere = $_POST['matiere'];
$classe = $_POST['classe'];

require_once ("connection_bdd.php");
$ps60=$pdo->prepare("INSERT INTO profs_classes_matieres (ANNEE,PROF,CLASSE,MATIERE) VALUES (?,?,?,?)");
$params60=array($annee,$prof,$classe,$matiere);
$ps60->execute($params60);
	
header("location:afficher_prof_classe_matiere.php");
?>