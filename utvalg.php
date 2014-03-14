<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);
if (isset($_GET['utvalg'])){
	if (isset($_POST['meldinn'])){
		if (!empty($_POST['meldinn'])){
			addUserToUtvalg($db, $_SESSION['id'], $_GET['utvalg']);
		}
	}
}

if (isset($_GET['utvalg'])){
	$utvalgsnavn = $_GET['utvalg'];
	echo "<br/><br/>
	<fieldset style='width: 800px; margin: auto;'>
		<legend>$utvalgsnavn</legend>
		<p>asasdfasdggfdsgsdfasdf</p><br />
		<p>asasdfasdggfdsgsasdfasdfdfasdf</p><br />
		<p>asasdfasdggfdsgsdfasdf</p><br />
		<p>asasdfasdggfdsgsasdfasdfdfasdf</p>
	</fieldset>
	<br />
	<br />
	<fieldset style='width: 800px; margin: auto;'>
	</style>>
		<legend>Arrangementer</legend>
		<p>asasdfasdggfdsgsdfasdf</p><br />
		<p>asasdfasdggfdsgsasdfasdfdfasdf</p><br />
		<p>asasdfasdggfdsgsdfasdf</p><br />
		<p>asasdfasdggfdsgsasdfasdfdfasdf</p>
	</fieldset>
	";
	/*if (isset($_SESSION['id'])){
		echo '	<form method="GET" action="utvalg.php">
					<input type="submit" value="Meld deg inn" name="meldinn"/>
				</form>
		';
	}*/
} else {
	echo "<br/>";
	echo "Du er meldt inn i utvalget!";
}
