<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Update User</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <?php include('db_connection.php'); ?>

  
 <?php 
	//calculate the Byte value insted of MB
	$mbox_max = $_POST['maxmail_size'] * 1048576;
	
	try {
		if (!$_POST['user_idnr']) {
			throw new PDOException('user_idnr not set!');
		}
	
		$STH = $DBH->prepare("UPDATE dbmail_users SET userid= :userid, passwd= :passwd, encryption_type= :encryption_type, maxmail_size= :maxmail_size WHERE user_idnr= :user_idnr");
		$STH->bindParam(':userid', $_POST['userid']); 
		$STH->bindParam(':passwd', $_POST['passwd']); 
		$STH->bindParam(':encryption_type', $_POST['encryption_type']); 
		$STH->bindParam(':maxmail_size', $mbox_max); 
		$STH->bindParam(':user_idnr', $_POST['user_idnr']);
		
		$STH->execute();
		
		echo "Changes for saved for user ID: ". $_POST['user_idnr'] ."!";
	} catch (PDOException $e){
		echo "Can not do that: " . $e->getMessage();
 	}
			
?>