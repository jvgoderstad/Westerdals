<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
echo '<script type="text/javascript" language="JavaScript">
		function checkEmail(theForm) {
			if (theForm.email_1.value != theForm.email_2.value) {
				document.getElementById("emailForm").style.background = "red";
				return false;
			}
			if (theForm.passord_1.value != theForm.passord_2.value) {
				document.getElementById("passordForm").style.background = "red";
				return false;
			}
			return true;
		}
	</script>';
drawHeader($db);

if (isset($_POST['fornavn']) && isset($_POST['etternavn']) && isset($_POST['studentnummer']) && isset($_POST['brukernavn']) && isset($_POST['email_1']) && isset($_POST['email_2']) && isset($_POST['passord_1']) && isset($_POST['passord_2'])){
	if (!empty($_POST['fornavn']) && !empty($_POST['etternavn']) && !empty($_POST['studentnummer']) && !empty($_POST['brukernavn']) && !empty($_POST['email_1']) && !empty($_POST['email_2']) && !empty($_POST['passord_1']) && !empty($_POST['passord_2'])){
		addUser($db, $_POST['brukernavn'], $_POST['passord_1'], $_POST['fornavn'], $_POST['etternavn'], $_POST['email_1'], $_POST['studentnummer']);

		echo '
			Du har blitt registrert! Fortsett til Alle utvalg!
		';

	} else {
		echo "Fyll inn alle feltene!";
	}
} else {
	echo '
	<form method="POST" action="registrer.php" class="pure-form pure-form-aligned" onsubmit="return checkEmail(this);">
	<fieldset>
		<div class="pure-control-group">
			<label for="name">Fornavn</label>
			<input type="text" class="pure-input-1-3"  name="fornavn" pattern="[A-Za-zØÆÅøæå ]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
		</div>
		<div class="pure-control-group">
			<label for="name">Etternavn</label>
			<input type="text"class="pure-input-1-3" name="etternavn" pattern="[A-Za-zØÆÅøæå ]{1,20}" required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
		</div>
		<div class="pure-control-group">
			<label for="name">Studentnummer</label>
			<input type="text" class="pure-input-1-3" name="studentnummer" pattern="[0-9]{6}" required="" title="Seks siffer fra 0-9"/>
		</div>
		<div class="pure-control-group">
			<label for="name">Brukernavn</label>
			<input type="text" class="pure-input-1-3" name="brukernavn" pattern="[A-Za-z0-9ØÆÅøæå_-]{3,15}" required="" title="Mellom 3-15 langt, tilatte tegnsett er: a-Å, _ og -"/>
		</div>
		<div class="pure-control-group">
			<label for="email">E-post</label>
			<input type="email" class="pure-input-1-3" name="email_1" maxlength="60" required=""/>
		</div>
		<div class="pure-control-group">
			<label for="email">Gjenta E-post</label>
			<input type="email" class="pure-input-1-3" name="email_2" id="emailForm" id="email" autocomplete="off" maxlength="60" required=""/>
		</div>
		<div class="pure-control-group">
			<label for="password">Passord</label>
			<input type="password" class="pure-input-1-3" name="passord_1" pattern=".{5,20}" required="" title="Mellom 5 og 20 tegn"/>
		</div>
		<div class="pure-control-group">
			<label for="password">Gjenta passord</label>
			<input type="password" class="pure-input-1-3" name="passord_2" id="passordForm" pattern=".{5,20}" required="" title="Mellom 5 og 20 tegn"/>
		</div  class="pure-control-group">
		<div class="pure-control-group">
			<label></label>
			<button type="submit" class="pure-button pure-input-1-3 pure-button-primary">Registrer</button>
		</div>
	</fieldset>
</form>


	';
}

?>
