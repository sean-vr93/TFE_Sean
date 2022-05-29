<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	$req = "SELECT * FROM educateurs_classes";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();
	
	$reqclasses = "SELECT * FROM classes";
	$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	$psclasses->execute();
    $reqclasses7 = "SELECT * FROM classes";
    $psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
    $psclasses7->execute();
	$reqeducs7 = "SELECT * FROM educateurs";
    $pseducs7 = $pdo->prepare($reqeducs7); //objet PDO et prepare statement
    $pseducs7->execute();


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
		<h3 class="w3-opacity bold_style w3-text-white">ENREGISTREMENT DES PROFS CLASSES MATIERES</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="./sauvegarde_educ_classe.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<p>
			<select class="w3-select w3-center" name="educ" type="int">
				<?php while ($prof=$pseducs7->fetch()) { ?>
					<?php if ($prof['ID'] != 1 ) { ?>
					<option value="<?php echo($prof['ID']) ?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } } ?>
 			</select>
			<label class="w3-text-white">EDUCATEUR</label>
			<p>
			<select class="w3-select w3-center" name="classe" type="int">
				<?php while ($classe=$psclasses7->fetch()) { ?>
					<?php if ($classe['ID'] != 1 ) { ?>
					<option value="<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></option>
				<?php } } ?>
 			</select>
			<label class="w3-text-white">CLASSE</label>
			<p>
            <button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
            </div>
		</form> 
	</div>
	<?php } ?>
    
    <div class="w3-container w3-margin w3-border entete_style">
	<h3 class="w3-opacity bold_style w3-text-white">LISTE DES EDUCS RELATIONNES</h3>
	</div>
	
	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
				<th class="w3-center">ID</th><th class="w3-center">EDUC</th><th class="w3-center">CLASSE</th>
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<th colspan="2" class="w3-center">ADMINISTRATION</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php while ($etudiant=$ps->fetch()) { ?>
            <tr>
				<td class="w3-center"><?php echo($etudiant['ID']) ?></td>
				
				<?php $reqpro= "SELECT * FROM educateurs";
	            $pspro = $pdo->prepare($reqpro); //objet PDO et prepare statement
	            $pspro->execute(); ?>
                <?php while ($educa=$pspro->fetch()) { ?>
                <?php if ($etudiant['EDUCATEUR'] == $educa['ID']) { ?>
                <td class="w3-center"><?php echo($educa['NOM']) ?> <?php echo($educa['PRENOM']) ?></td>
                <?php } } ?>
			
				<?php $reqclasses = "SELECT * FROM classes";
	            $psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	            $psclasses->execute(); ?>
                <?php while ($classe=$psclasses->fetch()) { ?>
                <?php if ($etudiant['CLASSE'] == $classe['ID']) { ?>
                <td class="w3-center"><?php echo($classe['CLASSE']) ?></td>
                <?php } } ?>
		
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<td class="w3-center"><a href="modification_educ_classe.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a></td>
				<td class="w3-center"><a onclick="return confirm('Etes-vous sûr de supprimer ce profil');"	href="supprimer_educ_classe.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-trash w3-xlarge"></i></a></td>
				<?php } ?>
			</tr>
		<?php }  ?>
		</tbody>
	</table>
	</div>
</body>
</html>