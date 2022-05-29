<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
$id = $_POST['id'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$nomPhoto = $_FILES['photo']['name'];
require_once ("connection_bdd.php");

if($nomPhoto != "") {
	$nomPhoto1 = $id . $nom . $prenom . "AvatarProf" . $nomPhoto;
	$fichierTempo=$_FILES['photo']['tmp_name'];
	move_uploaded_file($fichierTempo,"./images/$nomPhoto1");
	$ps101=$pdo->prepare("UPDATE profs SET NOM=?,PRENOM=?,EMAIL=?,PHOTO=? WHERE ID=?");
	$params101=array($nom,$prenom,$email,$nomPhoto1,$id);
	$ps101->execute($params101);
}

else {
	$ps100 = $pdo->prepare("UPDATE profs SET NOM=?,PRENOM=?,EMAIL=? WHERE ID=?");
	$params100=array($nom,$prenom,$email,$id);
	$ps100->execute($params100);
}

header("location:accueil.php");
?>