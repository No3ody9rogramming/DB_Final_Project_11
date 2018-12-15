<?php
	$user = "admin";
	$passwd = "ntoucse";
	global $db;
	try{
		$db = new PDO('mysql:host=127.0.0.1; dbname=00557043,34,19; charset=utf8', $user, $passwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	catch(PDOException $e){
		Print "ERROR!:".$e->message();
		die();
	}
?>