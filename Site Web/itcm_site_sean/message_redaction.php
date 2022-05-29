<?php
	require_once ("securite.php");
	require_once ("connection_bdd.php");
	
	$eleveid = $_GET['eleveid'];
	$profid = $_GET['profid'];
	$educid = $_GET['educid'];
	$directionid = $_GET['directionid'];
	$classeid = $_GET['classeid'];
	$usermessage = 0;
	$classemessage = 0;

	if (($eleveid != "") and ($profid == "") and ($educid == "") and ($directionid == "") and ($classeid == "") and ($eleveid != 1)) {
		$requsers7 = "SELECT * FROM users WHERE LIEN_ELEVE = $eleveid";
    	$psusers7 = $pdo->prepare($requsers7); //objet PDO et prepare statement
    	$psusers7->execute(); 
		$usermessage = 1;
	}
	elseif (($eleveid == "") and ($profid != "") and ($educid == "") and ($directionid == "") and ($classeid == "") and ($profid != 1)) {
		$requsers7 = "SELECT * FROM users WHERE LIEN_PROF = $profid";
    	$psusers7 = $pdo->prepare($requsers7); //objet PDO et prepare statement
    	$psusers7->execute();
		$usermessage = 1;
	}
	elseif (($eleveid == "") and ($profid == "") and ($educid != "") and ($directionid == "") and ($classeid == "") and ($educid != 1)) {
		$requsers7 = "SELECT * FROM users WHERE LIEN_EDUCATEUR = $educid";
    	$psusers7 = $pdo->prepare($requsers7); //objet PDO et prepare statement
    	$psusers7->execute();
		$usermessage = 1;
	}
	elseif (($eleveid == "") and ($profid == "") and ($educid == "") and ($directionid != "") and ($classeid == "") and ($directionid != 1)) {
		$requsers7 = "SELECT * FROM users WHERE LIEN_DIRECTION = $directionid";
    	$psusers7 = $pdo->prepare($requsers7); //objet PDO et prepare statement
    	$psusers7->execute();
		$usermessage = 1;
	}
	elseif (($eleveid == "") and ($profid == "") and ($educid == "") and ($directionid == "") and ($classeid != "")) {
		$reqclasses7 = "SELECT * FROM classes WHERE ID=$classeid";
		$psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
		$psclasses7->execute();
		$classemessage = 1;
	}
	else {
		$requsers7 = "SELECT * FROM users";
    	$psusers7 = $pdo->prepare($requsers7); //objet PDO et prepare statement
    	$psusers7->execute();	
		$reqclasses7 = "SELECT * FROM classes";
    	$psclasses7 = $pdo->prepare($reqclasses7); //objet PDO et prepare statement
    	$psclasses7->execute();
	}
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
	<div class="w3-container w3-margin">
		<FORM method="post" action="message_redaction_suite.php">
		
		<input type="hidden" name="name_user" value="<?php echo($_SESSION['PROFILE']['NOM'])?> <?php echo($_SESSION['PROFILE']['PRENOM'])?>">
		<input type="hidden" name="id_user" value="<?php echo($_SESSION['PROFILE']['ID'])?>"> 
		<p>
		<?php if (($eleveid == "") and ($profid == "") and ($educid == "") and ($directionid == "") and ($classeid == "")) { ?>
		<?php if (($_SESSION['PROFILE']['LIEN_PROF'] != 1) or ($_SESSION['PROFILE']['LIEN_DIRECTION'] != 1) or ($_SESSION['PROFILE']['LIEN_EDUCATEUR'] != 1) or ($_SESSION['PROFILE']['ROLE'] == 'admin')) {  ?>
		<label class="w3-text-white">Envoyer un message à un utilisateur ou une classe ou rédiger une actualité ?</label>
		<p>
		<input class="w3-radio" type="radio" id="actu_selection" name="choix_destinataire" value="Actu">
  		<label class="w3-text-white" for="actu_selection">Une actualité (visible par tous)</label>
		<br>
		<input class="w3-radio" type="radio" id="user_selection" name="choix_destinataire" value="User">
  		<label class="w3-text-white" for="user_selection">Un utilisateur</label>
		<br>
		<input class="w3-radio" type="radio" id="classe_selection" name="choix_destinataire" value="Classe">
  		<label class="w3-text-white" for="classe_selection">Une classe</label><br>
		<?php } } ?>
		<p>
		<?php if ($usermessage == 1) { ?>
			<input type="hidden" name="forcing_user" value="User"> 
		<?php } ?>
		<?php if ($classemessage == 1) { ?>
			<input type="hidden" name="forcing_classe" value="Classe1"> 
		<?php } ?>
		<?php if (($_SESSION['PROFILE']['LIEN_PROF'] != 1) or ($_SESSION['PROFILE']['LIEN_DIRECTION'] != 1) or ($_SESSION['PROFILE']['LIEN_EDUCATEUR'] != 1) or ($_SESSION['PROFILE']['ROLE'] == 'admin')) {  ?>
		<?php if ($usermessage == 0) { ?>
		<label class="w3-text-white">Classe :</label>
		<p>
		<select class="w3-select w3-center w3-quarter" name="classe" type="int">
				<?php while ($classe=$psclasses7->fetch()) { ?>
					<option value="<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></option>
				<?php } ?>
 		</select>
		<br>
		<br>
		 <p>
		<?php } } ?>
		<?php if ($classemessage == 0) { ?>
		<label class="w3-text-white">Utilisateur :</label>
		<p>
		<select class="w3-select w3-center w3-quarter" name="id_destinataire" type="int">
				<?php while ($utilisateur=$psusers7->fetch()) { ?>
					<option value="<?php echo($utilisateur['ID']) ?>"><?php echo($utilisateur['NOM']) ?> <?php echo($utilisateur['PRENOM']) ?></option>
				<?php } ?>
 		</select>
		 <br>
		<br>
		 <p>
		<?php } ?>
		<label class="w3-text-white">Titre :</label>
		<p>
		<input class="w3-third" type="text", name="titre">
		<br>
		<br>
		 <p>
		<label class="w3-text-white">Message :</label>
        <p>
        <TEXTAREA name="message" rows=10 cols=100></TEXTAREA>
		<p>
		<button class="w3-btn w3-dark-grey" type="submit">Envoyer</button>
		</FORM>
	</div>
</body>
</html>