<?php
$id=$_GET['id'];
require_once ("securite.php");
require_once ("connection_bdd.php");
$ps=$pdo->prepare("SELECT * FROM classes WHERE ID=?");
$params=array($id);
$ps->execute($params);
$etudiant=$ps->fetch();

$reqjours = "SELECT * FROM jours";
$psjours = $pdo->prepare($reqjours); //objet PDO et prepare statement
$psjours->execute();
while ($jour=$psjours->fetch()) { 
    $reqheures = "SELECT * FROM heures";
    $psheures = $pdo->prepare($reqheures); //objet PDO et prepare statement
	$psheures->execute(); 	
	while ($horaire=$psheures->fetch()) { 
        $annee = $_POST['annee'($etudiant['CLASSE'])];
        $classe = $_POST['classe'($etudiant['CLASSE'])];
        $jour = $_POST['jour'($jour['JOUR'],$horaire['HEURE'],$etudiant['CLASSE'])];
        $heure = $_POST['heure'($jour['JOUR'],$horaire['HEURE'],$etudiant['CLASSE'])];
        $matiere = $_POST['matiere'($jour['JOUR'],$horaire['HEURE'],$etudiant['CLASSE'])];
        $prof = $_POST['prof'($jour['JOUR'],$horaire['HEURE'],$etudiant['CLASSE'])];
        $local = $_POST['local'($jour['JOUR'],$horaire['HEURE'],$etudiant['CLASSE'])];
        
        $ps3=$pdo->prepare("INSERT INTO grille_horaire_classe (ANNEE,CLASSE,PROF,LOCAL,HEURE,JOUR) VALUES (?,?,?,?,?,?)");
	    $params3=array($annee,$classe,$prof,$local,$heure,$jour);
	    $ps3->execute($params3);
    }
}
header("location:accueil.php")
?>








