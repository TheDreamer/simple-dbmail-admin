<?php
	require_once ('config.php');
	
	try {
		if (DATABASE_TYPE == 'mysql'){
			# MySQL with PDO_MYSQL
			$host = MYSQL_HOST;
			$port = MYSQL_PORT;
			$dbname = MYSQL_DATABASE; 
			$user = MYSQL_LOGIN;
			$pass = MYSQL_PASSWORD;
			
			$DBH = new PDO("mysql:
					host=$host;
					dbname=$dbname", $user, $pass);
		} elseif (DATABASE_TYPE == 'sqlite') {
			# SQLite Database
			echo 'SQLite is not implemented yet!';
			//$DBH = new PDO("sqlite:my/database/path/database.db");
		} elseif (DATABASE_TYPE == 'pgsql') {
			$host = PGSQL_HOST;
			$port = PGSQL_PORT;
			$dbname = PGSQL_DATABASE;
			$username = PGSQL_LOGIN;
			$password = PGSQL_PASSWORD;
				
			$DBH = new PDO("pgsql:dbname=$dbname;host=$host;port=$port", $username, $password );
			
			} else {
			die 'The database' + DATABASE_TYPE + 'is not supported!';
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	
?>