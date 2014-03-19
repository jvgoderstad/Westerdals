<?php
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';
drawHeader($db);

if (getAccess($db, $_SESSION['id']) == 0){
	header('Location: home.php');
	die();
}

if (isset($_POST['navn']) && isset($_POST['kortnavn']) && isset($_POST['kortbeskrivelse']) && isset($_POST['langbeskrivelse'])){
	if (!empty($_POST['navn']) && !empty($_POST['kortnavn']) && !empty($_POST['kortbeskrivelse']) && !empty($_POST['langbeskrivelse'])){
		editUtvalg($db, $_POST['oldname'], $_POST['kortnavn'], $_POST['navn'], $_POST['langbeskrivelse'], $_POST['kortbeskrivelse']);
	}
} else {
	$utvalg = $_GET['utvalg'];
}

echo "
<form method='POST' action='rediger_utvalg.php' class='pure-form pure-form-aligned'>
	<fieldset>
		<input type='hidden' value='$utvalg' name='oldname' />
		<div class='pure-control-group'>
			<label for='name'>Navn</label>
			<input type='text' class='pure-u-3-4' value='"; getUtvalgLongName($db, $utvalg); echo"' name='navn' autofocus required='' maxlength='50' title='Mellom 1-50 tegn langt.'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Forkortelse av navn</label>
			<input type='text' class='pure-u-3-4' pattern='[A-Za-zØÆÅøæå-_^` ]{1,6}' value='"; echo $utvalg; echo"' name='kortnavn' required='' title='Mellom 1-6 tegn langt.'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Kort beskrivelse</label>
			<input type='text' class='pure-u-3-4' value='"; getUtvalgShortDescription($db, $utvalg); echo"' name='kortbeskrivelse' maxlength='80' required='' title='Mellom 1-80 tegn langt.'/>
		</div>
		<div class='pure-control-group'>
			<label for='name'>Lang beskrivelse</label>
			<textarea rows='15' cols='200' name='langbeskrivelse' required='' maxlength='5000' class='pure-u-3-4' title='Mellom 1-80 tegn langt.'>"; getUtvalgLongDescription($db, $utvalg); echo"</textarea>
		</div>
		<div class='pure-control-group'>
			<label></label>
			<button type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Lagre endring</button>
		</div>
	</fieldset>
</form>
";
?>
