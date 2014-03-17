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
	} else {
		echo "Fyll inn alle feltene!";
	}
}


echo '
		<form method="POST" action="registrer.php" onsubmit="return checkEmail(this);">
		<div class="boxReg">
			<h1>Registrer ny bruker</h1>
			<label>
				<span>Fornavn</span>
				<input type="text" class="input_text" name="fornavn" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Etternavn</span>
				<input type="text" class="input_text" name="etternavn" pattern="[A-Za-zØÆÅøæå]{1,20}" required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Studentnr</span>
				<input type="text" class="input_text" name="studentnummer" pattern="[0-9]{6}" required="" title="Seks siffer fra 0-9"/>
			</label>
			<label>
				<span>Brukernavn</span>
				<input type="text" class="input_text" name="brukernavn" pattern="[A-Za-z0-9ØÆÅøæå_-]{3,15}" required="" title="Mellom 3-15 langt, tilatte tegnsett er: a-Å, _ og -"/>
			</label>
			<label>
				<span>E-post</span>
				<input type="email" class="input_text" name="email_1" maxlength="60" required=""/>
				<span>Gjenta</span>
				<input type="email" class="input_text" name="email_2" id="emailForm" id="email" autocomplete="off" maxlength="60" required=""/>
			</label>
			<label>
				<span>Passord</span>
				<input type="password" class="input_text" name="passord_1" pattern=".{5,20}" required="" title="Mellom 5 og 20 tegn"/>
				<span>Gjenta</span>
				<input type="password" class="input_text" name="passord_2" id="passordForm" pattern=".{5,20}" required="" title="Mellom 5 og 20 tegn"/>
			</label>
			<label align="center">
				<input type="submit"  class="button" value="Registrer">
			</label>
		</div>
	</form>
';
?>
