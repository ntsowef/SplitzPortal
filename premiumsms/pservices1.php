<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SMS System</title>
<style type="text/css">
body {
	background-color: #75889b;
}
</style>
<link href="backgroundControl.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script language = "javascript" style = "text/javascript"> 
function checkMaxLength(e,el)
{
	document.forms(0).Count.value = document.forms(0).Message.value.length + 1; 		
}
function MoreValue()
{
	
	if (document.forms(0).EMS.checked == true)
	{
		alert(document.forms(0).EMS.checked);
		alert("Note that additional charge will be incured");
	}
}
function OpenpopUp()
{
    alert("Submited...............");
}
function disable()
{   
	//alert ("in");
	var area = document.getElementById("Phone_numbers");
	var chk = document.getElementById("check");
	var brw = document.getElementById("file");
	if (chk.checked == true)
	{
		document.getElementById("file").disabled = false;
		document.getElementById("Phone_numbers").disabled = true;
	}
	else
	{	
		document.getElementById("file").disabled = true;
		document.getElementById("Phone_numbers").disabled = false;
	}
}
-->
</script>

</head>

<body marginheight="0px">
<div align="center">
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="backgroundControl"><table width="800" border="0" cellspacing="4" cellpadding="4">
        <tr>
          <td height="200">&nbsp;</td>
        </tr>
      </table>
        <table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="210" rowspan="3">&nbsp;</td>
            <td width="550" height="30" class="logintab">&nbsp;</td>
            <td width="40" rowspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td class="contentBg">
	    
	<?php
	require_once('calendar/classes/tc_calendar.php');
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	$admin= $_REQUEST['admin'];
	$id=$_REQUEST['id'];
	if(@$_POST['exit'])
		{
		$username = strtolower($_REQUEST['user']);
		$company = strtolower($_REQUEST['compan']);
		?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "poptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>&admin=<?php echo $admin;?>";	
			</script>
		<?php
		}

	if(@$_POST['submit'])	
	{
	 include "connect.php";
	 $admin= $_REQUEST['admin'];
	 $username = strtolower($_REQUEST['user']);
	 $company = strtolower($_REQUEST['compan']);
	 $startdate = isset($_REQUEST["startdate"]) ? $_REQUEST["startdate"] : "";
	 $enddate = isset($_REQUEST["enddate"]) ? $_REQUEST["enddate"] : "";
	 $message=$_POST['message'];
	 $cmessage=$_POST['cmessage'];
	 $id=$_POST['id'];
	 $pid=$_POST['pid'];
	 
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
	 {	//echo"<br>1 id: ".$id." ".$message." ".$cmessage." ".$enddate;
		$stat=1;
		include "connect.php";
		if($enddate != 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage',enddate='$enddate' where id='$pid'";
		 $result=mysql_query($sql) or die('Failed to update premium_competitions');
		}
		elseif($enddate == 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage' where id='$pid'";
		 $result=mysql_query($sql) or die('Failed to update premium_services');
		} 
		if($startdate != 0000-00-00)
		{
		 $sql="update premium_services set message='$message', cmessage='$cmessage',startdate='$startdate' where id='$pid'";
		 $result=mysql_query($sql) or die('Failed to update premium_services');
		}       	
		 ?>
		   <script language="javascript">
			  window.location="pservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";
		 </script>
		 <?php    
	 }
	 else
	 {echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>";
	 }
	}
	else
	{
	include "connect.php";
	 $query1="select id,Keyword,shortcode,enddate,message,cmessage from premium_services where id='$id'";
	 $result1=mysql_query($query1) or die('error selecting service ');
	 list($pid,$keyword,$shortcode,$enddate,$message,$cmessage)=mysql_fetch_row($result1);
	    $keyword=ucfirst(strtolower($keyword));
	?>
	<table width="540" valign="middle" align="center"border="0">
	<tr><td valign="middle" align="center">
	<form action="pservices1.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2"><b>Edit Premium SMS Service Details</b><br>&nbsp;</td></tr>
	<tr>
	     <td valign="top" >Start Date</td>
	     <td valign="top" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("startdate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		//$myCalendar->setYearInterval(2009, 2025);
		//$myCalendar->dateAllow('2009-12-15', '2020-03-01');
		$myCalendar->setYearInterval($datey, 2025);
		$myCalendar->dateAllow($date1, '2020-03-01');
		$myCalendar->setDateFormat('Y'.'-'.'m'.'-'.'d');
		$myCalendar->writeScript();
		$tripdt=$myCalendar->getDate();
	    ?>
	    </td>
	</tr>
	<tr>
	     <td valign="top" >End Date</td>
	     <td valign="top" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("enddate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		//$myCalendar->setYearInterval(2009, 2025);
		//$myCalendar->dateAllow('2009-12-15', '2020-03-01');
		$myCalendar->setYearInterval($datey, 2025);
		$myCalendar->dateAllow($date1, '2020-03-01');
		$myCalendar->setDateFormat('Y'.'-'.'m'.'-'.'d');
		$myCalendar->writeScript();
		$tripdt=$myCalendar->getDate();
	    ?>
	      </td>
	 </tr>
	 <tr>
	<td valign="top" width="40%">Reply Message<br>(160 characters)</td>
	<td><input type="text" name="message" size="45"value="<?php echo ucfirst($message);?>"></td>
	</tr>
	<tr>
	<td>Select Reply for Message after Closing Date(160 characters)</td>
	<td><select name="cmessage">
	<option value="<?php echo ucfirst($cmessage);?>"><?php echo ucfirst($cmessage);?></option>
	<option value="Thank you for entering competition, but note that it is closed">Please note that the competition is closed</option>
	<option value="Thank you, the competition deadline has passed">Thank you, the competition deadline has passed</option>
	</select>
	</td>
	</tr>
	</table>
	<table width="540" valign="middle">
	<tr>
	<td valign="top" align="right"width="80%">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="pid" value="<?php echo $pid;?>">
	<input type="hidden" name="admin" value="<?php echo $admin?>">
	<input type="submit" name="submit" value="Submit" />
	</td>
	<td align="left"valign="top">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="pid" value="<?php echo $pid;?>">
	<input type="hidden" name="admin" value="<?php echo $admin?>">
	 <input type="submit" name="exit" value="Exit" /></td>
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
          <tr>
            <td height="29" class="contentfoot">&nbsp;</td>
          </tr>
      </table>
        <table width="800" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="150">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>
