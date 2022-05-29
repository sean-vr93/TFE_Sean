<?php
require_once ("connection_bdd.php");
$choix = $_POST['choix_destinataire'];
$id = $_POST['id_user'];
$name = $_POST['name_user'];
$titre = $_POST['titre'];
$message = $_POST['message'];
$moment = date("Y-m-d H:i:s");


if ($choix == 'Classe') {
if (($_SESSION['PROFILE']['LIEN_PROF'] != 1) or ($_SESSION['PROFILE']['LIEN_DIRECTION'] != 1) or ($_SESSION['PROFILE']['LIEN_EDUCATEUR'] != 1) or ($_SESSION['PROFILE']['ROLE'] == 'admin')) {
$classe = $_POST['classe'];
$ps60=$pdo->prepare("INSERT INTO messages (REDACTEUR_ID,REDACTEUR_NOM,DESTINATAIRE_CLASSE,TITRE,TEXTE,MOMENT) VALUES (?,?,?,?,?,?)");
$params60=array($id,$name,$classe,$titre,$message,$moment);
$ps60->execute($params60); 
header("location:accueil.php");
} }

elseif ($choix == 'User') {
if (($_SESSION['PROFILE']['LIEN_PROF'] != 1) or ($_SESSION['PROFILE']['LIEN_DIRECTION'] != 1) or ($_SESSION['PROFILE']['LIEN_EDUCATEUR'] != 1) or ($_SESSION['PROFILE']['ROLE'] == 'admin')) {
$destinataire = $_POST['id_destinataire'];
$ps60=$pdo->prepare("INSERT INTO messages (REDACTEUR_ID,REDACTEUR_NOM,DESTINATAIRE_ID,TITRE,TEXTE,MOMENT) VALUES (?,?,?,?,?,?)");
$params60=array($id,$name,$destinataire,$titre,$message,$moment);
$ps60->execute($params60); 
header("location:accueil.php");
} }

elseif ($choix == 'Actu') {
if (($_SESSION['PROFILE']['LIEN_PROF'] != 1) or ($_SESSION['PROFILE']['LIEN_DIRECTION'] != 1) or ($_SESSION['PROFILE']['LIEN_EDUCATEUR'] != 1) or ($_SESSION['PROFILE']['ROLE'] == 'admin')) {
$ps60=$pdo->prepare("INSERT INTO actualitees (REDACTEUR_ID,REDACTEUR_NAME,TITRE,TEXTE,MOMENT) VALUES (?,?,?,?,?)");
$params60=array($id,$name,$titre,$message,$moment);
$ps60->execute($params60); 
header("location:accueil.php");
} }

else {
if ($_SESSION['PROFILE']['ROLE'] == 'eleve') {
$destinataire = $_POST['id_destinataire'];
$ps60=$pdo->prepare("INSERT INTO messages (REDACTEUR_ID,REDACTEUR_NOM,DESTINATAIRE_ID,TITRE,TEXTE,MOMENT) VALUES (?,?,?,?,?,?)");
$params60=array($id,$name,$destinataire,$titre,$message,$moment);
$ps60->execute($params60); 
} }
    
header("location:accueil.php");
?>