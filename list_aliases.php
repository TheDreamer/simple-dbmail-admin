<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Delete Forward</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>
<?php
try {
	$STH = $DBH->prepare('SELECT * FROM dbmail_aliases WHERE deliver_to= :deliver_to');
	$STH->bindParam(':deliver_to', $_GET['user_idnr']);
	$STH->execute();
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	echo "<table>";
		while ($row = $STH->fetch())
		{
			echo "<tr> <td>".$row['alias']."</td><td><a class='forward_del' href='JavaScript: delAlias(".$row['alias_idnr'].");'>X</a></td></tr>";
		}
	echo "</table>";
	$numberEntries = $STH->rowCount();
	echo "<p>Number of Aliases: $numberEntries </p>";
} catch (PDOException $e){
	echo "Can not do that: " + $e->getMessage();
}
	
	
?>
</body>
</html>	
	
	
