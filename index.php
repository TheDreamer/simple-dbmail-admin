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
 
  <h1>Welcome to <b>Simple DBMail Admin</b></h1>
  
<hr align="left">


  <?php include('db_connection.php'); ?> 
	
	<h2>Users</h2>
	<table id='users' border='1'>
	<tr> <th>User ID</th> <th>User Name</th> <th>Mailbox storage</th> <th>last login</th> </tr>
	<?php	
	// SQL-Query
	$sql = "SELECT * FROM dbmail_users";
	// execute Query
	$db_erg = mysql_query( $sql );
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysql_error());
	}
	$alt = false; // alter the class of tr
	while ($daten = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
	{
    // Aushabe der Daten
	$mbox_cur_mb = round($daten['curmail_size'] / 1048576, 2);
	$mbox_max_mb = round($daten['maxmail_size'] / 1048576, 2);
	//alternating the class of tr
	if ($alt){
		echo "<tr class='alt'>";
		$alt = false;
	} else {
		echo "<tr>";
		$alt = true;
	}
	
	echo "<td><a href='edit_user.php?user_idnr=".$daten['user_idnr']."'>".$daten['userid']."</a></td> <td>".$daten['name']."</td> <td>".$mbox_cur_mb." MB / ".$mbox_max_mb." MB</td> <td>".$daten['last_login']."</td></tr>";
	}
	echo "</table>";
	
	// Show numer of entrys.
	$numberOfEntrys = mysql_num_rows($db_erg);
	echo "<p>Number of users: $numberOfEntrys </p>";
	?>
	
	<div id='button'><a href='new_user.php'>Add User</a></div>
	
	<!-- DBMail aliases group by deliver_to -->

	
<hr  align="left">
	
	
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
				document.getElementById("response").innerHTML=xmlhttp.responseText;
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
					document.getElementById("response").innerHTML=xmlhttp.responseText;
					loadForwards();
				}
			}
			xmlhttp.open("GET","del_forward.php?alias_idnr=" + alias_idnr,true);
			xmlhttp.send();
		}
	}
	</script>
	
	
	<form id='new_forward' action='' method='get'>
	Email address <input type='text' name='alias' size='30'> deliver to -> <input type='text' name='deliver_to' size='30'> <a href='JavaScript:saveAlias()'>Add</a>
	</form>
	</div>
	<div id='response'></div>
</body>
</html>