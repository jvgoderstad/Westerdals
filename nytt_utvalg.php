<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

echo '
	<form method="POST" action="nytt_utvalg.php">
		<div class="boxReg" id="largeBoxReg">
			<h1>Registrer nytt utvalg</h1>
			<label>
				<span>Navn</span>
				<input type="text" class="input_text" name="" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Forkortelse av navn</span>
				<input type="text" class="input_text" name="" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Kort beskrivelse</span>
				<input type="text" class="input_text" name="" pattern="[A-Za-zØÆÅøæå]{1,20}" autofocus required="" title="Mellom 1-20 langt, tilatte tegnsett er: a-Å"/>
			</label>
			<label>
				<span>Lang Beskrivelse</span>
				<textarea rows="15" cols="200" name="" class="input_text" id="large_input_field"></textarea>
			</label>
			<label align="center">
				<input type="submit"  class="button" value="Opprett utvalg">
			</label>
		</div>
	</form>
';
?>
