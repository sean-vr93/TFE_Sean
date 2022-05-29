<?php
$id=$_GET['id'];
if ($id == 1) {
	header("location:accueil.php");
}
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
require_once ("connection_bdd.php");
$ps70=$pdo->prepare("SELECT * FROM eleves WHERE ID=?");
$params70=array($id);
$ps70->execute($params70);
$etudiant70=$ps70->fetch();

$reqclasses7 = "SELECT * FROM classes";
$psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
$psclasses7->execute();

$reqclasses8 = "SELECT * FROM classes";
$psclasses8 = $pdo->prepare($reqclasses8); //objet PDO et prepare statement
$psclasses8->execute();
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
		<h3 class="w3-opacity bold_style w3-text-white">EDITION DES ETUDIANTS</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="./update_eleve.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<br>
			<input class="w3-input" type="hidden" name="id" value="<?php echo($etudiant70['ID']) ?>">
			<label class="w3-text-white">ID = <?php echo($etudiant70['ID']) ?></label>
			<p>
			<input class="w3-input" type="text" name="nom" value="<?php echo($etudiant70['NOM']) ?>">
			<label class="w3-text-white">NOM</label>
			<p>
			<input class="w3-input" type="text" name="prenom" value="<?php echo($etudiant70['PRENOM']) ?>">
			<label class="w3-text-white">PRENOM</label>
			<p>
			<?php while ($classe_actuelle=$psclasses8->fetch()) { ?>
			<?php if ($classe_actuelle['ID']==$etudiant70['CLASSE']) {?>
			<label class="w3-text-white">CLASSE ACTUELLE = <?php echo($classe_actuelle['CLASSE']) ?></label> 
			<?php } ?>
			<?php } ?>
			<select class="w3-select w3-center" name="classe" type="int">
				<?php while ($classe=$psclasses7->fetch()) { ?>
					<option value="<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></option>
				<?php } ?>
 			</select>
			<label class="w3-text-white">CLASSE</label>
			<p>
			<input class="w3-input" type="number" name="annee" value="<?php echo($etudiant70['ANNEE']) ?>">
			<label class="w3-text-white">ANNEE</label>
			<p>
			<input class="w3-input" type="text" name="email" value="<?php echo($etudiant70['EMAIL']) ?>">
			<label class="w3-text-white">EMAIL</label>
			<p>
			<h4 class="w3-text-white">Veuillez choisir une photo :</h4>
			</br>
			<div class="w3-container w3-border entete_style">
			<input class="w3-input" type="file" name="photo">
			<label class="w3-text-white">PHOTO</label>
			</div>
			</br>
			<img src="./images/<?php echo($etudiant70['PHOTO']) ?>" width="50" height="50" >
			<p>
			</br>
			<button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
		</form> 
	</div>
</body>
</html>
