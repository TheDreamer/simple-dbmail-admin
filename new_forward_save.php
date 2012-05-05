<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Save Alias</title>
 </head>
 <body>
 <?php include('db_connection.php'); ?>
 
 <?php 
	$sql = "INSERT INTO dbmail_aliases SET alias='".$_POST['alias']."', deliver_to='".$_POST['deliver_to']."'"; 
	// ausführen der Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	} else {
		echo "New forward/alias added! ".$_POST['alias']." -> ".$_POST['deliver_to'];
	}
?>
</body>
</html>