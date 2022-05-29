<?php
session_start ();
if (!(isset($_SESSION['PROFILE']))){
	header("location:connexion.php");
}
if ($_SESSION['PROFILE']['APPROVED'] != 1){
	header("location:connexion.php");
}
?>
