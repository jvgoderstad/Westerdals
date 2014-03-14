<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
//REQUIREMENTS FOR ALL PAGES
echo '<link rel="stylesheet" type="text/css" href="main.css" />';

drawHeader($db);

echo "<br/>";

echo '<section id="boxContainer">';
	drawAllUtvalgThumbnail($db, 'box');
echo '</section>';

?>