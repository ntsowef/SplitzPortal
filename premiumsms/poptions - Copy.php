<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile: Premium SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
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
               $id=$_REQUEST['userid'];
		$username = $_REQUEST['user'];
		$company = $_REQUEST['compan'];
		$admin= $_REQUEST['admin'];
	       if(@$_POST['submit'])
                  {$id=$_POST['id'];
		    $username = $_POST['user'];
		    $company = $_POST['compan'];
		    $admin= $_POST['admin'];
		    $option= $_POST['option'];
	
		  if($option=='pcreatesvc')
                    { 
                   ?>
                         <script language = "javascript" style = "text/javascript"> 
                         window.location = "pcreateservice.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		     </script>
                         <?php
                    }
		    elseif($option=='pcheck')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "pcheck.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='pservices')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "pservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='preports')
                    {
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
                          window.location = "preports.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
		   }
		   else
		   {
                    ?>
                        <table border ="5"align="center">
                         <tr><td valign="top">
                        <form action="poptions.php" method="POST">
                        <table cellspacing="0" rules="none" align="center" bgcolor="white" width="300">
                         <tr>
                         <td valign="top" align="center" colspan="3"bgcolor="#D2D2D3" ><b>Choose an Option</b></td>
                         </tr>
                          <tr>
                         <td align="left" width="30%"></td> <td align="left"colspan="2">
		     <input type="radio" name="option" value="pcreatesvc">Create Service<br>
                         <input type="radio" name="option" value="pservices">My Services<br>
                         <input type="radio" name="option" value="pcheck">Check Service Availability<br>
                         <input type="radio" name="option" value="preports">Reports<br>
                         </td>
                         </tr>
                          <tr><td></td>
			 <td align="right" valign="top" width="20%">
			 <input type="submit" name="submit" value="Select" />
			  </td>  
			<td align="left"valign="top">
				 <input type="hidden" name="id" value="<?php echo $id;?>">
				 <input type="hidden" name="user" value="<?php echo $username;?>">
				 <input type="hidden" name="compan" value="<?php echo $company;?>">
				 <input type="hidden" name="admin" value="<?php echo $admin;?>">
				 <a href="index.php?id=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exit.png" width="55" height="23"border="0"></a>
			    </td>
		     </tr> 
			 
                         </table>
                           </td>
                         </tr> 
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
