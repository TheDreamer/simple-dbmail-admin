<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>List Forwards</title>
 </head>
 <body>
	<?php include('db_connection.php'); ?>
	
	<?php
	// SQL-Befehl f�r den Zugriff
	$sql = "SELECT distinct deliver_to FROM dbmail_aliases";
	// ausf�hren des mysql-Befehls
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ung�ltige Abfrage: ' . mysql_error());
	}
	//echo "<table>";
	//echo "<tr> <th>deliver_to</th> <th>alias</th> </tr>";
	echo "<ul>";
	while ($daten = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
	{
		// SQL-Befehl f�r den Zugriff
		$sql2 = "SELECT * FROM dbmail_aliases WHERE deliver_to='".$daten['deliver_to']."'";
		// ausf�hren des mysql-Befehls
		$db_erg2 = mysql_query( $sql2 );
		if ( ! $db_erg2 ){
			die('Ung�ltige Abfrage: ' . mysql_error());
		}
		echo "<li>".$daten['deliver_to']."</li>";
		echo "<ul>";
		while ($daten2 = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
		{
			echo "<li>".$daten2['alias']." <a href='JavaScript: delForward(".$daten2['alias_idnr'].");'>X</a></li>";
		}
		echo "</ul>";
	}
	echo "</ul>";
	// Anzeige der Anzahl der Eintr�ge
	$anzahl_eintraege = mysql_num_rows($db_erg);
	echo "<p>Number of Forwardaddresses: $anzahl_eintraege </p>";
	?>
</body>
</html>