<?php


$db_host = 'mysql.nith.no';
$db_name = 'ingmag13';
$db_user = 'ingmag13';
$db_pass = 'pj2100';

try{
	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
	echo $e->getMessage();
}
?>