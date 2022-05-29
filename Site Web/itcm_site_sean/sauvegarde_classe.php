<?php
require_once ("connection_bdd.php");
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}

$nom = $_POST['nom'];
$approved = 1;

$req = "SELECT * FROM classes";
$ps = $pdo->prepare($req); //objet PDO et prepare statement
$ps->execute();

while ($classe=$ps->fetch()) {
    if ($_POST['nom'] == $classe['CLASSE']) {
        $approved = 0;
    }
} 

if ($approved == 1) {
$ps60=$pdo->prepare("INSERT INTO classes (CLASSE) VALUES (?)");
$params60=array($nom);
$ps60->execute($params60); 
}

header("location:afficher_classes.php");
?>