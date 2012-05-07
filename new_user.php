<?php include('auth.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>New User</title>
 </head>
 <?php include('db_connection.php'); ?>
 <?php include('menu.php'); ?>
 <h2>New User</h2>
<form action='new_user_save.php' method='post'>
	<table border='0'>
		
	<tr> <th>Name</th> <td><input name='name' type='text' size='30'> </td> </tr>
	<tr> <th>User ID</th> <td><input name='userid' type='text' size='30'></td> </tr>
	<tr> <th>Password</th> <td><input name='passwd' type='text' size='30'></td> <td>Type: <select name='encryption_type'><option></option><option>md5</option></select></td> </tr>
	<tr> <th>Mailbox size</th> <td> <input name='maxmail_size' type='text' size='10'> MB</td> <td></td><td><i>0 means unlimited space.</i></td> </tr>
	
	</table>
	<p>
	<input type="submit" value="Add">
    <input type="reset" value="Reset">
    </p>
	</form>

</body>
</html>
 