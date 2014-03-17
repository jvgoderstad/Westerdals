<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);

$utvalgid = $_GET['utvalg'];
$userid = $_SESSION['id'];

if (isset($_GET['meldinn'])){
	addUserToUtvalg($db, $userid, $utvalgid);
} else if (isset($_GET['meldut'])){
	removeUserFromUtvalg($db, $userid, $utvalgid);
}


if (isset($_GET['utvalg'])){
	$utvalgsnavn = $_GET['utvalg'];
	echo "<br/><br/>
	<fieldset style='width: 800px; margin: auto;'>
		<legend>$utvalgsnavn</legend><br/>
		<p></p>
		<br/>
	";

	if (isset($_SESSION['id']) && !isRegisteredInUtvalg($db, $userid, $utvalgid)){
		$utvalg = $_GET['utvalg'];
		echo "
			<form action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' class='button' value='Meld deg inn' name='meldinn' />
			</form>
		";
	} else if (isset($_SESSION['id']) && isRegisteredInUtvalg($db, $userid, $utvalgid)) {
		$utvalg = $_GET['utvalg'];
		echo "
			<form action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' class='button' value='Meld deg ut' name='meldut' />
			</form>
		";
	}

	echo "

	</fieldset>
	<br />
	<br />
	<fieldset style='width: 800px; margin: auto;'>
		<legend>Arrangementer</legend><br/>
		<p>Her kommer det en liste over arrangementer dette utvalget arrangerer!</p><br/><br/>
	</fieldset>
	";

}

?>



