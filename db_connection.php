<?php
	require_once ('config.php');
	
	try {
		if (DATABASE_TYPE == 'mysql'){
		# MySQL with PDO_MYSQL
		$host = MYSQL_HOST;
		$dbname = MYSQL_DATABASE; 
		$user = MYSQL_LOGIN;
		$pass = MYSQL_PASSWORD;
		
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		} elseif (DATABASE_TYPE == 'sqlite') {
		# SQLite Database
			echo 'SQLite is not implemented yet!';
		
		//$DBH = new PDO("sqlite:my/database/path/database.db");
		} elseif (DATABASE_TYPE == 'sqlite') {
			echo 'PostgreSQL is not implemented yet!';
		} else {
			echo 'The database' + DATABASE_TYPE + 'is not supported!';
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	
	
	//Deprecated!!!
	$db_link = @mysql_connect (MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASSWORD);
	if ( ! $db_link ){
		die('No Connection! Try it later!');
	}
	$db_sel = mysql_select_db( MYSQL_DATABASE )
    or die("Could not select database!");
?>