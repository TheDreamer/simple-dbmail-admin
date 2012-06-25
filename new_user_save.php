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
	
	try {
		$STH = $DBH->prepare("INSERT INTO dbmail_users SET userid= :userid, passwd= :passwd, encryption_type= :encryption_type, maxmail_size= :maxmail_size");
		$STH->bindParam(':userid', $_POST['userid']);
		$STH->bindParam(':passwd', $_POST['passwd']);
		$STH->bindParam(':encryption_type', $_POST['encryption_type']);
		$STH->bindParam(':maxmail_size', $mbox_max);
		
		$STH->execute();
	
		echo "User created! <a href='users.php'>back</a>";
	} catch (PDOException $e){
		echo "Can not do that: " . $e->getMessage();
	}
?>
</body>
</html>