<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile: Premium SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<div id="border">
<div id="rc1"></div><div id="rc2"></div>
<div class="white">
<div id="header">
<div id="left">


</div>
<div id="center" style="background-image:url(images/header-bg.jpg); background-repeat:repeat-x;">
<div id="logo-bg"><br>
	<br>
	<img border="0" src="images/Computek_Mobile_Logo.png" width="250" height="124"></div><div id="fireworks">
 <div class="tag">&nbsp;</div>
</div>

</div>
</div>
<div id="links-bg">
<div id="left2"></div><div id="center2">
<div class="toplinks"><a href="index.html">Homepage</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="About_Us.html">About</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Products.html">Products</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Services.html">Services</a></div>
<div class="sap">»</div>
<div class="toplinks">
	<a href="Contact_Us.html">Contact us</a></div>
</div><div id="right3"></div>
</div>
</div>
	<div class="white2"><div class="white">

	<div id="left10">
	<div id="rc5"><div class="heading2">&nbsp;</div></div>
	<div class="quicklinks">» <a href="About_Us.html">About 
		Us</a></div>
	<div class="quicklinks">» <a href="Products.html">Products</a></div>
	<div class="quicklinks">» <a href="Services.html">Services</a></div>
	<div class="quicklinks" style="width: 178px; height: 36px">» 
		<a href="Contact_Us.html">Contact Us</a></div>
	<div class="quicklinks">&nbsp;</div>
	</div>

	<div id="center10"></div>
	<div id="right10">
	<div style="clear:both;"><div id="rc7"></div><div id="rc-bg"></div>
	<div id="rc8"></div>
	</div>
	<div class="main2"><div class="heading" style="width: 517px; height: 55px">
		Welcome to Computek mobile</div></div>

	<div class="main">
 <div id="wrapper">
	<div id="conTent">
		<span class="box">
		<div id="in_right">
		

<?php	
	$username = $_REQUEST['user'];
	$company = $_REQUEST['compan'];
	$admin= $_REQUEST['admin'];
	if(@$_POST['submit'])	
	{   $username = strtolower($_POST['usernam']);
	     $password = strtolower($_POST['passwd']);
	     $stat=1;
	     $acc='premium';
	//include "mtn_connect.php";
	include "remote_connect.php";
	$query = "SELECT id,username,password,company,accounttype_p,accounttype_o  from accounts 
			WHERE username = '$username' AND password = '$password' and status='$stat' and accounttype='$acc'";			 
	$result = mssql_query($query) or die("Couldn't select infor");
	if (mssql_num_rows($result) > 0)
	{
	  list($id,$username,$password,$company,$acc,$accounttype_p,$accounttype_o )=mssql_fetch_row($result);
	  ?> 
		<script language = "javascript" style = "text/javascript"> 
			window.location = "poptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>";									
		</script>
	   <?php
	}
	else
	{
	  ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('No such Username or Password for account type: premium. Please re-try or check with your administrator');
			window.location = "index.php";									
		</script>
	    <?php
	}
	}
	else
	{        
	 ?>
	 <table cellspacing="0" rules="none" valign="middle" align="center">
	 <tr><td align="center"valign="middle">
	     <form action="index.php" method="post">
               <table cellspacing="0" rules="none" valign="middle" align="center">
                 <tr>
                   <td valign="top">Username</td>
                   <td colspan="2"><input type="text" name="usernam"  size="23"/></td>
                 </tr>
                 <tr>
                   <td valign="top">Password</td>
                   <td colspan="2"><input type="password" name="passwd" size="23"/></td>
                 </tr>
                 <tr>
                   <td>
		  <input type="hidden" name="username" value="<?php echo $username;?>"/>
		  <input type="hidden" name="company" value="<?php echo $company;?>"/>
		  <input type="hidden" name="admin" value="<?php echo $admin;?>"/>
		</td>
		<td align="right" valign="top" width="80%">
			
			<input type="submit" name="submit" value="Login" />
		   </td>
		   <td align="left" valign="top" >
		     	<a href="http://www.computekmobile.co.za/myservices/options.php?username=<?php echo $username;?>&company=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exiting_03.gif" width="60" height="23"border="0"></a>
		</td>
                 </tr>
               </table>
             </form>
	     </td></tr>
	     </table>
	 <?php
	}
	?> 
		
		
	  </td>
                  </tr>
                </table>
			</div>
		</span></div>
	</div>
	</div>
	<div style="clear:both;">
	<div id="rc12"></div><div id="rc-bg2"></div>
	<div id="rc13"></div></div><div style="height:20px;"></div>
	</div>
	</div></div>
	<div></div>
	<div id="rc10"></div><div id="rc11"></div>
	<div class="bottom">
<div class="toplinks"><a href="index.html">Homepage</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="About_Us.html">About</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Products.html">Products</a></div>
<div class="sap">»</div>
<div class="toplinks"><a href="Services.html">Services</a></div>
<div class="sap">»</div>
<div class="toplinks">
	<a href="Contact_Us.html">Contact us</a></div>
</div>

<center>
<div style="height:28px; line-height:28px; width:779px; clear:left;"><strong>Designed by 
	<a href="http://www.computek.co.za">Computek</a> Pty (LTD) 2010</strong></div></center>
</div>

</center>
</body>
</html>
