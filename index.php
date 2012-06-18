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
	
	<div id='response'></div>
</body>
</html>