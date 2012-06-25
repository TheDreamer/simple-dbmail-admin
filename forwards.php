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
 
  <?php include('db_connection.php'); ?> 
	
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
	<!-- AJAX-Script for deleting a forward -->
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
	
	<div id='new_forward_container'>
	<form id='new_forward' action='' method='get'>
	<div id='lb_email_adress'>Email address </div><input type='text' name='alias' size='30'><div id='lb_deliver_to'> deliver to -> </div><input type='text' name='deliver_to' size='30'> <a href='JavaScript:saveAlias()'>Add</a>
	</form>
	</div>
	</div>
	<div id='response'></div>
</body>
</html>