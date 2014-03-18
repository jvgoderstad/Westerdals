<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);

$utvalgid = $_GET['arrangement'];
if (isset($_SESSION['id'])){
	$userid = $_SESSION['id'];
}

if (isset($_GET['arrangement'])){
	$arrangementnavn = $_GET['arrangement'];
	echo "<br/><br/>
	<fieldset class='arrField'>
		<legend class='arrLegend'>$arrangementnavn</legend><br/>
		<pre>Her kommer den lange beskrivelsen av arrangementet</pre>
		<br/>
	";
}

?>


