<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role = $_POST['role'];
$approved = $_POST['approved'];

$lieneleve = $_POST['eleve']; 
$lienprof = $_POST['professeur'];
$lieneduc = $_POST['educateur'];
$liendirec = $_POST['direction'];

require_once ("connection_bdd.php");
 
$ps=$pdo->prepare("UPDATE users SET LIEN_ELEVE=? WHERE ID=?");
$params=array($lieneleve,$id);
$ps->execute($params);

$ps=$pdo->prepare("UPDATE users SET LIEN_PROF=? WHERE ID=?");
$params=array($lienprof,$id);
$ps->execute($params);

$ps=$pdo->prepare("UPDATE users SET LIEN_EDUCATEUR=? WHERE ID=?");
$params=array($lieneduc,$id);
$ps->execute($params);

$ps=$pdo->prepare("UPDATE users SET LIEN_DIRECTION=? WHERE ID=?");
$params=array($liendirec,$id);
$ps->execute($params);

$ps=$pdo->prepare("UPDATE users SET EMAIL=?,LOGIN=?,PASSWORD=?,NOM=?,PRENOM=?,ROLE=?,APPROVED=? WHERE ID=?");
$params=array($email,$login,$password,$nom,$prenom,$role,$approved,$id);
$ps->execute($params);

header("location:verifier_comptes.php");
?>