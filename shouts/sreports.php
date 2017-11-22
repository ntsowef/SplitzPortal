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
	$userid = $_REQUEST['userid'];
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	if(@$_POST['submit'])	
	{$userid = $_REQUEST['userid'];
	 $username = strtolower($_POST['username']);
	 $company = strtolower($_POST['compan']);
	 $keyv= strtolower($_POST['keyword']);
	 $shcode= trim(substr($keyv,5,50));
	 $keyword  =substr($keyv,0,5);
	 $startdate = isset($_REQUEST["startdate"]) ? $_REQUEST["startdate"] : "";
	 $enddate = isset($_REQUEST["enddate"]) ? $_REQUEST["enddate"] : "";
	if($startdate == 0000-00-00)
	    {
		$startdate = '2010-01-01';
	    }
	if($enddate == 0000-00-00)
	   {
		$enddate ='2030-01-01';
	    }
	
	$query = "SELECT id,celnumber,keyword,shortcode,price,message,message_date from premium_shout_trans 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' order by message_date desc";        
	$result = mssql_query($query) or die("Couldn't select infor");
	$num=mssql_num_rows($result);
	if ($num > 0)
	{echo"<center><table width='550' border='0'> 
	  <tr bgcolor='pink'><td  colspan='6'align='center'><b><font size='3'>SMS Report between $startdate and $enddate</font></b></td></tr>";
	   echo"<tr bgcolor='#999999'>
	   <td width='11%'><font size='1'>Celnumber</font></td>
	   <td width='8%'><font size='1'>Keyword</font></td>
	   <td width='9%'><font size='1'>Shortcode</font></td>
	   <td width='5%'><font size='1'>Price</font></td>
	   <td width='18%'><font size='1'>Message Date</font></td>
	   <td width='47%'><font size='1'>Message</font></td>
	   </tr>";
	    while(list($id,$celnumber,$keyword,$shortcode,$price,$message,$message_date)=mssql_fetch_row($result))
	     {         
	      echo"
	      <tr>
	      <td width='11%' align='left'><input type='hidden' name='id' value='$id'><font size='1'>$celnumber</font></td>
	      <td width='8%'align='left'><font size='1'>$keyword</font></td>
	       <td width='9%'align='left'><font size='1'>$shortcode</font></td>
	       <td width='5%'align='left'><font size='1'>$price</font></td>
	       <td width='18%'align='left'><font size='1'>$message_date</font></td>
	       <td width='47%'align='left'><font size='1'>$message</font>
	       <input type='hidden' name='stdate' value='$startdate'>
		<input type='hidden' name='endate' value='$enddate'>
	       </td>
	       </tr>";
	      }
		echo"<tr bgcolor=''><td colspan='6'align='right' height='20'>
		<form action='soptions.php' method='post'>
		<input type='hidden' name='id' value='$id'>
		<input type='hidden' name='user' value='$username'>
		<input type='hidden' name='compan' value='$company'>
		<input type='hidden' name='admin' value='$admin'>
		<input type='hidden' name='stdate' value='$startdate'>
		<input type='hidden' name='endate' value='$enddate'>
		<input type='submit' name='exit' value='Exit'>
		</form></td></tr></table>";
	      }
	     else
	      {
		 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert("No messages in the database for the chosen criteria");
			window.location = "sreports.php?id=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>&stdate=<?php echo $stdate;?>&endate=<?php echo $endate;?>";									
		</script>
		   <?php
	      }
	 }
	 else
	{
	 echo"
	 <table  valign='middle' align='center'border='5'>
	 <tr><td valign='middle' align='center'>
	 <form action='sreports.php' method='post'>
	 <table valign='middle' >
	 <tr><td valign='middle' align='center' colspan='2'><b>SMS Reports</b></td></tr>
	 <tr><td valign='middle' align='center' colspan='2'>&nbsp;</td></tr>
	 <tr><td width='60%'valign='top' align='left'>Select a Service</td>
	 <td><select  name='keyword' id='keyword'>
		<option value=''>Select a Service</option>
		";
		 $query="select keyword,shortcode from premium_services where company='$company'";
		 $result=mssql_query($query) or die('error selecting service ');
		 while(list($key,$shortcode)=mssql_fetch_row($result))
		 {
		   $key=strtoupper($key);
		   $dis=$key.' '.$shortcode;
		   echo"<option value='$dis'>$dis</option>";
		 }
		?>	
	</select>
	 </td>
	 </tr>
	 <tr>
	     <td valign="top" >Start Date</td>
	     <td valign="top" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("startdate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2009, 2025);
		$myCalendar->dateAllow('2009-12-15', '2020-03-01');
		//$myCalendar->setYearInterval($datey, 2025);
		//$myCalendar->dateAllow($date1, '2020-03-01');
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
		$myCalendar->setYearInterval(2009, 2025);
		$myCalendar->dateAllow('2009-12-15', '2020-03-01');
		//$myCalendar->setYearInterval($datey, 2025);
		//$myCalendar->dateAllow($date1, '2020-03-01');
		$myCalendar->setDateFormat('Y'.'-'.'m'.'-'.'d');
		$myCalendar->writeScript();
		$tripdt=$myCalendar->getDate();
	    ?>
	     </td>
	 </tr>
	 
	 <?php
	 echo"
	 </table>
	 <tr>
	 <td colspan='2'>
	 <table width='400' valign='middle'>
	 <tr>
	 <td width='70%'valign='top' align='right'>
	 <input type='hidden' name='username' value='$username'>
	  <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='submit' name='submit' value='Submit'>
	 </td>
	 <td>
	  <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <a href='soptions.php?user=$username&compan=$company'><img src='images/exit.png' width='55' height='23' border='0'></a>
	 </td>
	 </tr>
	 </table>
	 
	 </td>
	 </tr>
	  </td></tr>
	 </table>
	 ";
	}
	?>
		
	  </td>
                  </tr>
                </table>
		
</body>
</html>
