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
		<legend class='arrLegend'>"; getUtvalgLongName($db, $utvalgsnavn); echo"</legend><br/>
		<pre>"; getUtvalgLongDescription($db, $utvalgsnavn); echo"</pre>
		<br/>
	";

	if (isset($_SESSION['id']) && !isRegisteredInUtvalg($db, $userid, $utvalgid)){
		$utvalg = $_GET['utvalg'];
		echo "
			<form class='form-button' action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value='$utvalg' />
				<input type='submit' class='pure-button pure-button-primary' value='Meld deg inn' name='meldinn' />
			</form>
		";
	} else if (isset($_SESSION['id']) && isRegisteredInUtvalg($db, $userid, $utvalgid)) {
		$utvalg = $_GET['utvalg'];
		echo "
			<form class='form-button' action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value='$utvalg' />
				<input type='submit' class='pure-button pure-button-primary' value='Meld deg ut' name='meldut' />
			</form>
		";
	}
	
	if (isset($_SESSION['id'])){
		if (getAccess($db, $_SESSION['id']) == 1 || getAccess($db, $_SESSION['id']) == 2){
		echo "
			<form class='form-button' method='GET' action="; echo"rediger_utvalg.php"; echo">
				<input type='hidden' name='utvalg' value='$utvalg' />
				<input type='submit' class='pure-button pure-button-primary' value='Rediger'/>
			</form>
		";
		echo "
			<form class='form-button' action="; echo"registrer_aktivitet.php"; echo">
				<input type='hidden' name='utvalg' value='$utvalg' />
				<input type='submit' class='pure-button pure-button-primary' value='Opprett Arrangement'/>
			</form>
		";
		echo "
			<form class='form-button' action="; echo"utvalg.php"; echo" method='GET'>
				<input type='hidden' name='utvalg' value='$utvalg' />
				<input type='submit' class='pure-button pure-button-primary' value='Slett Utvalget' name='slettutvalg'/>
			</form>
		";
		}
	}
	

	echo "

	</fieldset>";
	if (isset($_SESSION['id'])){
		if (getAccess($db, $_SESSION['id']) == 1 || getAccess($db, $_SESSION['id']) == 2){
			$userlist = getUserListInUtvalg($db, $_GET['utvalg']);
			echo"
			<br />
			<br />
			<fieldset class='arrField'>
				<legend class='arrLegend'>Påmelde brukere</legend><br/>
				";
				//echo $item['username'].' - '.$item['name'].' - '.$item['surname'].' - '.$item['epost'].' - '.$item['studentnr'].'</br>';
					echo "<table>";
					foreach ($userlist as $item) {
						echo "<tr>";
							echo "<td>";
								echo $item['username'];
							echo "</td>";
							echo "<td>";
								echo $item['name'];
							echo "</td>";
							echo "<td>";
								echo $item['surname'];
							echo "</td>";
							echo "<td>";
								echo $item['epost'];
							echo "</td>";
							echo "<td>";
								echo $item['studentnr'];
							echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				echo"
			</fieldset>";
		}
	}
	
	
	echo"
	<br />
	<br />
	<fieldset class='arrField'>
		<legend class='arrLegend'>Arrangementer</legend><br/>
		"; drawAllArrangementOnUtvalgName($db, $_GET['utvalg']); echo"
	</fieldset>
	";

}

?>


