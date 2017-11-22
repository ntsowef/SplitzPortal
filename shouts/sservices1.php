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
	<?php
	include "connect.php";
	require_once('calendar/classes/tc_calendar.php');
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	$id=$_REQUEST['id'];

	if(@$_POST['submit'])	
	{
	 $username = strtolower($_REQUEST['user']);
	 $company = strtolower($_REQUEST['compan']);
	 $startdate = isset($_REQUEST["startdate"]) ? $_REQUEST["startdate"] : "";
	 $enddate = isset($_REQUEST["enddate"]) ? $_REQUEST["enddate"] : "";
	 $message=$_POST['message'];
	 $cmessage=$_POST['cmessage'];
	 $id=$_POST['id'];
	 
	 $status="OK";
	  if(empty($message))
	   {$msg="Reply message must not be empty<br>";
	    $status="False";
	   }
	  if(empty($cmessage))
	   {$msg="Closing Reply message must not be empty<br>";
	    $status="False";
	   }
	  
	 if($status=='OK')
	 {	
		$stat=1;
		include "connect.php";
		$message='shout';
		$cmessage='shout';
		if($enddate != 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage',enddate='$enddate' where id='$id'";
		 $result=mysql_query($sql) or die('Failed to update premium_competitions');
		}
		elseif($enddate == 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage' where id='$id'";
		 $result=mysql_query($sql) or die('Failed to update premium_services');
		} 
		if($startdate != 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage',startdate='$startdate' where id='$id'";
		 $result=mysql_query($sql) or die('Failed to update premium_services');
		}       	
		 ?>
		   <script language="javascript">
			  window.location="sservices.php?&username=<?php echo $username;?>&company=<?php echo $company;?>";
		 </script>
		 <?php    
	 }
	 else
	 {echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>";
	 }
	}
	else
	{
	 $query1="select pid,Keyword,shortcode from premium_services where id='$id'";
	 $result1=mysql_query($query1) or die('error selecting service ');
	 list($id,$keyword,$shortcode)=mssql_fetch_row($result1);
	    $keyword=ucfirst(strtolower($keyword));
	?>
	<table width="500" valign="middle" align="center"border="1">
	<tr><td valign="middle" align="center">
	<form action="sservices1.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2"><b>Edit Service Details</b><br>&nbsp;</td></tr>
	<tr><td valign="middle" align="center" colspan="2"><b>&nbsp;</b></td></tr>
	</table>
	<table width="500" valign="middle">
	<tr>
	<td valign="top" align="right"width="85%">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="submit" name="submit" value="Submit">
	</td>
	<td align="left"valign="top">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<a href="soptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>"><img src="images/exit.png" width="55" height="23"border="0"></a>
	</td>
	</td>
	</tr>
	</form>
	</table>
	</tr>
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
<div class="sap">�</div>
<div class="toplinks"><a href="About_Us.html">About</a></div>
<div class="sap">�</div>
<div class="toplinks"><a href="Products.html">Products</a></div>
<div class="sap">�</div>
<div class="toplinks"><a href="Services.html">Services</a></div>
<div class="sap">�</div>
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
