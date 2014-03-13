<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
session_start();
//REQUIREMENTS FOR ALL PAGES
echo '<link rel="stylesheet" type="text/css" href="main.css" />';

drawHeader($db);

if (!empty($_SESSION['id'])){
	echo "Welcome, ".getUserName($db, $_SESSION['id']);
	echo "<br/>";

	echo '<section id="boxContainer">';
	drawAllUtvalgThumbnail($db, 'box');
	echo '</section>';

} else {
	echo "Please log in <br/><br/>";
}

?>