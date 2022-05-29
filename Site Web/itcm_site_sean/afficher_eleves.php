<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	$req = "SELECT * FROM eleves";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();
	$reqclasses = "SELECT * FROM classes";
	$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	$psclasses->execute();
    $reqclasses7 = "SELECT * FROM classes";
    $psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
    $psclasses7->execute();

    $req10 = "SELECT * FROM config_ecole WHERE ID=1";
    $ps10 = $pdo->prepare($req10); //objet PDO et prepare statement
    $ps10->execute();
    $annee=$ps10->fetch();
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
    <?php if (($_SESSION['PROFILE']['ROLE'] == 'admin') or ($_SESSION['PROFILE']['ROLE'] == 'direction')) { ?>
	<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style w3-text-white">ENREGISTREMENT DES ELEVES</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="./sauvegarde_eleve.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<input class="w3-input" type="text" name="nom">
			<label class="w3-text-white">NOM</label>
			<p>
			<input class="w3-input" type="text" name="prenom">
			<label class="w3-text-white">PRENOM</label>
			<p>
			<select class="w3-select w3-center" name="sexe" type="text">
					<option>Homme</option>
					<option>Femme</option>
					<option>Autre</option>
 			</select>
			<label class="w3-text-white">SEXE</label>
			<p>
			<div class="w3-container">
			<p class="w3-rest"></p>
			<input class="w3-input w3-third" type="text" name="email_eleve">
			<p></p>
			<input class="w3-input w3-third" type="text" name="telephone_eleve">
			<p class="w3-rest"></p>
			</div>
			<div class="w3-container">
			<label class="w3-text-white w3-third">N° DE TELEPHONE</label>
			<label class="w3-text-white w3-third">EMAIL DE L'ELEVE</label>
			</div>
			<p>
			<input class="w3-input" type="text" name="email_responsable">
			<label class="w3-text-white">EMAIL DU RESPOSABLE LEGAL</label>
			<input class="w3-input" type="text" name="telephone_responsable">
			<label class="w3-text-white">N° DE TELEPHONE DU RESPONSABLE LEGAL</label>
			<p>
			<input class="w3-input" type="date" name="date_naissance">
			<label class="w3-text-white">DATE DE NAISSANCE DE L'ELEVE</label>
			<p>
			<select class="w3-select w3-center" name="classe" type="int">
				<?php while ($classe=$psclasses7->fetch()) { ?>
					<option value="<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></option>
				<?php } ?>
 			</select>
			<label class="w3-text-white">CLASSE</label>
			<p>
            <button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
            </div>
		</form> 
	</div>
	<?php } ?>
    
    <div class="w3-container w3-margin w3-border entete_style">
	<h3 class="w3-opacity bold_style w3-text-white">LISTE DES ELEVES</h3>
	</div>
	
	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
				<th class="w3-center">ID</th><th class="w3-center">NOM</th><th class="w3-center">PRENOM</th><th class="w3-center">EMAIL</th><th class="w3-center">CLASSE</th><th class="w3-center">PROFIL</th><th class="w3-center">MESSAGERIE</th>
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<th colspan="2" class="w3-center">ADMINISTRATION</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php while ($etudiant=$ps->fetch()) { ?>
			<?php if ($etudiant['ID'] != 1) { ?>
            <tr>
				<td class="w3-center"><?php echo($etudiant['ID']) ?></td>
				<td class="w3-center"><?php echo($etudiant['NOM']) ?></td>
				<td class="w3-center"><?php echo($etudiant['PRENOM']) ?></td>
				<td class="w3-center"><?php echo($etudiant['EMAIL']) ?></td>
				<?php $reqclasses = "SELECT * FROM classes";
	            $psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	            $psclasses->execute(); ?>
                <?php while ($classe=$psclasses->fetch()) { ?>
                <?php if ($etudiant['CLASSE'] == $classe['ID']) { ?>
                <td class="w3-center"><a href="classes.php?id=<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></a></td>
                <?php } } ?>
                
				<td class="w3-center"><a href="profil_eleve.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<td class="w3-center"><a href="message_redaction.php?eleveid=<?php echo ($etudiant['ID'])?>"><i class="fa fa-comment w3-xlarge"></i></a></td>
				
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<td class="w3-center"><a href="modification_eleve.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a></td>
				<td class="w3-center"><a onclick="return confirm('Etes-vous sûr de supprimer ce profil');"	href="supprimer_eleve.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-trash w3-xlarge"></i></a></td>
				<?php } ?>
			</tr>
		<?php } } ?>
		</tbody>
	</table>
	</div>
</body>
</html>