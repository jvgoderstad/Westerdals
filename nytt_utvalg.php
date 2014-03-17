<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

if (isset($_POST['navn']) && isset($_POST['kortnavn']) && isset($_POST['kortbeskrivelse']) && isset($_POST['langbeskrivelse'])){
	if (!empty($_POST['navn']) && !empty($_POST['kortnavn']) && !empty($_POST['kortbeskrivelse']) && !empty($_POST['langbeskrivelse'])){
		addUtvalg($db, $_POST['navn'], $_POST['langbeskrivelse'], $_POST['kortbeskrivelse']);
	}
}

echo '
	<form method="POST" action="nytt_utvalg.php">
		<div class="boxReg" id="largeBoxReg">
			<h1>Registrer nytt utvalg</h1>
			<label>
				<span>Navn</span>
				<input type="text" class="input_text" name="navn" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Forkortelse av navn</span>
				<input type="text" class="input_text" name="kortnavn" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Kort beskrivelse</span>
				<input type="text" class="input_text" name="kortbeskrivelse" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Lang Beskrivelse</span>
				<textarea rows="15" cols="200" name="langbeskrivelse" class="input_text" id="large_input_field"></textarea>
			</label>
			<label align="center">
				<input type="submit"  class="button" value="Opprett utvalg">
			</label>
		</div>
	</form>
';
?>
