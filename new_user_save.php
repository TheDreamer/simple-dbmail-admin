<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
 <link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>Save new User</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
  
 <?php 
	//calculate the Byte value insted of MB
	$mbox_max = $_POST['maxmail_size'] * 1048576;
	
	$sql = "INSERT INTO dbmail_users SET userid='".$_POST['userid']."', passwd='".$_POST['passwd']."', encryption_type='".$_POST['encryption_type']."', maxmail_size='".$mbox_max."'"; 
	// ausführen der Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Error: ' . mysql_error());
	} else {
		echo "User created! <a href='users.php'>back</a>";
	}
?>
</body>
</html>