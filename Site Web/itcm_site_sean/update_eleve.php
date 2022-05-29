<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$classe = $_POST['classe'];
$annee = $_POST['annee'];
$email = $_POST['email'];
$nomPhoto = $_FILES['photo']['name'];
require_once ("connection_bdd.php");
if($nomPhoto == "") {
	$ps100 = $pdo->prepare("UPDATE eleves SET NOM=?,PRENOM=?,EMAIL=?,ANNEE=?,CLASSE=? WHERE ID=?");
	$params100=array($nom,$prenom,$email,$annee,$classe,$id);
	$ps100->execute($params100);
}
if($nomPhoto != "") {
	$nomPhoto1 = $id . $nom . $prenom . "AvatarEleve" . $nomPhoto;
	$fichierTempo=$_FILES['photo']['tmp_name'];
	move_uploaded_file($fichierTempo,"./images/$nomPhoto1");
	$ps101=$pdo->prepare("UPDATE eleves SET NOM=?,PRENOM=?,EMAIL=?,PHOTO=?,ANNEE=?,CLASSE=? WHERE ID=?");
	$params101=array($nom,$prenom,$email,$nomPhoto1,$annee,$classe,$id);
	$ps101->execute($params101);
}
header("location:classes.php?id=$classe");
?>