<?php

header('content-type:text/html;charset=utf-8;');
require 'database.php';
echo '<link rel="stylesheet" type="text/css" href="styles.css">';

//---------------NOTES----------------
//REQUIRES THE "nithutvalg" DATABASE!

//---------------$db file-------------
//A valid $db (DBO-Object) should be created like this:
//
//$db_host = 'localhost:3306';
//$db_name = 'users';
//$db_user = 'root';
//$db_pass = 'password';
//
//$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//

if (isset($_GET['logout'])){
	logoutUser('index.php');
}

//---------------------------FUNCTIONS FOLLOWING!----------------------------------------------------------------//

//Login a specified user from a userdb, and redirecting to redirect   (Userid stored in _SESSION['id'])
function login($db, $username, $password){
	$stmt = $db->prepare('SELECT * FROM users WHERE username=:username');
	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);

	if (trim((string)mcrypt_decrypt(MCRYPT_RIJNDAEL_128, 'encrKey12', $userinfo['password'], MCRYPT_MODE_CBC)) === (string)$password){
		$_SESSION['id'] = $userinfo['id'];
		$_SESSION['access'] = $userinfo['access'];
		header('Location: '.$_SERVER['PHP_SELF']);
	} else {
		echo "Incorrect username or password!";
	}
}

//Logout a user by unsetting the _SESSION['id'], and redirecting to redirect
function logoutUser($redirect){
	unset($_SESSION['id']);
	unset($_SESSION['access']);
	header("Location: $redirect");
}

//Registering a user on a specified userdb, takes: db, username, password. (returns true for successful register. else false)
function addUser($db, $newusername, $newpassword, $newname, $newsurname, $newemail, $newstudentnr){

	//encrypt
	$encrPassword = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 'encrKey12', $newpassword, MCRYPT_MODE_CBC);

	$stmt = $db->prepare("INSERT INTO users(username, password, name, surname, epost, studentnr) VALUES(:getnewuser, :getnewpassword, :getnewname, :getnewsurname, :getnewemail, :getnewstudentnr)");
	$stmt->bindParam(':getnewuser', $newusername);
	$stmt->bindParam(':getnewpassword', $encrPassword);
	$stmt->bindParam(':getnewname', $newname);
	$stmt->bindParam(':getnewsurname', $newsurname);
	$stmt->bindParam(':getnewemail', $newemail);
	$stmt->bindParam(':getnewstudentnr', $newstudentnr);
	try{
		@$stmt->execute();
		return true;
	}
	catch(PDOException $e){
		if($e->getCode() == 23000){
			echo "<br/>You are already registered!";
		} else {
			echo $e->getMessage();
			return false;
		}
	}
}

//Registering a user on a specified utvalgdb, takes: db, name, description, shortdescription. (returns true for successful register. else false)
function addUtvalg($db, $name, $description, $shortdescription){
	$stmt = $db->prepare("INSERT INTO utvalg(name, description, shortdescription) VALUES(:name, :description, :shortdesvription)");
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':shortdescription', $shortdescription);

	try{
		@$stmt->execute();
		return true;
	}
	catch(PDOException $e){
		return false;
	}
}

//Registers a user to an utvalg in the connection table. takes: db, userid, utvalgid. (returns true for successful register. else false)
function addUserToUtvalg($db, $userid, $utvalgid){

	$stmt = $db->prepare("INSERT INTO user_utvalg(utvalg_id, users_id) VALUES(:utvalgid, :userid)");
	$stmt->bindParam(':utvalgid', $utvalgid);
	$stmt->bindParam(':userid', $userid);

	try{
		@$stmt->execute();
		return true;
	}
	catch(PDOException $e){
		return false;
	}
}

//Registers a user to an utvalg in the connection table. takes: db, userid, utvalgid. (returns true for successful register. else false)
function removeUserFromUtvalg($db, $userid, $utvalgid){

	$stmt = $db->prepare("DELETE FROM user_utvalg WHERE users_id=':userid' AND utvalg_id=':utvalgid'");
	$stmt->bindParam(':utvalgid', $utvalgid);
	$stmt->bindParam(':userid', $userid);

	try{
		@$stmt->execute();
		return true;
	}
	catch(PDOException $e){
		return false;
	}
}

//Returns a 2D Array of the 'users'-table Fields(username, name, surname, epost, studentnr). Eks: Array['0']['username']
function getUserList($db){
	$stmt = $db->prepare("SELECT username,name,surname,epost,studentnr FROM users");
	try {
		$stmt->execute();
	}
	catch(PDOException $e){

	}

	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $list;
}

//Returns a 2D Array of the 'users'-table Fields(username, name, surname, epost, studentnr). Eks: Array['0']['username']
function getUtvalgList($db){
	$stmt = $db->prepare("SELECT name,description,shortdescription FROM utvalg");
	try {
		$stmt->execute();
	}
	catch(PDOException $e){

	}

	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $list;
}

