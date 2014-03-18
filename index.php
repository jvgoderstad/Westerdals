<?php
//REQUIREMENTS FOR ALL PAGES-->
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES-->

drawHeader($db);

echo"
<fieldset class='arrField'>
		<legend class='arrLegend'>Startside</legend><br/>
		<p>Her kan du  som student lese om, og registrere deg på ønskede utvalg på Westerdals.</p><br/><br/>
	</fieldset>
";
?>
