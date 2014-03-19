<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES

drawHeader($db);

$arrangementnavn = $_GET['arrangement'];
if (isset($_SESSION['id'])){
	$userid = $_SESSION['id'];
}

if (isset($_GET['meldinn'])){
	addUserToArrangement($db, $userid, $arrangementnavn);
} else if (isset($_GET['meldut'])){
	removeUserFromArrangement($db, $userid, $arrangementnavn);
} else if (isset($_GET['slettutvalg'])){
	//removeAllUsersFromUtvalg($db, $utvalgid);
	//removeUtvalg($db, $utvalgid);
}

if (isset($_GET['arrangement'])){
	$arrangementnavn = $_GET['arrangement'];
	echo "<br/><br/>
	<fieldset class='arrField'>
		<legend class='arrLegend'>$arrangementnavn</legend><br/>
		<pre>"; getArrangementLongDescription($db, $arrangementnavn); echo"</pre>
		<br/>
	";
		if (isset($_SESSION['id']) && !isAttendingArrangement($db, $userid, $arrangementnavn)){
			$arrangement = $_GET['arrangement'];
			echo "
				<form class='form-button' action='arrangement.php' method='GET'>
					<input type='hidden' name='arrangement' value=$arrangement />
					<input type='submit' class='pure-button pure-button-primary' value='Meld deg på' name='meldinn' />
				</form>
			";
		} else if (isset($_SESSION['id']) && isAttendingArrangement($db, $userid, $arrangementnavn)) {
			$arrangement = $_GET['arrangement'];
			echo "
				<form class='form-button' action='arrangement.php' method='GET'>
					<input type='hidden' name='arrangement' value=$arrangement />
					<input type='submit' class='pure-button pure-button-primary' value='Meld deg av' name='meldut' />
				</form>
			";
		}
		
		if (isset($_SESSION['id'])){
		if (getAccess($db, $_SESSION['id']) == 1 || getAccess($db, $_SESSION['id']) == 2){
		echo "
			<form class='form-button' action="; echo"rediger_aktivitet.php"; echo">
				<input type='hidden' name='arrangement' value=$arrangement />
				<input type='submit' class='pure-button pure-button-primary' value='Rediger'/>
			</form>
		";
		echo "
			<form class='form-button' action="; echo"arrangement.php"; echo" method='GET'>
				<input type='hidden' name='arrangement' value=$arrangement />
				<input type='submit' class='pure-button pure-button-primary' value='Slett Arrangementet' name='slettarrangement'/>
			</form>
		";
		}
	}
		
		
	echo"
	</fieldset>
	";
}

?>


