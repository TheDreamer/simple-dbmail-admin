<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Simple DBMail Admin</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 
 <?php include('menu.php'); ?>
 <?php include('db_connection.php'); ?> 
 
 <div id="content_container">
 
  <h1>Welcome to <b>Simple DBMail Admin</b></h1>

<div id='version'><b>Version: </b>1.0 RC2 - You will find updates <a href='http://code.google.com/p/simple-dbmail-admin/'>here</a>.</div>
  
<h2>Statistics</h2>
<table id='statistics'>
 <?php

 	try {
 		$STH = $DBH->prepare('SELECT SUM(curmail_size) AS mboxes_size, COUNT(user_idnr) as nr_users FROM dbmail_users');
 		$STH->execute();
 		$STH->setFetchMode(PDO::FETCH_ASSOC);
 		
 		while ($row = $STH->fetch()) {
	    
	 		// calculating a human readable number for the mailbox size
 			$mboxes_size = round($row['mboxes_size'] / 1048576, 2);
			
		    echo "<tr> <th>Number of mailusers</th> <td>". ($row['nr_users'] - 3) ."</td></tr>";
			echo "<tr> <th>Size of all mailboxes</th> <td>". $mboxes_size ." MB</td></tr>"; 
			
		}
		
		$STH = $DBH->prepare('SELECT COUNT(alias_idnr) AS nr_aliases FROM dbmail_aliases');
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $STH->fetch()) { 
			echo "<tr> <th>Number of aliases</th> <td> ".$row['nr_aliases']." </td> </tr>";
		}
		
		$STH = $DBH->prepare('select Count(id) as nr_messages from dbmail_physmessage;');
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $STH->fetch()) {
			echo "<tr> <th>Number of messages</th> <td> ".$row['nr_messages']." </td> </tr>";
		}
		
		$STH = $DBH->prepare('select Count(id) as nr_messages from dbmail_physmessage where TO_DAYS(internal_date) > TO_DAYS(NOW())-100;');
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $STH->fetch()) {
			echo "<tr> <th>Average messages per day <br> (last 100 days)</th> <td> ". ($row['nr_messages']/100) ." </td> </tr>";
		}
		
 	} catch (PDOException $e){
		echo "Can not do that: " + $e->getMessage();
 	}
?>
</table>


<br></br>

 </div>
	<div id='response'></div>
</body>
</html>