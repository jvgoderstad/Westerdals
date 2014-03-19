<?php
//REQUIREMENTS FOR ALL PAGES-->
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES-->

drawHeader($db);

if (getAccess($db, $_SESSION['id']) != 2){
	header('Location: home.php');
	die();
}

$userlist = getUserList($db);

if (isset($_POST['valg']) && isset($_POST['selected'])){
	if (!empty($_POST['valg']) && !empty($_POST['selected'])){
		if ($_POST['valg'] == 'giadmin'){
			editAccess($db, $_POST['selected'], 1);
		} else if ($_POST['valg'] == 'taadmin'){
			editAccess($db, $_POST['selected'], 0);
		}
	}
}

echo"

</br>
</br>

<fieldset class='arrField'>
				<legend class='arrLegend'>Alle registrerte brukere</legend><br/>
				";
				//echo $item['username'].' - '.$item['name'].' - '.$item['surname'].' - '.$item['epost'].' - '.$item['studentnr'].'</br>';
					echo "<table style='width: 100%'>";
					foreach ($userlist as $item) {
						$userid = $item['id'];
						echo "<tr>";
							echo "<td>";
								echo getAccess($db, $item['id']);
							echo "</td>";
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
							echo "<td>";
							if (getAccess($db, $userid) == 0){
								echo "
									<form action='administrator.php' method='post'>
										<input type='hidden' name='valg' value='giadmin'>
										<input type='hidden' name='selected' value='$userid'>
										<button type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Gi Admin</button>
									</form>
								";
							} else if (getAccess($db, $userid) == 1){
								echo "
									<form action='administrator.php' method='post'>
										<input type='hidden' name='valg' value='taadmin'>
										<input type='hidden' name='selected' value='$userid'>
										<button type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Fjern Admin</button>
									</form>
								";
							} else if (getAccess($db, $userid) == 2){
								echo "
									<form action='administrator.php' method='post'>
										<button disabled type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Superuser</button>
									</form>
								";
							}
								
							echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				echo"
			</fieldset>";
?>
