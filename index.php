<?php
//REQUIREMENTS FOR ALL PAGES-->
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES-->

drawHeader($db);

echo"

</br>
</br>
<fieldset class='arrField'>
		<legend class='arrLegend'>Velkommen til Westerdals utvalgs side!</legend><br/>
		<p>Her kan du  som student lese om, og registrere deg på ønskede utvalg på Westerdals.
		Klikk på Alle utvalg eller registrer deg for å begynne.</p><br/><br/>
	</fieldset>
";
?>
