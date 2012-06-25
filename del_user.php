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
 	$DBH->beginTransaction();
 	
 	$STH1 = $DBH->prepare('DELETE FROM dbmail_aliases WHERE deliver_to=:deliver_to');
 	$STH1->bindParam(':deliver_to', $_GET['user_idnr']);
 	$STH1->execute();
 	
 	$STH2 = $DBH->prepare('DELETE FROM dbmail_users WHERE user_idnr=:deliver_to');
 	$STH2->bindParam(':deliver_to', $_GET['user_idnr']);
 	$STH2->execute();
 	
 	$DBH->commit();
 	
 	
 	echo "User deleted! <a href='index.php'>back</a>";
 } catch (PDOException $e){
 	$DBH->rollBack();
 	echo "Can not do that: " . $e->getMessage();
 }
 

?>

</body>
</html>