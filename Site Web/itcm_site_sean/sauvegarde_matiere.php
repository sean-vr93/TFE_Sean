<?php
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}


require_once ("connection_bdd.php");

$nom = $_POST['nom'];
$approved = 1;

$req = "SELECT * FROM matieres";
$ps = $pdo->prepare($req); //objet PDO et prepare statement
$ps->execute();

while ($matiere=$ps->fetch()) {
    if ($_POST['nom'] == $matiere['MATIERE']) {
        $approved = 0;
    }
} 

if ($approved == 1) {
$ps60=$pdo->prepare("INSERT INTO matieres (MATIERE) VALUES (?)");
$params60=array($nom);
$ps60->execute($params60); 
}

header("location:afficher_matieres.php");
?>