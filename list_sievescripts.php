<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Delete Forward</title>
 </head>
<body>
 <?php include('db_connection.php'); ?>
<?php
try {
	$STH = $DBH->prepare('SELECT * FROM dbmail_sievescripts WHERE owner_idnr= :owner_idnr');
	$STH->bindParam(':owner_idnr', $_GET['user_idnr']);
	$STH->execute();
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	echo "<table id='sievescripts'>";
	echo "<th>Name</th><th>Status</th>";
		while ($row = $STH->fetch())
		{
			echo "<tr> <td><a href=''>".$row['name']."</a></td>";
			if ($row['active'] == "1")
				echo "<td class='active'>active</td>";
			else 
				echo "<td class='notactive'>not active</td>";
			echo "</tr>";
		}
	echo "</table>";
	$numberEntries = $STH->rowCount();
	echo "<p>Number of sievescrips: $numberEntries </p>";
} catch (PDOException $e){
	echo "Can not do that: " . $e->getMessage();
}
	
	
?>
</body>
</html>	
	
	
