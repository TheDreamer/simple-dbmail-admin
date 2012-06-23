<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Delete User</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>

 <?php 
 
 try {
 	$sql = "DELETE FROM dbmail_users WHERE user_idnr='".$_GET['user_idnr']."'"; 
 	// execute query
 	$db_erg = $DBH->exec( $sql );
 	echo "User deleted! <a href='index.php'>back</a>";
 } catch (PDOException $e){
 	echo "Can not do that: " + $e->getMessage();
 }
 

?>

</body>
</html>