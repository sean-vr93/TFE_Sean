<?php
	require_once ("connection_bdd.php");
	require_once ("securite.php");

	$user_id = $_SESSION['PROFILE']['ID'];
	
	$req = "SELECT * FROM messages WHERE REDACTEUR_ID=$user_id ORDER BY ID DESC";
	$ps = $pdo->prepare($req); //objet PDO et prepare statement
	$ps->execute();

	$reqclasses = "SELECT * FROM classes";
	$psclasses = $pdo->prepare($reqclasses); 
	$psclasses->execute();
	$reqclasses7 = "SELECT * FROM classes";
	$psclasses7 = $pdo->prepare($reqclasses7);
	$psclasses7->execute();

	$req10 = "SELECT * FROM config_ecole WHERE ID=1";
    $ps10 = $pdo->prepare($req10); 
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

	<div class="w3-container w3-margin w3-border entete_style">
	<h3 class="w3-opacity bold_style w3-text-white">MESSAGES ENVOYES</h3>
	</div>
	
	<div class="w3-container">
	<table class="w3-table-all w3-hoverable">
		<thead>
			<tr class="w3-grey">
                <th class="w3-center">NOM</th><th class="w3-center">TITRE</th><th class="w3-center">MESSAGE</th><th class="w3-center">DESTINATAIRE</th><th class="w3-center">HEURE</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($etudiant=$ps->fetch()) { ?>
            <tr>
            <td class="w3-center"><?php echo($etudiant['REDACTEUR_NOM']) ?></td>
            <td class="w3-center"><?php echo($etudiant['TITRE']) ?></td>
			<td class="w3-center"><a href="message_details.php?id=<?php echo($etudiant['ID']) ?>">Voir le message</a></td>
            
			
			<?php if ($etudiant['DESTINATAIRE_CLASSE'] != NULL) { ?>
			<?php $reqclasses = "SELECT * FROM classes";
	        $psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	        $psclasses->execute(); ?>
            <?php while ($classe=$psclasses->fetch()) { ?>
            <?php if ($etudiant['DESTINATAIRE_CLASSE'] == $classe['ID']) { ?>
            <td class="w3-center"><a href="classes.php?id=<?php echo($classe['ID']) ?>"><?php echo($classe['CLASSE']) ?></a></td>
            <?php } } } ?>
            <?php if ($etudiant['DESTINATAIRE_ID'] != NULL) { ?>
			<?php $reqclasses = "SELECT * FROM users";
	        $psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
	        $psclasses->execute(); ?>
            <?php while ($classe=$psclasses->fetch()) { ?>
            <?php if ($etudiant['DESTINATAIRE_ID'] == $classe['ID']) { ?>
            <td class="w3-center"><?php echo($classe['NOM']) ?> <?php echo($classe['PRENOM']) ?></a></td>
			<?php } } }  ?>

			<td class="w3-center"><?php echo($etudiant['MOMENT']) ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	</div>
</body>
</html>
