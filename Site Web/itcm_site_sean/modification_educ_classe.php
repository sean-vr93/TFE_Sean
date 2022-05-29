<?php
$id=$_GET['id'];
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
require_once ("connection_bdd.php");

$ps70=$pdo->prepare("SELECT * FROM educateurs_classes WHERE ID=?");
$params70=array($id);
$ps70->execute($params70);
$etudiant70=$ps70->fetch();

$reqclasses8 = "SELECT * FROM classes";
$psclasses8 = $pdo->prepare($reqclasses8); //objet PDO et prepare statement
$psclasses8->execute();
$reqprofs8 = "SELECT * FROM educateurs";
$psprofs8 = $pdo->prepare($reqprofs8); //objet PDO et prepare statement
$psprofs8->execute();


$reqclasses7 = "SELECT * FROM classes";
$psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
$psclasses7->execute();
$reqprofs7 = "SELECT * FROM educateurs";
$psprofs7 = $pdo->prepare($reqprofs7); //objet PDO et prepare statement
$psprofs7->execute();


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/w3.css">
	<link rel="stylesheet" type="text/css" href="./css/monStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php require_once("entete_site.php") ?>
	<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style w3-text-white">EDITION DES EDUCATEURS CLASSES</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="./update_educ_classe.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<br>
			<input class="w3-input" type="hidden" name="id" value="<?php echo($etudiant70['ID']) ?>">
			<label class="w3-text-white">ID = <?php echo($etudiant70['ID']) ?></label>
			<p>
	
			<label class="w3-text-white">EDUCATEUR</label>
			<select class="w3-select w3-center" name="educ" type="int">
				<?php while ($prof=$psprofs8->fetch()) { ?>
					<?php if ($prof['ID'] == $etudiant70['EDUCATEUR'] ) { ?>
						<option value="<?php echo($prof['ID']) ?>">ACTUEL : <?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } } ?>
				
			
				<?php while ($prof=$psprofs7->fetch()) { ?>
					<?php if (($prof['ID'] != 1 ) and ($prof['ID'] != $etudiant70['EDUCATEUR'])) { ?>
					<option value="<?php echo($prof['ID']) ?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } } ?>
 			</select>
			
			<p>
		
			<label class="w3-text-white">CLASSE</label>
			<select class="w3-select w3-center" name="classe" type="int">
				<?php while ($classe=$psclasses8->fetch()) { ?>
					<?php if ($classe['ID'] == $etudiant70['CLASSE'] ) { ?>
					<option value="<?php echo($classe['ID']) ?>">ACTUELLE : <?php echo($classe['CLASSE']) ?></option>
				<?php } } ?>

				<?php while ($classe=$psclasses7->fetch()) { ?>
					<?php if (($classe['ID'] != 1 ) and ($classe['ID'] != $etudiant70['CLASSE'])) { ?>
					<option value="<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></option>
				<?php } } ?>
 			</select>
			<p>
			
			</br>
			<button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
		</form> 
	</div>
</body>
</html>