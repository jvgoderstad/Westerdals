<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
//REQUIREMENTS FOR ALL PAGES
echo '<link rel="stylesheet" type="text/css" href="main.css" />';

drawHeader($db);

if (isset($_GET['selection'])){
	if ($_GET['selection'] == 'mineutvalg'){
		echo "<br/>";
		echo '<section id="boxContainer">';
			drawAllUtvalgOnUserid($db, 'box', $_SESSION['id']);
		echo '</section>';
	}
} else {
	echo "<br/>";
	echo '<section id="boxContainer">';
		drawAllUtvalgThumbnail($db, 'box');
	echo '</section>';
}



?>