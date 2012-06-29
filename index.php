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


<h2>Statistics</h2>
<table id='statistics'>
 <?php

 	try {
 		$STH1 = $DBH->prepare('SELECT SUM(curmail_size) AS mboxes_size, COUNT(user_idnr) as nr_users FROM dbmail_users');
 		$STH1->execute();
 		$STH1->setFetchMode(PDO::FETCH_ASSOC);
 		
 		while ($row = $STH1->fetch()) {
	    
	 		// calculating a human readable number for the mailbox size
 			$mboxes_size = round($row['mboxes_size'] / 1048576, 2);
			
		    echo "<tr> <th>Number of mailusers</th> <td>". ($row['nr_users'] - 3) ."</td></tr>";
			echo "<tr> <th>Size of all mailboxes</th> <td>". $mboxes_size ." MB</td></tr>"; 
			
		}
		
		$STH2 = $DBH->prepare('SELECT COUNT(alias_idnr) AS nr_aliases FROM dbmail_aliases');
		$STH2->execute();
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
		while ($row = $STH2->fetch()) { 
			echo "<tr> <th>Number of aliases</th> <td> ".$row['nr_aliases']." </td> </tr>";
		}
 	} catch (PDOException $e){
		echo "Can not do that: " + $e->getMessage();
 	}
?>
</table>


<br></br>

<p><b>Version: </b>20120629 - release candidate!</p>
<p>You will find Updates <a href='http://code.google.com/p/simple-dbmail-admin/'>here</a>.</p>
<p>Found a bug or missed a feature? Write an email to <a href='mailto:claaskaehler@gmail.com'>claaskaehler@gmail.com</a>!</p>
 </div>
	<div id='response'></div>
</body>
</html>