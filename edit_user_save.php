<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Details Benutzer</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
  
 <?php 
	//calculate the Byte value insted of MB
	$mbox_max = $_POST['maxmail_size'] * 1048576;
	$sieve_max = $_POST['maxsieve_size'] * 1048576;
	
	$sql = "UPDATE dbmail_users SET userid='".$_POST['userid']."', passwd='".$_POST['passwd']."', encryption_type='".$_POST['encryption_type']."', client_idnr='".$_POST['client_idnr']."', maxmail_size='".$mbox_max."', maxsieve_size='".$sieve_max."' WHERE user_idnr=".$_GET['user_idnr']; 
	// ausführen der Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Error: ' . mysql_error());
	} else {
		echo "Changes saved! <a href='edit_user.php?user_idnr=".$_GET['user_idnr']."'>back</a>";
	}
?>