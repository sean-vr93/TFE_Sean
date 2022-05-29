<!DOCTYPE html>
<html>
<head>
	<title>ITCM LOGIN</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/w3.css">
	<link rel="stylesheet" type="text/css" href="./css/monStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	body  {
  background-image: url("https://cardinalmercier.be/secondaire/wp-content/uploads/2018/03/cropped-ICM_2018_facade_11-2.jpg");
}
</style>
<body>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="w3-container w3-third w3-center"></div>
	
	<div class="w3-container w3-third w3-center">
		<div class="w3-container w3-margin w3-border entete_style w3-text-white w3-center w3-round-xxlarge">
			<h3 class="w3-opacity bold_style">INSTITUT TECHNIQUE CARDINAL MERCIER</h3>
		</div>
		
		<div class="w3-container w3-border w3-round-xxlarge w3-center w3-padding entete_style ">
			<form method="POST" action="./authentifier.php" class="w3-container">
				<h4 class="w3-text-white">Veuillez remplir les champs suivants :</h4>
				<br>
				<input class="w3-input w3-round-xlarge" type="text" name="login">
				<label class="w3-text-white">LOGIN</label>
				<p>
				<input class="w3-input w3-round-xlarge" type="password" name="password">
				<label class="w3-text-white">MOT DE PASSE</label>
				<p>
				<button class="w3-btn w3-dark-grey w3-round-xxlarge" type="submit">Se connecter</button>
			</form> 
		
		<div class="w3-container">
		<form action="inscription_user.php", class="w3-container">
			<button class="w3-btn w3-dark-grey w3-round-xxlarge" type="submit">S'inscrire</button>
		</form>
		<p>
		</div>
		
		</div>
	</div>
</body>
</html>