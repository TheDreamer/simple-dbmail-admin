<?php
     require_once ('config.php');

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      session_start();
	  $username = $_POST['username'];
      $password = $_POST['password'];

      $hostname = $_SERVER['HTTP_HOST'];
      $path = dirname($_SERVER['PHP_SELF']);

      // check login and password
      if ($username == SDBMA_LOGIN && $password == SDBMA_PASSWORD) {
      	$loginfailed = false;
      	$_SESSION['logedIn'] = true;

       // forward to startpage
       if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        if (php_sapi_name() == 'cgi') {
         header('Status: 303 See Other');
         }
        else {
         header('HTTP/1.1 303 See Other');
         }
        }

       header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/index.php');
       exit;
       } else {
       		$loginfailed=true;
       }
      }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 <h1>Simple DBMail Admin</h1>
 <div id='login_dialog'>
  <div id='inner_login_dialog'>
  <form id='login' action="login.php" method="post">
  <table>
  <tr>
   <td>Username: </td><td><input id='username_tx' type="text" name="username" /></td>
   </tr><tr>
   <td>Password: </td><td><input id='password_tx' type="password" name="password" /></td>
   </tr>
   </table>
   <a href="javascript:document.forms['login'].submit()" id='login_bt'>Login</a>
  </form>
  <?php ?>
  <div id='response'>
  <?php 
  	if($loginfailed){ 
  		echo "Login for $username failed!";
    } 
    ?>
  </div>
  </div>
  </div>
  
  <!-- Keylistener 'press the enter-key to login if the form is fucused'. -->
  <script type="text/javascript">
	function keydown (event){
	  if (!event)
	   event = window.event;
		  if (event.which) {
		    keycode = event.which;
		  } else if (event.keyCode) {
		    keycode = event.keyCode;
		  }
	   if (keycode == 13){
		  document.forms['login'].submit();
	   }
	}
	document.forms['login'].onkeydown = keydown;
 </script>
  
 </body>
</html>

