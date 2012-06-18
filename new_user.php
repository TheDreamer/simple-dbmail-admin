<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>New User</title>
 </head>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
 <h2>New User</h2>
<form action='new_user_save.php' id='new_user' method='post'>
	<table id='user'>
		
	<tr> <th>User ID</th> <td><input name='userid' type='text' size='30'></td><td><i>The ID/Login, e.g. user@domain.com</i></td></tr>
	<tr> <th>Password</th> <td><input name='passwd' type='text' size='30'> Type: <select name='encryption_type'><option></option><option>md5</option></select></td><td><i>If you are using SASL the password has to be unencrypted.</i></td> </tr>
	<tr> <th>Mailbox size</th> <td> <input name='maxmail_size' type='text' size='10' value='0'> MB</td> <td><i>0 means unlimited space.</i></td> </tr>
	
	</table>
	<div id='form_buttons'>
	<a href="javascript:document.forms['new_user'].submit()">Add</a>
	<a href="javascript:document.forms['new_user'].reset()">Reset</a>
	</div>
    </form>

</body>
</html>
 