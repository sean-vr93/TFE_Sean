<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$annee = $_POST['annee'];
$prof = $_POST['prof'];
$matiere = $_POST['matiere'];
$classe = $_POST['classe'];

require_once ("connection_bdd.php");

$ps100 = $pdo->prepare("UPDATE profs_classes_matieres SET ANNEE=?,PROF=?,CLASSE=?,MATIERE=? WHERE ID=?");
$params100=array($annee,$prof,$classe,$matiere,$id);
$ps100->execute($params100);

header("location:afficher_prof_classe_matiere.php");
?>