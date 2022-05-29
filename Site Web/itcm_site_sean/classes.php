<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	$id=$_GET['id'];
	$req = "SELECT * FROM eleves WHERE CLASSE=$id";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();
	$reqclasses = "SELECT * FROM classes WHERE ID=?";
	$params=array($id);
	$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	$psclasses->execute($params);
	$classes = $psclasses->fetch();
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
	<h3 class="w3-opacity bold_style w3-text-white">LISTE DES ETUDIANTS : <?php echo($classes['CLASSE'])?></h3>
	</div>
	
	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
				<th>ID</th><th>NOM</th><th>PRENOM</th><th>EMAIL</th><th>PHOTO</th><th>PROFIL</th><th>MESSAGERIE</th>
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<th colspan="2">ADMINISTRATION</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php while ($etudiant=$ps->fetch()) { ?>
			<tr>
				<td><?php echo($etudiant['ID']) ?></td>
				<td><?php echo($etudiant['NOM']) ?></td>
				<td><?php echo($etudiant['PRENOM']) ?></td>
				<td><?php echo($etudiant['EMAIL']) ?></td>
				<td><img src="./images/<?php echo($etudiant['PHOTO']) ?>" width="100" height="100"></td>
				
				<td><a href="profil_eleve.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-eye w3-xlarge"></i></a></td>
				<td><a href="message.php?id=<?php echo ($etudiant['ID'])?>"><i class="fa fa-comment w3-xlarge"></i></a></td>
				
				<?php if ($_SESSION['PROFILE']['ROLE']=='admin'){ ?>
				<td><a href="modification_eleve.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-edit w3-xlarge"></i></a></td>
				<td><a onclick="return confirm('Etes-vous sûr de supprimer ce profil');"	href="supprimeEtudiant.php?id=<?php echo($etudiant['ID'])?>"><i class="fa fa-trash w3-xlarge"></i></a></td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	</div>
</body>
</html>
