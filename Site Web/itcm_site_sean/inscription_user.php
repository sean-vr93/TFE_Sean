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
	<div class="w3-container w3-margin w3-border entete_style">
		<h3 class="w3-opacity bold_style w3-text-white">INSTITUT TECHNIQUE CARDINAL MERCIER</h3>
	</div>
    <div class="w3-container">
		<form action="index.php", class="w3-container">
			<button class="w3-btn w3-dark-grey" type="submit">Retourner à la Page de Connexion</button>
		</form>
	</div>
	<div class="w3-container">
		<form method="POST" action="./inscription_user_suite.php" class="w3-container">
			<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
			<br>
			<input class="w3-input" type="text" name="nom">
			<label class="w3-text-white">NOM</label>
			<p>
            <input class="w3-input" type="text" name="prenom">
			<label class="w3-text-white">PRENOM</label>
			<p>
            <input class="w3-input" type="text" name="email">
			<label class="w3-text-white">ADRESSE EMAIL</label>
			<p>
            <input class="w3-input" type="text" name="login">
			<label class="w3-text-white">LOGIN</label>
			<p>
			<input class="w3-input" type="password" name="password">
			<label class="w3-text-white">MOT DE PASSE</label>
			<p>
			</br>
			<button class="w3-btn w3-dark-grey" type="submit">S'inscrire</button>
		</form> 
	</div>
</body>
</html>