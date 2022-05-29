<?php
$id=$_GET['id'];
require_once ("securite.php");
if (($_SESSION['PROFILE']['ROLE'] != 'admin') or ($_SESSION['PROFILE']['ROLE'] != 'direction')){
	header("location:accueil.php");
}
require_once ("connection_bdd.php");
$ps=$pdo->prepare("SELECT * FROM users WHERE ID=?");
$params=array($id);
$ps->execute($params);
$etudiant=$ps->fetch();

$reqeleves = "SELECT * FROM eleves";
$pseleves = $pdo->prepare($reqeleves); //objet PDO et prepare statement
$pseleves->execute();

$reqprofs = "SELECT * FROM profs";
$psprofs = $pdo->prepare($reqprofs); //objet PDO et prepare statement
$psprofs->execute();

$reqeducateurs = "SELECT * FROM educateurs";
$pseducateurs = $pdo->prepare($reqeducateurs); //objet PDO et prepare statement
$pseducateurs->execute();

$reqdirections = "SELECT * FROM directions";
$psdirections = $pdo->prepare($reqdirections); //objet PDO et prepare statement
$psdirections->execute();

$reqroles = "SELECT * FROM roles";
$psroles = $pdo->prepare($reqroles); //objet PDO et prepare statement
$psroles->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Verification Etudiant</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/w3.css">
	<link rel="stylesheet" type="text/css" href="./css/monStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php require_once("entete_site.php") ?>
	<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style w3-text-white">EDITION ET APPROBATION DES USERS</h3>
	</div>
	<div class="w3-container">
		<form method="POST" action="verifier_comptes_fin.php" enctype="multipart/form-data" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<br>
			<input class="w3-input" type="hidden" name="id" value="<?php echo($etudiant['ID']) ?>">
			<input class="w3-input" type="hidden" name="approved" value="1">
			<input class="w3-input" type="hidden" name="password" value="<?php echo($etudiant['PASSWORD']) ?>">
			<label class="w3-text-white">ID = <?php echo($etudiant['ID']) ?></label>
			<p>
			<input class="w3-input" type="text" name="nom" value="<?php echo($etudiant['NOM']) ?>">
			<label class="w3-text-white">NOM</label>
			<p>
			<input class="w3-input" type="text" name="prenom" value="<?php echo($etudiant['PRENOM']) ?>">
			<label class="w3-text-white">PRENOM</label>
			<p>
			<input class="w3-input" type="text" name="login" value="<?php echo($etudiant['LOGIN']) ?>">
			<label class="w3-text-white">LOGIN</label>
			<p>
			<input class="w3-input" type="text" name="email" value="<?php echo($etudiant['EMAIL']) ?>">
			<label class="w3-text-white">EMAIL</label>
			</br>
			<p>
            <label class="w3-text-white">ELEVES</label>
			<select class="w3-select w3-center" name="eleve" type="int">
				<?php while ($eleve=$pseleves->fetch()) { ?>
					<option value='<?php echo($eleve['ID']) ?>'><?php echo($eleve['NOM']) ?> <?php echo($eleve['PRENOM']) ?></option>
				<?php } ?>
 			</select>
			<p>
            <label class="w3-text-white">PROFESSEURS</label>
			<select class="w3-select w3-center" name="professeur" type="int">
				<?php while ($prof=$psprofs->fetch()) { ?>
					<option value="<?php echo($prof['ID']) ?>"><?php echo($prof['NOM']) ?> <?php echo($prof['PRENOM']) ?></option>
				<?php } ?>
 			</select>
			<p>
            <label class="w3-text-white">EDUCATEURS</label>
			<select class="w3-select w3-center" name="educateur" type="int">
				<?php while ($educ=$pseducateurs->fetch()) { ?>
					<option value="<?php echo($educ['ID']) ?>"><?php echo($educ['NOM']) ?> <?php echo($educ['PRENOM']) ?></option>
				<?php } ?>
			</select>
			<p>
            <label class="w3-text-white">DIRECTIONS</label>
			<select class="w3-select w3-center" name="direction" type="int">
				<?php while ($direc=$psdirections->fetch()) { ?>
					<option value="<?php echo($direc['ID']) ?>"><?php echo($direc['NOM']) ?> <?php echo($direc['PRENOM']) ?></option>
				<?php } ?>
 			</select>
			<p>
            <label class="w3-text-white">ROLE</label>
			<select class="w3-select w3-center" name="role" type="int">
				<?php while ($role=$psroles->fetch()) { ?>
					<option><?php echo($role['ROLE']) ?></option>
				<?php } ?>
 			</select>
			<br>
			<p>
			<button class="w3-btn w3-dark-grey" type="submit">Enregistrer</button>
		</form> 
	</div>
</body>
</html>