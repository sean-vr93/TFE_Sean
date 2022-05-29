<?php
//myanimelist.net
//fansub
	$id=$_GET['id'];
	require_once ("securite.php");
	require_once ("connection_bdd.php");
	$ps=$pdo->prepare("SELECT * FROM profs WHERE ID=?");
	$params=array($id);
	$ps->execute($params);
	$etudiant=$ps->fetch();
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
	<div class="w3-container">
		<div class="w3-card-4 w3-light-grey w3-left w3-margin-right w3-cell" style="width:20%"> <!-- style="width:20%" id="hauteur"-->
    		<img src="./images/<?php echo($etudiant['PHOTO']) ?>" style="width:100%" >
    		<br>
      		<div class="w3-container w3-dark-grey">
      			<h5><b><?php echo ($etudiant['NOM']) ?></b></h5>
				<p><?php echo ($etudiant['PRENOM']) ?></p>
      			<p><?php echo ($etudiant['EMAIL']) ?></p>
    		</div>
  		</div>
  		<div class="w3-cell w3-padding">
  			<h5><b><?php echo ($etudiant['NOM']) ?></b></h5>
			<p><b><?php echo ($etudiant['PRENOM']) ?></b></p>
		</div>
	</div>
</body>
</html>
