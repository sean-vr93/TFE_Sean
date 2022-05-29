<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$educ = $_POST['educ'];
$classe = $_POST['classe'];

require_once ("connection_bdd.php");

$ps100 = $pdo->prepare("UPDATE educateurs_classes SET EDUCATEUR=?,CLASSE=? WHERE ID=?");
$params100=array($educ,$classe,$id);
$ps100->execute($params100);

header("location:afficher_educ_classe.php");
?>