<?php
try{
	$strConnection = 'mysql:host=localhost:3388;dbname=itcm_bdd_sean';
	$pdo = new PDO ($strConnection,"root","root");
	//echo "La connexion s'est bien passée!"; 
}
catch (PDOException $e){
	$msg = 'Erreur PDO dans ' . $e->getMessage();
	echo "La connexion a échoué";
	die ($msg);
}
?>








