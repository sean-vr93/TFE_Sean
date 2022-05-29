<?php
$id=$_GET['id'];
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
require_once ("connection_bdd.php");

$ps70=$pdo->prepare("SELECT * FROM profs_classes_matieres WHERE ID=?");
$params70=array($id);
$ps70->execute($params70);
$etudiant70=$ps70->fetch();

$reqclasses8 = "SELECT * FROM classes";
$psclasses8 = $pdo->prepare($reqclasses8); //objet PDO et prepare statement
$psclasses8->execute();
$reqprofs8 = "SELECT * FROM profs";
$psprofs8 = $pdo->prepare($reqprofs8); //objet PDO et prepare statement
$psprofs8->execute();
$reqmatieres8 = "SELECT * FROM matieres";
$psmatieres8 = $pdo->prepare($reqmatieres8); //objet PDO et prepare statement
$psmatieres8->execute();

$reqclasses7 = "SELECT * FROM classes";
$psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
$psclasses7->execute();
$reqprofs7 = "SELECT * FROM profs";
$psprofs7 = $pdo->prepare($reqprofs7); //objet PDO et prepare statement
$psprofs7->execute();
$reqmatieres7 = "SELECT * FROM matieres";
$psmatieres7 = $pdo->prepare($reqmatieres7); //objet PDO et prepare statement
$psmatieres7->execute();

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
		<h3 class="w3-opacity bold_style w3-text-white">EDITION DES PROFESSEURS CLASSE MATIERE</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="./update_prof_classe_matiere.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<br>
			<input class="w3-input" type="hidden" name="id" value="<?php echo($etudiant70['ID']) ?>">
			<label class="w3-text-white">ID = <?php echo($etudiant70['ID']) ?></label>
			<p>
			
			<label class="w3-text-white">ANNEE ACTUELLE : <?php echo($etudiant70['ANNEE']) ?></label>
			<input class="w3-input" type="text" name="annee" value="<?php echo($etudiant70['ANNEE']) ?>">
			<label class="w3-text-white">ANNEE</label>
			
			<p>
			
			<label class="w3-text-white">PROF</label>
			<select class="w3-select w3-center" name="prof" type="int">
				<?php while ($prof=$psprofs8->fetch()) { ?>
					<?php if ($prof['ID'] == $etudiant70['PROF'] ) { ?>
						<option value="<?php echo($prof['ID']) ?>">ACTUEL : <?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } } ?>
				
			
				<?php while ($prof=$psprofs7->fetch()) { ?>
					<?php if (($prof['ID'] != 1 ) and ($prof['ID'] != $etudiant70['PROF'])) { ?>
					<option value="<?php echo($prof['ID']) ?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } } ?>
 			</select>
			
			<p>
			
			<label class="w3-text-white">MATIERE</label>
			<select class="w3-select w3-center" name="matiere" type="int">
				<?php while ($matiere=$psmatieres8->fetch()) { ?>
					<?php if ($matiere['ID'] == $etudiant70['MATIERE'] ) { ?>
					<option value="<?php echo($matiere['ID']) ?>">ACTUELLE : <?php echo($matiere['MATIERE']) ?></option>
				<?php } } ?>
			
			
				<?php while ($matiere=$psmatieres7->fetch()) { ?>
					<?php if (($matiere['ID'] != 1 ) and ($matiere['ID'] != $etudiant70['MATIERE'] )) { ?>
					<option value="<?php echo($matiere['ID']) ?>"><?php echo($matiere['MATIERE']) ?></option>
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