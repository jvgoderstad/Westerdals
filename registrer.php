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
<div class ="formholder">
		<form method="POST" action="registrer.php" onsubmit="return checkEmail(this);">
			<fieldset>
			<legend>Registrer ny bruker</legend>
				<table  CELLPADDING="2">
					<tr>
						<td>Fornavn:</td><td><input type="text" name="fornavn" placeholder="Fornavn" maxlength="45"/></td>
					</tr>
					<tr>
						<td>Etternavn:</td><td><input type="text" name="etternavn" placeholder="Etternavn" maxlength="60"/></td>
					</tr>
					<tr>
						<td>Studentnr:</td><td><input type="text" name="studentnummer" placeholder="Studentnummer" maxlength="6"/></td>
					</tr>
					<tr>
						<td>Brukernavn:</td><td><input type="text" name="brukernavn" placeholder="Brukernavn" maxlength="45"/></td>
					</tr>
					<tr>
						<td>E-post:</td><td><input type="email" name="email_1" id="input_text" placeholder="E-postadresse" maxlength="60"/></td>
					</tr>
					<tr>
						<td >Gjenta: </td><td><input type="email"  id="emailForm" name="email_2" placeholder="Gjenta E-postadresse" maxlength="60"/></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="passord_1" placeholder="Passord" maxlength="30"/></td>
					</tr>
					<tr>
						<td>Gjenta:</td><td><input type="password" id="passordForm" name="passord_2" placeholder="Gjenta passord" maxlength="30"/></td>
					</tr>
				</table>
			</fieldset>
			<input type="submit" value="Registrer">
		</form>
	</div>
';
?>
