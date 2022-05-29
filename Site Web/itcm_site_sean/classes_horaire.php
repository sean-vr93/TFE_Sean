<?php
// Tout ça ne fonctionne pas 





$id=$_GET['id'];
require_once ("securite.php");
require_once ("connection_bdd.php");
$ps=$pdo->prepare("SELECT * FROM classes WHERE ID=?");
$params=array($id);
$ps->execute($params);
$etudiant=$ps->fetch();

$req1 = "SELECT * FROM config_ecole WHERE ID=1";
$ps1 = $pdo->prepare($req1); //objet PDO et prepare statement
$ps1->execute();
$annee=$ps1->fetch();

$reqjours = "SELECT * FROM jours";
$psjours = $pdo->prepare($reqjours); //objet PDO et prepare statement
$psjours->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Horaires Classe <?php echo($etudiant['CLASSE']) ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/w3.css">
	<link rel="stylesheet" type="text/css" href="./css/monStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php require_once("entete_site.php") ?>
	<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style">MODIFICATION DE L'HORAIRE : <?php echo($etudiant['CLASSE']) ?></h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="classes_horaire_suite.php?id=<?php echo($etudiant['ID'])?>" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-dark-grey">Veuillez remplir les champs suivants :</h4>
			<br>
            <input class="w3-input" type="hidden" name="<?php echo('annee' . $etudiant['CLASSE'] . $annee['ANNEE_ACTUELLE'])?>">
			<input class="w3-input" type="hidden" name="<?php echo('classe' . $etudiant['CLASSE'])?>" value="<?php echo($etudiant['ID'])?>">
			<?php while ($jour=$psjours->fetch()) { ?>
				<label><?php echo($jour['JOUR']) ?></label>
				<p>
				<?php $reqheures = "SELECT * FROM heures";
				$psheures = $pdo->prepare($reqheures); //objet PDO et prepare statement
				$psheures->execute(); ?>	
				<?php while ($horaire=$psheures->fetch()) { ?>
					<input class="w3-input" type="hidden" name="<?php echo('heure' . $jour['JOUR'] . $horaire['HEURE'] . $etudiant['CLASSE']) ?>" value="<?php echo($horaire['ID'])?>">
					<input class="w3-input" type="hidden" name="<?php echo('jour' . $jour['JOUR'] . $horaire['HEURE'] . $etudiant['CLASSE']) ?>" value="<?php echo($jour['ID'])?>">
					<label><?php echo($horaire['HEURE']) ?></label>
					<select class="w3-center" name="<?php echo('prof' . $jour['JOUR'] . $horaire['HEURE'] . $etudiant['CLASSE'])?>" type="int">
						<?php $reqprofs = "SELECT * FROM profs";
						$psprofs = $pdo->prepare($reqprofs); //objet PDO et prepare statement
						$psprofs->execute(); ?>
						<?php while ($prof=$psprofs->fetch()) { ?>
							<option value="<?php echo($prof['ID']) ?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
						<?php } ?>
 					</select>
					<select class="w3-center" name="<?php echo('local' . $jour['JOUR'] . $horaire['HEURE'] . $etudiant['CLASSE'])?>" type="int">
						<?php $reqlocaux = "SELECT * FROM locaux";
						$pslocaux = $pdo->prepare($reqlocaux); //objet PDO et prepare statement
						$pslocaux->execute(); ?>
						<?php while ($local=$pslocaux->fetch()) { ?>
							<option value="<?php echo($local['ID']) ?>"><?php echo($local['LOCAL'])?></option>
						<?php } ?>
 					</select>
					<select class="w3-center" name="<?php echo('matiere' . $jour['JOUR'] . $horaire['HEURE'] . $etudiant['CLASSE'])?>" type="int">
						<?php $reqmatieres = "SELECT * FROM matieres";
						$psmatieres = $pdo->prepare($reqmatieres); //objet PDO et prepare statement
						$psmatieres->execute(); ?>
						<?php while ($matiere=$psmatieres->fetch()) { ?>
						<option value="<?php echo($matiere['ID']) ?>"><?php echo($matiere['MATIERE'])?></option>
						<?php } ?>
 					</select>
					<p>
					<br>
				<?php } ?>
				<p>
				<br>
			<?php } ?>
			<p>
			<br>
			<button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
		</form> 
	</div>
</body>
</html>