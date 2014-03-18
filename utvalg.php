<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);

$utvalgid = $_GET['utvalg'];
if (isset($_SESSION['id'])){
	$userid = $_SESSION['id'];
}


if (isset($_GET['meldinn'])){
	addUserToUtvalg($db, $userid, $utvalgid);
} else if (isset($_GET['meldut'])){
	removeUserFromUtvalg($db, $userid, $utvalgid);
} else if (isset($_GET['slettutvalg'])){
	removeAllUsersFromUtvalg($db, $utvalgid);
	removeUtvalg($db, $utvalgid);
}


if (isset($_GET['utvalg'])){
	$utvalgsnavn = $_GET['utvalg'];
	echo "<br/><br/>
	<fieldset class='arrField'>
		<legend class='arrLegend'>$utvalgsnavn</legend><br/>
		<pre>"; getUtvalgLongDescription($db, $utvalgsnavn); echo"</pre>
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
	
	if (isset($_SESSION['id'])){
		if (getAccess($db, $_SESSION['id']) == 1 || getAccess($db, $_SESSION['id']) == 2){
		echo "
			<form action="; echo"rediger_utvalg.php"; echo">
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' class='button' value='Rediger'/>
			</form>
		";
		echo "
			<form action="; echo"registrer_aktivitet.php"; echo">
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' class='button' value='Opprett Arrangement'/>
			</form>
		";
		echo "
			<form action="; echo"utvalg.php"; echo" method='GET'>
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' class='button' value='Slett Utvalget' name='slettutvalg'/>
			</form>
		";
		}
	}
	

	echo "

	</fieldset>
	<br />
	<br />
	<fieldset class='arrField'>
		<legend class='arrLegend'>Arrangementer</legend><br/>
		<p>Her kommer det en liste over arrangementer dette utvalget arrangerer!</p><br/><br/>
	</fieldset>
	";

}

?>


