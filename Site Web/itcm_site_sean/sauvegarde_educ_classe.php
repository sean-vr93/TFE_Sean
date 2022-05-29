<?php

$educ = $_POST['educ'];
$classe = $_POST['classe'];

require_once ("connection_bdd.php");
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$ps60=$pdo->prepare("INSERT INTO educateurs_classes (EDUCATEUR,CLASSE) VALUES (?,?)");
$params60=array($educ,$classe);
$ps60->execute($params60);
	
header("location:afficher_educ_classe.php");
?>