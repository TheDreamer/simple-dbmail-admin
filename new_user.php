<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>New User</title>
 </head>
 <body>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
 <div id="content_container">
 <h2>New User</h2>
<form action='new_user_save.php' id='new_user' method='post'>
	<table id='user'>
		
	<tr> <th>User ID</th> <td><input name='userid' type='text' size='30'></td><td><i>The ID/Login, e.g. user@domain.com</i></td></tr>
	<tr> <th>Password</th> 
	<td><input name='passwd' type='text' size='30'> Type: <select name='encryption_type'>
	<option name='plaintext'>plaintext</option>
	<option name='md5-hash'>md5-hash</option>
	<option name='md5-digest'>md5-digest</option>
	<option name='whirlpool'>whirlpool</option>
	<option name='sha512'>sha512</option>
	<option name='sha256'>sha256</option>
	<option name='sha1'>sha1</option>
	<option name='tiger'>tiger</option></select></td>
	<td><i>If you are using SASL the password has to be plaintext.</i></td> </tr>
	<tr> <th>Mailbox size</th> <td> <input name='maxmail_size' type='text' size='10' value='0'> MB</td> <td><i>0 means unlimited space.</i></td> </tr>
	
	</table>
	<div id='form_buttons'>
	<a href="javascript:saveUser()">Add</a>
	<a href="javascript:document.forms['new_user'].reset()">Reset</a>
	</div>
    </form>
	
	<!-- AJAX-Script for saving an user -->
	<script type="text/javascript">
	function saveUser()
	{
		var params = "userid=" + document.forms.new_user.userid.value
			+ "&passwd=" + document.forms.new_user.passwd.value
			+ "&encryption_type=" + document.forms.new_user.encryption_type.value
			+ "&maxmail_size=" + document.forms.new_user.maxmail_size.value;
		
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
		xmlhttp.open("POST","new_user_save.php",true);
		//Send the proper header information along with the request
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.setRequestHeader("Content-length", params.length);
		xmlhttp.setRequestHeader("Connection", "close");
		xmlhttp.send(params);
	}
	</script>
    
    
    
   <div id='response'></div>
   </div>
</body>
</html>
 