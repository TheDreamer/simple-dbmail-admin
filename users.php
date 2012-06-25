<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Simple DBMail Admin</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 
 <?php include('menu.php'); ?>
 
 <div id="content_container">

  <?php include('db_connection.php'); ?> 
	
	<h2>Users</h2>
	<table id='users' border='1'>
	<tr> <th>User ID</th> <th>Mailbox storage</th> <th>last login</th> </tr>
	<?php	
	try {
		$STH = $DBH->prepare("SELECT * FROM dbmail_users WHERE userid NOT IN ('__@!internal_delivery_user!@__', 'anyone', '__public__')");
		$STH->execute();
		# setting the fetch mode
		$STH->setFetchMode(PDO::FETCH_ASSOC);
	
		$alt = false; // alter the class of tr
		while ($row = $STH->fetch())
		{
	    	$mbox_cur_mb = round($row['curmail_size'] / 1048576, 2);
			$mbox_max_mb = round($row['maxmail_size'] / 1048576, 2);
			//alternating the class of tr
			if ($alt){
				echo "<tr class='alt'>";
				$alt = false;
			} else {
				echo "<tr>";
				$alt = true;
			}
		
			echo "<td><a href='edit_user.php?user_idnr=".$row['user_idnr']."'>".$row['userid']."</a></td> <td>".$mbox_cur_mb." MB / ".$mbox_max_mb." MB</td> <td>".$row['last_login']."</td></tr>";
		}
		echo "</table>";
	
		// Show numer of entrys.
		$numberEntries = $STH->rowCount();
		echo "<p>Number of users: $numberEntries </p>";
	} catch (PDOException $e){
		echo "Can not do that: " . $e->getMessage();
	}
	
	?>
	
	<div id='button'><a href='new_user.php'>Add User</a></div>
	

	<div id='response'></div>
</body>
</html>