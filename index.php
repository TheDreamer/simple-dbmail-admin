<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Geschützter Bereich</title>
 </head>
 <body>
 <?php include('menu.php'); ?>
  <h1>Herzlich willkommen beim Simple <b>DBMail Admin</b></h1>
  <p>Sie sind nun angemeldet.</p>

  <?php include('db_connection.php'); ?> 
	
	<h2>User</h2>
	<table border='1'>
	<tr> <th>user ID</th> <th>name</th> <th>Mailbox storage</th> <th>Sieve storage</th> <th>last_login</th> </tr>
	
	<?php	
	// SQL-Query
	$sql = "SELECT * FROM dbmail_users";
	// ausführen der Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	}
	while ($daten = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
	{
    // Aushabe der Daten
	$mbox_cur_mb = round($daten['curmail_size'] / 1048576, 2);
	$mbox_max_mb = round($daten['maxmail_size'] / 1048576, 2);
	$sieve_cur_mb = round($daten['cursieve_size'] / 1048576, 2);
	$sieve_max_mb = round($daten['maxsieve_size'] / 1048576, 2);
    echo "<tr> <td><a href='edit_user.php?user_idnr=".$daten['user_idnr']."'>".$daten['userid']."</a></td> <td>".$daten['name']."</td> <td>".$mbox_cur_mb." MB / ".$mbox_max_mb." MB</td> <td>".$sieve_cur_mb." MB / ".$sieve_max_mb." MB</td>  <td>".$daten['last_login']."</td></tr>";
	}
	echo "</table>";
		// Anzeige der Anzahl der Einträge
	$anzahl_eintraege = mysql_num_rows($db_erg);
	echo "<p>Number of users: $anzahl_eintraege </p>";
	?>
	
	
	<!-- DBMail aliases gruppiert nach deliver_to -->
	
	<h2>Forwards</h2>
	
	<script type="text/javascript">
	function loadForwards()
	{
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("list_forwards").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","list_forwards.php",true);
		xmlhttp.send();
	}
	
	loadForwards();
	
	</script>
	
	<div id='list_forwards'></div>
	
	<!-- AJAX-Script for Adding a Forward -->
	<script type="text/javascript">
	function saveAlias()
	{
		var params = "deliver_to=" + document.forms.new_forward.deliver_to.value + "&alias=" + document.forms.new_forward.alias.value;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("saveForwardResponse").innerHTML=xmlhttp.responseText;
				loadForwards();
			}
		}
		xmlhttp.open("POST","new_forward_save.php",true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(params);
	}
	</script>
	<!-- AJAX-Script for deleting a Forward -->
	<script type="text/javascript">
	function delForward(alias_idnr)
	{
		Check = confirm("Delete that forward? Alias=" + alias_idnr);
		if (Check == true){
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("saveForwardResponse").innerHTML=xmlhttp.responseText;
					loadForwards();
				}
			}
			xmlhttp.open("GET","del_forward.php?alias_idnr=" + alias_idnr,true);
			xmlhttp.send();
		}
	}
	</script>
	
	<div id='saveForwardResponse'></div>
	<form name='new_forward' action='' method='get'>
	Email address <input type='text' name='alias' size='30'> deliver to -> <input type='text' name='deliver_to' size='30'> <input type='button' value='Add' onClick='saveAlias()'>
	</form>
	
	<?php
	// DBMail aliases
	echo "<h2>dbmail_aliases</h2>";
	// SQL-Befehl für den Zugriff
	$sql = "SELECT * FROM dbmail_aliases";
	// ausführen des mysql-Befehls
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	}
	echo "<table border='1'>";
	echo "<tr> <th>alias_idnr</th> <th>alias</th> <th>deliver_to</th> <th>client_idnr</th> </tr>";
	
	while ($daten = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
	{
    // Aushabe der Daten
    echo "<tr> <td>".$daten['alias_idnr']."</td> <td>".$daten['alias']."</td> <td>".$daten['deliver_to']."</td> <td>".$daten['client_idnr']."</td></tr>";
	}
	echo "</table>";
	// Anzeige der Anzahl der Einträge
	$anzahl_eintraege = mysql_num_rows($db_erg);
	echo "<p>Anzahl der Einträge: $anzahl_eintraege</p>";
	?>	

</body>
</html>