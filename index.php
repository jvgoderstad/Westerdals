<?php
//REQUIREMENTS FOR ALL PAGES-->
require 'functions.php';
session_start();
//REQUIREMENTS FOR ALL PAGES-->

if (isset($_POST['brukernavn']) && isset($_POST['passord'])){
	if (!empty($_POST['brukernavn']) && !empty($_POST['passord'])){
		login($db, $_POST['brukernavn'], $_POST['passord'], 'home.php');
	}
}

echo '
<html>
<head>
    <link rel="stylesheet" type="text/css" href="LoginCSS.css">
</head>
<body>
	
	<div id="logo"><img src= "SvartLogo.png" height = "500px" width = "1000px"/>
	</div>

	<div class ="formholder">
		<form method="POST" action="index.php">
			<fieldset>
			<legend>Innlogging:</legend>
				<table  CELLPADDING="2">
					<tr>
						<td>Brukernavn:</td><td><input type="text" name="brukernavn" placeholder="Brukernavn" maxlength="45"></td>
					</tr>

					<tr>
						<td>Password:</td><td><input type="password" name="passord" placeholder="Passord" maxlength="30"></td>
					</tr>
				</table>
			</fieldset>
			<input type="submit" value="Log In" class="btn">
		</form>
		<form action="registrer.php">
			<input type="submit" value="Registrer"/>
		</form>
	</div>
</body>
</body>
</html>
';



?>




