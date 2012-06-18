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
	// SQL-Befehl für den Zugriff
	$sql = "SELECT distinct deliver_to FROM dbmail_aliases WHERE deliver_to NOT IN (SELECT user_idnr from dbmail_users)";
	// ausführen des mysql-Befehls
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	}
	echo "<table id='forwards'>";
	echo "<tr> <th>Deliver to</th> <th>Aliases</th></tr>";
	$alt = false; // alter the class of tr
	while ($daten = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
	{
		// MySQL-command
		$sql2 = "SELECT * FROM dbmail_aliases WHERE deliver_to='".$daten['deliver_to']."'";
		// execute MySQL-command
		$db_erg2 = mysql_query( $sql2 );
		if ( ! $db_erg2 ){
			die('Ungültige Abfrage: ' . mysql_error());
		}
		if ($alt){
			echo "<tr class='alt'>";
			$alt = false;
		} else {
			echo "<tr>";
			$alt = true;
		}
		echo "<td>".$daten['deliver_to']."</td>";
		echo "<td>";
		while ($daten2 = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
		{
			echo "".$daten2['alias']." <a class='forward_del' href='JavaScript: delForward(".$daten2['alias_idnr'].");'>X</a><br>";
		}
		echo "</td></tr>";
	}
	echo "</table>";
	// Show number of entries
	$numberEntries = mysql_num_rows($db_erg);
	echo "<p>Number of Forwardaddresses: ".$numberEntries."</p>";
	?>
</body>
</html>