<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Delete Forward</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>

 <?php 
 $sql = "DELETE FROM dbmail_users WHERE user_idnr='".$_GET['user_idnr']."'"; 
	// ausführen der Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	} else {
		echo "User deleted! <a href='index.php'>back</a>";
	}
?>

</body>
</html>