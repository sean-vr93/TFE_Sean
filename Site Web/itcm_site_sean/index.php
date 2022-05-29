<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");
	$req = "SELECT * FROM actualitees ORDER BY ID DESC";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();
?>

<html>
<head>
	<title>Accueil ITCM</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/w3.css">
	<link rel="stylesheet" type="text/css" href="./css/monStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php require_once("entete_site.php") ?>
	<div class="w3-container w3-margin w3-border entete_style w3-round-large">
		<h3 class="w3-opacity bold_style w3-text-white">ACTUALITEES</h3>
	</div>
	<?php while ($actu=$ps->fetch()) { ?>
		<div class="w3-container w3-quarter "></div>
		<div class="w3-container w3-margin w3-border w3-round-large w3-half entete_style">
		<p>
		<h7 class="w3-opacity w3-text-white"><?php echo($actu['REDACTEUR_NAME'])?></h7>
		<h4 class="w3-opacity bold_style w3-text-white"> TITRE : <?php echo($actu['TITRE'])?></h4>
		<p>
		<p class="w3-text-white"><?php echo($actu['TEXTE'])?></p>
		<p>
		<label class="w3-opacity w3-text-white"><?php echo($actu['MOMENT'])?></label>
	</div>
	<?php } ?>
</body>
</html>
