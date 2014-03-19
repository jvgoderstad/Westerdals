<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

if (getAccess($db, $_SESSION['id']) == 0){
	header('Location: home.php');
	die();
}

if (isset($_POST['navn']) && isset($_POST['langbeskrivelse']) && isset($_POST['kortbeskrivelse']) && isset($_POST['startdato']) && isset($_POST['sluttdato'])){
	if (!empty($_POST['navn']) && !empty($_POST['langbeskrivelse']) && !empty($_POST['kortbeskrivelse']) && !empty($_POST['startdato']) && !empty($_POST['sluttdato'])){
		editAktivitet($db, $_POST['arrangement'], $_POST['navn'], $_POST['langbeskrivelse'], $_POST['kortbeskrivelse'], $_POST['startdato'], $_POST['sluttdato']);
	}
} else {
	$arrangement = $_GET['arrangement'];
}

echo "
<form method='POST' action='rediger_aktivitet.php' class='pure-form pure-form-aligned'>
	<fieldset>
		<input type='hidden' name='arrangement' value='$arrangement' />
		<div class='pure-control-group'>
			<label for='name'>Navn</label>
			<input type='text' class='input_text pure-u-3-4' pattern='[A-Za-zØÆÅøæå-_^` ]{1,50}' value='"; echo"$arrangement"; echo"' name='navn' autofocus required=' title='Mellom 1-50 tegn langt.'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Start dato</label>
			<input type='datetime' class='input_text pure-u-3-4' value='"; getArrangementStartdate($db, $arrangement); echo"' name='startdato' placeholder='YYYY-MM-DD HH:MM' required=' pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}' title='YYYY-MM-DD HH:MM'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Slutt dato</label>
			<input type='datetime' class='input_text pure-u-3-4' value='"; getArrangementEnddate($db, $arrangement); echo"' name='sluttdato' placeholder='YYYY-MM-DD HH:MM' required=' pattern='(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))\s?(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){1}' title='YYYY-MM-DD HH:MM'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Kort beskrivelse</label>
			<input type='text' class='input_text pure-u-3-4' value='"; getArrangementShortDescription($db, $arrangement); echo"' name='kortbeskrivelse' maxlength='80' required=' title='Mellom 1-80 tegn langt.'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Lang beskrivelse</label>
			<textarea rows='15' cols='200' name='langbeskrivelse' required=' maxlength='5000' class='input_text pure-u-3-4' title='Mellom 1-80 tegn langt.'>"; getArrangementLongDescription($db, $arrangement); echo"</textarea>
		</div>
		<div class='pure-control-group'>
			<label></label>
			<button type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Lagre endring</button>
		</div>
	</fieldset>
</form>";
?>
