<?php
	require_once ('config.php');
	$db_link = @mysql_connect (MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASSWORD);
	if ( ! $db_link ){
		die('No Connection! Try it later!');
	}
	$db_sel = mysql_select_db( MYSQL_DATASE )
    or die("Could not select database!");
?>