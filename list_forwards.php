<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>List Forwards</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
	<?php include('db_connection.php'); ?>
	
	<?php
	// Select all targets for fowards, except local users
	$STH = $DBH->query('SELECT distinct deliver_to FROM dbmail_aliases WHERE deliver_to NOT IN (SELECT user_idnr from dbmail_users)');
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	
	echo "<table id='forwards'>";
	echo "<tr> <th>Deliver to</th> <th>Aliases</th></tr>";
	$alt = false; // alter the class of tr
	while ($row = $STH->fetch())
	{
		// Select all forwards to that selected target
		$STH2 = $DBH->query("SELECT * FROM dbmail_aliases WHERE deliver_to='".$row['deliver_to']."'");
		# setting the fetch mode
		$STH2->setFetchMode(PDO::FETCH_ASSOC);
		
		
		if ($alt){
			echo "<tr class='alt'>";
			$alt = false;
		} else {
			echo "<tr>";
			$alt = true;
		}
		echo "<td>".$row['deliver_to']."</td>";
		echo "<td>";
		while ($row2 = $STH2->fetch())
		{
			echo "".$row2['alias']." <a class='forward_del' href='JavaScript: delForward(".$row2['alias_idnr'].");'>X</a><br>";
		}
		echo "</td></tr>";
	}
	echo "</table>";
	// Show number of entries
	$numberEntries = $STH->rowCount();
	echo "<p>Number of Forwardaddresses: ".$numberEntries."</p>";
	
	# close the database connection
	$DBH = null;
	?>
</body>
</html>