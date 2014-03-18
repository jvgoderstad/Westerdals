<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

if (getAccess($db, $_SESSION['id']) == 0){
	header('Location: home.php');
	die();
}

if (isset($_POST['navn']) && isset($_POST['startdato']) && isset($_POST['utvalg']) && isset($_POST['sluttdato']) && isset($_POST['kortbeskrivelse']) && isset($_POST['langbeskrivelse'])){
	if (!empty($_POST['navn']) && !empty($_POST['startdato']) && !empty($_POST['sluttdato']) && !empty($_POST['kortbeskrivelse']) && !empty($_POST['langbeskrivelse'])){
		addArrangement($db, $_POST['utvalg'], $_POST['navn'], $_POST['kortbeskrivelse'], $_POST['langbeskrivelse'], $_POST['startdato'], $_POST['sluttdato']);
	}
} else {
	$utvalg = $_GET['utvalg'];
}

echo "
	<form method='POST' action='registrer_aktivitet.php'>
	<input type='hidden' name='utvalg' value='$utvalg' />
		<div class='boxReg' id='largeBoxReg'>
			<h1>Registrer ny aktivitet</h1>
			<label>
				<span>Navn</span>
				<input type='text' class='input_text' name='navn' autofocus required='' maxlength='50' title='Mellom 1-50 tegn langt.'/>
			</label>
			<label>
				<span>Start dato</span>
				<input type='datetime' class='input_text' name='startdato' placeholder='YYYY-MM-DD HH:MM' required='' pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}' title='YYYY-MM-DD HH:MM'/>
			</label>
			<label>
				<span>Slutt dato</span>
				<input type='datetime' class='input_text' name='sluttdato' placeholder='YYYY-MM-DD HH:MM' required='' pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}' title='YYYY-MM-DD HH:MM'/>
			</label>
			<label>
				<span>Kort beskrivelse</span>
				<input type='text' class='input_text' name='kortbeskrivelse' maxlength='80' required='' title='Mellom 1-80 tegn langt.'/>
			</label>
			<label>
				<span>Lang Beskrivelse</span>
				<textarea rows='15' cols='200' name='langbeskrivelse' required='' maxlength='5000' class='input_text' id='large_input_field' title='Mellom 1-80 tegn langt.'></textarea>
			</label>
			<label align='center'>
				<input type='submit'  class='button' value='Opprett aktivitet'>
			</label>
		</div>
	</form>
";
?>