//Returns a 2D Array of the 'users'-table that is registered to of the chosen utvalg. Eks: Array['0']['username']
function getUserListInUtvalg($db, $utvalgid){
	$stmt = $db->prepare("SELECT username,name,surname,epost,studentnr FROM users LEFT JOIN user_utvalg ON user_utvalg.users_id=users.id WHERE user_utvalg.utvalg_id = ':utvalgid'");
	$stmt->bindParam(':utvalgid', $utvalgid);
	try {
		$stmt->execute();
	}
	catch(PDOException $e){

	}

	$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $list;
}

//Echoes out <li> elements of the provided 2D array. Each line (Array['0']) represents a separate <li> element in the echo
function listToHTML($db, $list){
	$line = "";

	foreach ($list as $item) {
		$line = $item['username'].' - '.$item['name'].', '.$item['surname'].' - '.$item['epost'].' - '.$item['studentnr'];
		echo "
			<li>$line</li>
		";
	}
}

//Gets the username and returns it as a string, based on the provided userdb and id
function getUserName($db, $id){
	$stmt = $db->prepare('SELECT * FROM users WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
	return $userinfo['username'];
}

//Gets the accesslevel of the provided userid
function getAccess($db, $userid){
	$stmt = $db->prepare('SELECT access FROM users WHERE id=:id');
	$stmt->bindParam(':id', $userid);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
	return $userinfo['access'];
}

//Draws a simple Login-Form in HTML Posting info to POST
function drawFormLogin($formDescription, $usernameText, $passwordText){
	echo "
		<form action=\"index.php\" method=\"POST\">
			$formDescription<br/><br/>
			$usernameText<br><input type=\"text\" name=\"loginusername\"/><br />
			$passwordText<br><input type=\"password\" name=\"loginpassword\"/><br />
			<input type=\"submit\" value=\"Submit\"/>
		</form>
	";
}

//Draws a simple Registration-Form in HTML Posting info to POST
function drawFormRegister($CSSid, $formDescription, $usernameText, $passwordText, $nametext, $surnametext, $emailtext, $studentnrtext){
	echo "
		<form id=$CSSid action=\"index.php\" method=\"POST\">
			$formDescription<br/><br/>
			$usernameText<br><input type=\"text\" name=\"newusername\"/><br />
			$passwordText<br><input type=\"password\" name=\"newpassword\"/><br />
			$nametext<br><input type=\"text\" name=\"newname\"/><br />
			$surnametext<br><input type=\"text\" name=\"newsurname\"/><br />
			$emailtext<br><input type=\"email\" name=\"newemail\"/><br />
			$studentnrtext<br><input type=\"text\" name=\"newstudentnr\"/><br />
			<input type=\"submit\" value=\"Submit\"/>
		</form>
	";
}

//Gets all the utvalg, and displays them through a defined div-tag, using the CSS-tag: $class.
function drawAllUtvalgThumbnail($db, $class){

	$list = getUtvalgList($db);

	$line = "";

	foreach ($list as $item) {
		$name = $item['name'];
		$descr = $item['shortdescription'];
		echo "
			<a href='utvalg.php?utvalg=$name'>
			<div class=$class>
				<!--Tittel-->
				<h1>$name</h1>

				<!--Description-->
				<br>
				<p>
					$descr
				</p>
			</div>
			</a>
	";
	}
}

//Draws the HTML header
function drawHeader($db){
	echo '
		<div class ="Banner">
			<img class ="logo "src="westerdal.png" alt="Westerdals Logo">
		</div>
		<div class ="MenuBack"></div>
		<div class ="MenuFront">
			<table align="center" height="40">
				<tr>
					<td>
						<a href ="#aktiviteter" id="valg">Aktiviteter</a>
						<a>|<a/>
						<a href ="home.php" id="valg">Utvalg</a>
					</td>';
						drawLogoutBtn($db);
						echo'
				</tr>
			</table>
		</div>

	';
}

//Draws login/logout
function drawLogoutBtn($db){
	
	if (isset($_POST['brukernavn']) && isset($_POST['passord'])){
		login($db, $_POST['brukernavn'], $_POST['passord']);
	}
	
	if (isset($_SESSION['id'])){
		echo '<td width="10%"><a href ="session.php" id="valg"><div class="LogoutText">Logg ut</div></a></td>';
	} else {
		echo	'<form method="POST" action="">
					<td width="16%"><input type="text" name="brukernavn" placeholder="Brukernavn" maxlength="45"></td>
					<td width="16%"><input type="password" name="passord" placeholder="Passord" maxlength="30"></td>
					<td width="10%"><input type="submit" value="Logg inn" class="btn"></td>
					<td width="13%"><a>|<a/><a href ="registrer.php" id="valg">Ny bruker</a></td>
				</form>';
	}
}
?>
