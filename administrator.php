<?php
//REQUIREMENTS FOR ALL PAGES-->
require 'functions.php';
echo '<link rel="stylesheet" type="text/css" href="style.css" />';
echo '<link rel="stylesheet" type="text/css" href="main.css" />';
//REQUIREMENTS FOR ALL PAGES-->

drawHeader($db);


$userlist = getUserList($db);
echo"

</br>
</br>

<fieldset class='arrField'>
				<legend class='arrLegend'>Alle registrerte brukere</legend><br/>
				";
				//echo $item['username'].' - '.$item['name'].' - '.$item['surname'].' - '.$item['epost'].' - '.$item['studentnr'].'</br>';
					echo "<table style='width: 100%'>";
					foreach ($userlist as $item) {
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
								echo "
									<form action='administrator.php' method='GET'>
										<input type='hidden' name='valg' value='up'>
										<button type='submit' class='pure-button pure-u-3-4 pure-button-primary'>Gi Admin</button>
									</form>
								";
							echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				echo"
			</fieldset>";
?>
