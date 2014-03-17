<?php
//REQUIREMENTS FOR ALL PAGES
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
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
		<p>Suspendisse vitae felis orci. Cras eget enim ac risus dapibus sagittis quis pellentesque enim. Cras bibendum dapibus ligula, ut dapibus diam euismod in. In cursus vel tellus dapibus interdum.<br/> Quisque aliquam consectetur iaculis. Maecenas mollis convallis odio, ac ultricies urna auctor in. Fusce id erat nunc. Nam a vestibulum est, in posuere purus.<br/><br/> Donec ac augue vel risus convallis facilisis in ac dolor. Morbi ut purus et nulla sagittis consectetur ut vel orci. Proin sodales aliquam mi, id faucibus turpis vehicula ut. Curabitur vestibulum tincidunt justo eget fermentum.</p>
		<br/>
	</fieldset>
	<br />
	<br />
	<fieldset style='width: 800px; margin: auto;'>
		<legend>Arrangementer</legend><br/>
		<p>Her kommer det en liste over arrangementer dette utvalget arrangerer!</p><br/><br/>
	</fieldset>
	";
	
	if (isset($_SESSION['id']) && !isRegisteredInUtvalg($db, $userid, $utvalgid)){
		$utvalg = $_GET['utvalg'];
		echo "
			<form action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' value='Meld deg inn' name='meldinn' />
			</form>
		";
	} else {
		$utvalg = $_GET['utvalg'];
		echo "
			<form action='utvalg.php' method='GET'>
				<input type='hidden' name='utvalg' value=$utvalg />
				<input type='submit' value='Meld deg ut' name='meldut' />
			</form>
		";
	}
	
}

?>



