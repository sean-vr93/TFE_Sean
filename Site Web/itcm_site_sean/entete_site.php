<?php
require_once ("securite.php");
require_once ("connection_bdd.php");
$reqclasses = "SELECT * FROM classes";
$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
$psclasses->execute();

$reqclasses2 = "SELECT * FROM classes";
$psclasses2 = $pdo->prepare($reqclasses2); //objet PDO et prepare statement
$psclasses2->execute();
?>

<div class="class=w3-bar w3-border w3-light-grey w3-margin w3-card-4"> 
	<a href="index.php" class="w3-bar-item w3-button bold_style"><i class="fa fa-home"></i></a>
	
	<?php if (($_SESSION['PROFILE']['ROLE'] == 'admin') or ($_SESSION['PROFILE']['ROLE'] == 'direction')){ ?>
	<div class="w3-dropdown-hover w3-hide-small">
		<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Administration">ADMIN</button>     
		<div class="w3-dropdown-content w3-bar-block w3-card-4">
			<a href="verifier_comptes.php" class="w3-bar-item w3-button w3-hover-red">Vérifier Les Comptes</a>
			<a href="verifier_nouveaux_comptes.php" class="w3-bar-item w3-button w3-hover-red">Vérifier Les Nouveaux Comptes</a>
		</div>
	</div>
	<?php } ?>

	<?php  if (($_SESSION['PROFILE']['ROLE'] == 'prof') or ($_SESSION['PROFILE']['ROLE'] == 'direction') or ($_SESSION['PROFILE']['ROLE'] == 'educateur') or ($_SESSION['PROFILE']['ROLE'] == 'admin')) { ?>
	<div class="w3-dropdown-hover w3-hide-small">
		<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Gérer l'école">BASE DE DONNEE</button>     
		<div class="w3-dropdown-content w3-bar-block w3-card-4">
			<a href="afficher_eleves.php" class="w3-bar-item w3-button w3-hover-red">Afficher les élèves</a>
			<a href="afficher_profs.php" class="w3-bar-item w3-button w3-hover-red">Afficher les professeurs</a>
			<a href="afficher_educateurs.php" class="w3-bar-item w3-button w3-hover-red">Afficher les éducateurs</a>
			<a href="afficher_directions.php" class="w3-bar-item w3-button w3-hover-red">Afficher les membres de la direction</a>
			<a href="afficher_classes.php" class="w3-bar-item w3-button w3-hover-red">Afficher les classes</a>
			<a href="afficher_matieres.php" class="w3-bar-item w3-button w3-hover-red">Afficher les matières</a>
		</div>
	</div>
	<?php } ?>

	<?php  if (($_SESSION['PROFILE']['ROLE'] == 'direction') or ($_SESSION['PROFILE']['ROLE'] == 'admin')) { ?>
	<div class="w3-dropdown-hover w3-hide-small">
		<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Gérer l'école">DIRECTION</button>     
		<div class="w3-dropdown-content w3-bar-block w3-card-4">
			<a href="afficher_prof_classe_matiere.php" class="w3-bar-item w3-button w3-hover-red">Prof Classe Matière</a>
			<a href="afficher_educ_classe.php" class="w3-bar-item w3-button w3-hover-red">Educateur Classe</a>
		</div>
	</div>
	<?php } ?>
	
	<?php if ($_SESSION['PROFILE']['ROLE'] == 'prof') { ?>
	
	<?php $lienprof = $_SESSION['PROFILE']['LIEN_PROF'];
	$reqprofsclasses = "SELECT * FROM profs_classes_matieres WHERE PROF=$lienprof";
	$psprofsclassses = $pdo->prepare($reqprofsclasses);
	$psprofsclassses->execute(); ?>

	<div class="w3-dropdown-hover w3-hide-small">
	<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Classes">MES CLASSES</button>     
	<div class="w3-dropdown-content w3-bar-block w3-card-4">
		<?php while ($profclasse=$psprofsclassses->fetch()) { ?>	
			<?php if ($profclasse['PROF']==$lienprof) { ?>
				<?php $reqclasses = "SELECT * FROM classes";
				$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
				$psclasses->execute(); ?>
				<?php $reqmatieres = "SELECT * FROM matieres";
				$psmatieres = $pdo->prepare($reqmatieres); //objet PDO et prepare statement
				$psmatieres->execute(); ?>
				<?php while ($classe=$psclasses->fetch())  { ?>
				<?php if ($profclasse['CLASSE']==$classe['ID']) { ?>
				<?php while ($matiere=$psmatieres->fetch()) { ?>
				<?php if ($profclasse['MATIERE']==$matiere['ID']) { ?>
					<a href="./classes.php?id=<?php echo($classe['ID'])?>" class="w3-bar-item w3-button w3-hover-red"><?php echo($classe['CLASSE']) ?> <?php echo($matiere['MATIERE']) ?></a>
			<?php } } } } } } ?>
		</div>
	</div>
	<?php } ?>
	

	<?php if ($_SESSION['PROFILE']['ROLE'] == 'educateur') { ?>
	
		<?php $lieneduc = $_SESSION['PROFILE']['LIEN_EDUCATEUR'];
		$requeducsclasses = "SELECT * FROM educateurs_classes WHERE EDUCATEUR=$lieneduc";
		$pseducsclasses = $pdo->prepare($requeducsclasses);
		$pseducsclasses->execute(); ?>
	
	<div class="w3-dropdown-hover w3-hide-small">
		<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Classes">MES CLASSES</button>     
		<div class="w3-dropdown-content w3-bar-block w3-card-4">
			<?php while ($educclasse=$pseducsclasses->fetch()) { ?>	
				<?php if ($educclasse['EDUCATEUR']==$lieneduc) { ?>
					<?php $reqclasses = "SELECT * FROM classes";
					$psclasses = $pdo->prepare($reqclasses); //objet PDO et prepare statement
					$psclasses->execute(); ?>
					<?php while ($classe=$psclasses->fetch())  { ?>
					<?php if ($educclasse['CLASSE']==$classe['ID']) { ?>
					<a href="./classes.php?id=<?php echo($classe['ID'])?>" class="w3-bar-item w3-button w3-hover-red"><?php echo($classe['CLASSE']) ?></a>
			<?php } } } } ?>
		</div>
	</div>
	<?php } ?>

	<?php if (($_SESSION['PROFILE']['ROLE'] == 'eleve')) { ?>
		<?php $reqclasses3 = "SELECT * FROM classes";
		$psclasses3 = $pdo->prepare($reqclasses3); //objet PDO et prepare statement
		$psclasses3->execute(); 
		
		$lieneleve = $_SESSION['PROFILE']['LIEN_ELEVE'];
		$ps70=$pdo->prepare("SELECT * FROM eleves WHERE ID=$lieneleve");
		$params70=array();
		$ps70->execute($params70);
		$etudiant70=$ps70->fetch(); ?>

			<?php while ($classe=$psclasses3->fetch())  { ?>
			<?php if ($etudiant70['CLASSE'] == $classe['ID']) { ?>
				<a href="./classes.php?id=<?php echo($classe['ID'])?>" class="w3-bar-item w3-button w3-hover-dark-grey bold_style"><?php echo($classe['CLASSE']) ?></a>
			<?php } } ?>
	<?php } ?>

	<div class="w3-dropdown-hover w3-hide-small">
		<button class="w3-bar-item w3-button w3-hover-red bold_style" title="Gérer l'école">MESSAGES</button>     
		<div class="w3-dropdown-content w3-bar-block w3-card-4">
			<a href="messages.php" class="w3-bar-item w3-button w3-hover-red">Mes messages</a>
			<a href="message_redaction.php" class="w3-bar-item w3-button w3-hover-red">Ecrire un message</a>
			<a href="messages_sent.php" class="w3-bar-item w3-button w3-hover-red">Messages envoyés</a>
		</div>
	</div>
	
	<a href="logout.php" class="w3-bar-item w3-button w3-right w3-hover-red bold-style">DÉCONNEXION</a>

	<?php if (($_SESSION['PROFILE']['ROLE'] == 'eleve') and ($_SESSION['PROFILE']['LIEN_ELEVE']!=1)){ ?>
		<a href="profil_eleve.php?id=<?php echo($_SESSION['PROFILE']['LIEN_ELEVE'])?>" class="w3-bar-item w3-button w3-hover-dark-grey w3-right">Mon Profil ELEVE</a> 
	<?php } ?>
	<?php if (($_SESSION['PROFILE']['ROLE'] == 'prof') and ($_SESSION['PROFILE']['LIEN_PROF']!=1)){ ?>
		<a href="profil_prof.php?id=<?php echo($_SESSION['PROFILE']['LIEN_PROF'])?>" class="w3-bar-item w3-button w3-hover-dark-grey w3-right">Mon Profil PROFESSEUR</a> 
	<?php } ?>
	<?php if (($_SESSION['PROFILE']['ROLE'] == 'educateur') and ($_SESSION['PROFILE']['LIEN_EDUCATEUR']!=1)){ ?>
		<a href="profil_educateur.php?id=<?php echo($_SESSION['PROFILE']['LIEN_EDUCATEUR'])?>" class="w3-bar-item w3-button w3-hover-dark-grey w3-right">Mon Profil EDUCATEUR</a> 
	<?php } ?>
	<?php if (($_SESSION['PROFILE']['ROLE'] == 'direction') and ($_SESSION['PROFILE']['LIEN_DIRECTION']!=1)){ ?>
		<a href="profil_direction.php?id=<?php echo($_SESSION['PROFILE']['LIEN_DIRECTION'])?>" class="w3-bar-item w3-button w3-hover-dark-grey w3-right">Mon Profil DIRECTION</a> 
	<?php } ?>

</div> 
