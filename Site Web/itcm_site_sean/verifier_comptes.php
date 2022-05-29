<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
		header("location:accueil.php");
	}

	$req = "SELECT * FROM users WHERE APPROVED=1";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();

	$reqdirections = "SELECT * FROM directions";
	$psdirections = $pdo->prepare($reqdirections); //objet PDO et prepare statement
	$psdirections->execute();

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
	<h3 class="w3-opacity bold_style w3-text-white">LISTE DES COMPTES APPROUVES</h3>
	</div>
	
	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
				<th class="w3-center">ID</th><th class="w3-center">APPROUVER</th><th class="w3-center">NOM</th><th class="w3-center">PRENOM</th><th class="w3-center">EMAIL</th><th class="w3-center">LOGIN</th><th class="w3-center">ROLE</th><th class="w3-center">LIEN ELEVE</th><th class="w3-center">LIEN PROF</th><th class="w3-center">LIEN EDUCATEUR</th><th class="w3-center">LIEN DIRECTION</th>
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<th colspan="3" class="w3-center">ADMINISTRATION</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php while ($etudiant=$ps->fetch()) { ?>
			<?php if($etudiant['ID'] != 1) { ?>
			<tr>
				<td class="w3-center"><?php echo($etudiant['ID']) ?></td>
				<td class="w3-center"><?php echo($etudiant['APPROVED']) ?></td>
				<td class="w3-center"><?php echo($etudiant['NOM']) ?></td>
				<td class="w3-center"><?php echo($etudiant['PRENOM']) ?></td>
				<td class="w3-center"><?php echo($etudiant['EMAIL']) ?></td>
				<td class="w3-center"><?php echo($etudiant['LOGIN']) ?></td>
				<td class="w3-center"><?php echo($etudiant['ROLE']) ?></td>
				
				<?php if ( 1 == $etudiant['LIEN_ELEVE']) { ?>
					<td class="w3-center">AUCUN</td>
				<?php }  ?>
				<?php if ( 1 != $etudiant['LIEN_ELEVE']) { ?>
					<td class="w3-center"><a href="profil_eleve.php?id=<?php echo($etudiant['LIEN_ELEVE'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<?php } ?>
			
				<?php if ( 1 == $etudiant['LIEN_PROF']) { ?>
					<td class="w3-center">AUCUN</td>
				<?php }  ?>
				<?php if ( 1 != $etudiant['LIEN_PROF']) { ?>
					<td class="w3-center"><a href="profil_prof.php?id=<?php echo($etudiant['LIEN_PROF'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<?php } ?>

				<?php if ( 1 == $etudiant['LIEN_EDUCATEUR']) { ?>
					<td class="w3-center">AUCUN</td>
				<?php }  ?>
				<?php if ( 1 != $etudiant['LIEN_EDUCATEUR']) { ?>
					<td class="w3-center"><a href="profil_educateur.php?id=<?php echo($etudiant['LIEN_EDUCATEUR'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<?php } ?>

				<?php if ( 1 == $etudiant['LIEN_DIRECTION']) { ?>
					<td class="w3-center">AUCUN</td>
				<?php }  ?>
				<?php if ( 1 != $etudiant['LIEN_DIRECTION']) { ?>
					<td class="w3-center"><a href="profil_direction.php?id=<?php echo($etudiant['LIEN_DIRECTION'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<?php } ?>

				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
                <td class="w3-center">
                    <a href="verifier_comptes_suite.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a>
                </td>
				<td class="w3-center"><a onclick="return confirm('Etes-vous sûr de supprimer ce profil');"	href="supprimer_user_approved.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-trash w3-xlarge"></i></a></td>
				<?php } ?>
			</tr>
		<?php } } ?>
		</tbody>
	</table>
	</div>
</body>
</html>