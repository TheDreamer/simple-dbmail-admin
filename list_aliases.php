<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Delete Forward</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>
<?php
	
	// SQL-Befehl für den Zugriff
	$sql2 = "SELECT * FROM dbmail_aliases WHERE deliver_to='".$_GET['user_idnr']."'";
	// ausführen des mysql-Befehls
	$db_erg2 = mysql_query( $sql2 );
	if ( ! $db_erg2 ){
		die('Ungültige Abfrage: ' . mysql_error());
	}
	echo "<table>";
	echo "<tr><th>Alias:</th></tr>";
	echo "<tr> <td>".$daten['deliver_to']."</td><td></td></tr>";
		while ($daten2 = mysql_fetch_array( $db_erg2, MYSQL_ASSOC))
		{
			echo "<tr> <td> </td> <td>".$daten2['alias']."</td><td><a class='forward_del' href='JavaScript: delAlias(".$daten2['alias_idnr'].");'>X</a></td></tr>";
		}
	echo "</table>";
	$anzahl_eintraege = mysql_num_rows($db_erg2);
	
	echo "<p>Number of Aliases: $anzahl_eintraege </p>";
	
	
	
?>
</body>
</html>	
	
	
