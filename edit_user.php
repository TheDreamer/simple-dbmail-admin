<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Details User</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 <div id='content_container'>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
 <h2>User</h2>
	
		
 <?php
 	echo "<form id='edit_user' action='edit_user_save.php?user_idnr=".$_GET['user_idnr']."' method='post'>";
 	echo "<table id='user'>";
 	try {
 		$STH = $DBH->prepare('SELECT * FROM dbmail_users WHERE user_idnr=:user_idnr');
 		$STH->bindParam(':user_idnr', $_GET['user_idnr']);
 		$STH->execute();
 		$STH->setFetchMode(PDO::FETCH_ASSOC);
 		while ($row = $STH->fetch()) {
	    
	 		// calculating a human readable number for the mailbox size
 			$mbox_cur_mb = round($row['curmail_size'] / 1048576, 2);
			$mbox_max_mb = round($row['maxmail_size'] / 1048576, 2);
			
		    echo "<tr> <th>user_idnr</th> <td id='user_idnr'>".$row['user_idnr']."</td> </tr>";
			echo "<tr> <th>User ID</th> <td><input name='userid' type='text' value='".$row['userid']."' size='30'></td><td><i>The ID/Login, e.g. user@domain.com</i></td> </tr>";
			echo "<tr> <th>Password</th> <td><input name='passwd' type='text' value='".$row['passwd']."' size='30'> Type: ";
			echo "<select name='encryption_type'>";
			if ($row['encryption_type'] == "" or $row['encryption_type'] == "")
				echo "<option name='plaintext' selected='selected'>plaintext</option>";
			else
				echo "<option name='plaintext'>plaintext</option>";
			if ($row['encryption_type'] == "md5-hash")
				echo "<option name='md5-hash' selected='selected'>md5-hash</option>";
			else
				echo "<option name='md5-hash'>md5-hash</option>";
			if ($row['encryption_type'] == "md5-digest")
				echo "<option name='md5-digest' selected='selected'>md5-digest</option>";
			else
				echo "<option name='md5-digest'>md5-digest</option>";
			if ($row['encryption_type'] == "md5-digest")
				echo "<option name='whirlpool' selected='selected'>whirlpool</option>";
			else
				echo "<option name='whirlpool'>whirlpool</option>";
			if ($row['encryption_type'] == "sha512")
				echo "<option name='sha512' selected='selected'>sha512</option>";
			else
				echo "<option name='sha512'>sha512</option>";
			if ($row['encryption_type'] == "sha256")
				echo "<option name='sha256' selected='selected'>sha256</option>";
			else
				echo "<option name='sha256'>sha256</option>";
			if ($row['encryption_type'] == "sha256")
				echo "<option name='sha1' selected='selected'>sha1</option>";
			else
				echo "<option name='sha1'>sha1</option>";
			if ($row['encryption_type'] == "tiger")
				echo "<option name='tiger' selected='selected'>tiger</option>";
			else
				echo "<option name='tiger'>tiger</option>";
			echo "</select></td> <td><i>If you are using SASL the password has to be plaintext.</i></td></tr>"; 
			echo "<tr> <th>Mailbox size</th> <td>".$mbox_cur_mb." MB / <input name='maxmail_size' type='text' value='".$mbox_max_mb."' size='10'> MB</td> <td><i>0 means unlimited space.</i></td> </tr>";
			echo "<tr> <th>Last Login</th> <td>".$row['last_login']."</td> </tr>";
		}
 	} catch (PDOException $e){
		echo "Can not do that: " + $e->getMessage();
 	}
?>
	</table>
	<div id='form_buttons'>
		<a href="javascript:saveUser()">Save</a>
		<a href="javascript:document.forms['edit_user'].reset()">Reset Changes</a>
		<a href='javascript:delUser()'>Delete User</a>
	</div>
	
	</form>
		
	
	<hr  align="left"></hr>
	
	<!-- DBMail aliases grouped by deliver_to -->
	
	<h2>Aliases</h2>

	
	<script type="text/javascript">
	function loadAliases()
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
				document.getElementById("aliases").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","list_aliases.php?user_idnr=" + document.getElementById('user_idnr').innerHTML,true);
		xmlhttp.send();
	}
	loadAliases();
	</script>

	<!-- AJAX-Script for saving an user -->
	<script type="text/javascript">
	function saveUser()
	{
		var params = "user_idnr=" + document.getElementById('user_idnr').innerHTML 
			+ "&userid=" + document.forms.edit_user.userid.value
			+ "&passwd=" + document.forms.edit_user.passwd.value
			+ "&encryption_type=" + document.forms.edit_user.encryption_type.value
			+ "&maxmail_size=" + document.forms.edit_user.maxmail_size.value;
		
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
			}
		}
		xmlhttp.open("POST","edit_user_save.php",true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(params);
	}
	</script>
	
	<!-- AJAX-Script for saving an alias -->
	<script type="text/javascript">
	function saveAlias()
	{
		var params = "deliver_to=" + document.getElementById('user_idnr').innerHTML + "&alias=" + document.forms.new_alias.alias.value;
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
				loadAliases();
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
	<!-- AJAX-Script for deleting an alias -->
	<script type="text/javascript">
	function delAlias(alias_idnr)
	{
		Check = confirm("Delete that alias? Alias=" + alias_idnr);
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
					loadAliases();
				}
			}
			xmlhttp.open("GET","del_forward.php?alias_idnr=" + alias_idnr,true);
			xmlhttp.send();
		}
	}
	</script>
	
	
	<div id='aliases'>
	</div>
	
	<div id='new_alias_container'>
	<form id='new_alias' action='JavaScript:saveAlias()' method='post'>
			<input type='text' name='alias' size='30'><a href='JavaScript:saveAlias()'>Add</a>
	</form>
	</div>
	<!-- Keylistener 'press the enter-key to create a new alias, if the form is fucused'. -->
  
	
	<!-- AJAX-Script for deleting an user -->
	<script type="text/javascript">
	function delUser()
	{
		Check = confirm("Delete that User? user_idnr=" + document.getElementById('user_idnr').innerHTML);
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
					window.location.href='users.php';
				}
			}
			xmlhttp.open("GET","del_user.php?user_idnr=" + document.getElementById('user_idnr').innerHTML,true);
			xmlhttp.send();
		}
	}
	</script>
	
	<div id='response'></div>
	</div>
	</body>
</html>
 