<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

if (isset($_POST['navn']) && isset($_POST['kortnavn']) && isset($_POST['kortbeskrivelse']) && isset($_POST['langbeskrivelse'])){
	if (!empty($_POST['navn']) && !empty($_POST['kortnavn']) && !empty($_POST['kortbeskrivelse']) && !empty($_POST['langbeskrivelse'])){
		addUtvalg($db, $_POST['kortnavn'], $_POST['navn'], $_POST['langbeskrivelse'], $_POST['kortbeskrivelse']);
	}
}

echo '
	<form method="POST" action="rediger_aktivitet.php">
		<div class="boxReg" id="largeBoxReg">
			<h1>Rediger aktivitet</h1>
			<label>
				<span>Navn</span>
				<input type="text" class="input_text" value="" name="" autofocus required="" maxlength="50" title="Mellom 1-50 tegn langt."/>
			</label>
			<label>
				<span>Start dato</span>
				<input type="datetime" class="input_text" value="" name="" required="" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}" title="YYYY-MM-DD HH:MM"/>
			</label>
			<label>
				<span>Slutt dato</span>
				<input type="datetime" class="input_text" value="" name="" required="" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}" title="YYYY-MM-DD HH:MM"/>
			</label>
			<label>
				<span>Kort beskrivelse</span>
				<input type="text" class="input_text" value="" name="" maxlength="80" required="" title="Mellom 1-80 tegn langt."/>
			</label>
			<label>
				<span>Lang Beskrivelse</span>
				<textarea rows="15" cols="200" value="" name="" required="" maxlength="5000" class="input_text" id="large_input_field" title="Mellom 1-80 tegn langt."></textarea>
			</label>
			<label align="center">
				<input type="submit"  class="button" value="Lagre endring">
			</label>
		</div>
	</form>
';
?>
