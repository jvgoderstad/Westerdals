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
	<form method="POST" action="nytt_utvalg.php">
		<div class="boxReg" id="largeBoxReg">
			<h1>Registrer nytt utvalg</h1>
			<label>
				<span>Navn</span>
				<input type="text" class="input_text" name="navn" autofocus required="" maxlength="50" title="Mellom 1-50 tegn langt."/>
			</label>
			<label>
				<span>Forkortelse av navn</span>
				<input type="text" class="input_text" name="kortnavn" maxlength="6" required="" title="Mellom 1-6 tegn langt."/>
			</label>
			<label>
				<span>Kort beskrivelse</span>
				<input type="text" class="input_text" name="kortbeskrivelse" maxlength="80" required="" title="Mellom 1-80 tegn langt."/>
			</label>
			<label>
				<span>Lang Beskrivelse</span>
				<textarea rows="15" cols="200" name="langbeskrivelse" required="" maxlength="5000" class="input_text" id="large_input_field" title="Mellom 1-80 tegn langt."></textarea>
			</label>
			<label align="center">
				<input type="submit"  class="button" value="Opprett utvalg">
			</label>
		</div>
	</form>
';
?>
