<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	$req = "SELECT * FROM classes";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();
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
	
		<?php if (($_SESSION['PROFILE']['ROLE'] == 'admin') or ($_SESSION['PROFILE']['ROLE'] == 'direction')){ ?>
		<div class="w3-container w3-margin w3-border entete_style">
			<h3 class="w3-opacity bold_style w3-text-white">ENREGISTREMENT DES CLASSES</h3>
		</div>
		
		<div class="w3-container">
			<form method="POST" action="./sauvegarde_classe.php" enctype="multipart/form-data" class="w3-container">
				<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
				<input class="w3-input" type="text" name="nom" required>
				<label class="w3-text-white">NOM DE LA CLASSE</label>
				<p>
				<button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
				</div>
			</form> 
		</div>
		<?php } ?>
		
		<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style w3-text-white">LISTE DES CLASSES</h3>
		</div>
		<div class="w3-container">
		<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
				<th class="w3-center">ID</th><th class="w3-center">NOM DE LA CLASSE</th><th class="w3-center">TITULAIRE</th><th class="w3-center">REGARDER</th><th class="w3-center">MODIFIER HORAIRE</th>
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
				<td class="w3-center"><?php echo($etudiant['CLASSE']) ?></td>
				<?php if ($etudiant['TITULAIRE'] == 1) { ?>
				<td class="w3-center">AUCUN TITULAIRE</td>
				<?php } ?>
				
				<?php $reqprofs = "SELECT * FROM profs";
	            $psprofs = $pdo->prepare($reqprofs); //objet PDO et prepare statement
	            $psprofs->execute(); ?>
                
				<?php while ($prof=$psprofs->fetch()) { ?>
                <?php if ($etudiant['TITULAIRE'] != 1) { ?>
				<?php if ($etudiant['TITULAIRE'] == $prof['ID']) { ?>
				<td class="w3-center"><a href="profil_prof.php?id=<?php echo($prof['ID'])?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></a></td>
                <?php } } }  ?>
				

				<td class="w3-center"><a href="classes.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<td class="w3-center"><a href="classes_horaire.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a></td>

				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<td class="w3-center"><a href="modification_classe.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a></td>
				<td class="w3-center"><a onclick="return confirm('Etes-vous sûr de supprimer ce profil');"	href="supprimer_classe.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-trash w3-xlarge"></i></a></td>
				<?php } ?>
			</tr>
		<?php } } ?>
		</tbody>
		</table>
		</div>
</body>
</html>