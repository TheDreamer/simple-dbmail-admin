<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Save Alias</title>
 </head>
 <body>
 <?php include('db_connection.php'); ?>
 
 <?php 
 try {
 	$STH = $DBH->prepare("INSERT INTO dbmail_aliases SET alias= :alias, deliver_to= :deliver_to");
 	$STH->bindParam(':alias', $_POST['alias']);
 	$STH->bindParam(':deliver_to', $_POST['deliver_to']);
 	
 	$STH->execute();
 	echo "New forward/alias added! ".$_POST['alias']." -> ".$_POST['deliver_to'];
 
 	} catch (PDOException $e){
 		echo "Can not do that: " + $e->getMessage();
 	} 	
?>
</body>
</html>