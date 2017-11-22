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
	$keyword=$_REQUEST['keyword'];
	$shortcode=$_REQUEST['shortcode'];
	$price=$_REQUEST['price'];

	$stat=1;
	$dt=date('Y'.'-'.'m'.'-'.'d');
	$message='shout';
	$cmessage='shout';
	$sql="insert into premium_services values('$keyword','$shortcode','$price','$company','$message','$startdate','$enddate','$cmessage','$terms','$stat','$dt')";
	$result=mysql_query($sql) or die('Failed to insert premium_services');
	
?>
	  <script language="javascript">
		alert('Premium service for : <?php echo $keyword;?> created successifully');
		window.location="screateservice.php?&user=<?php echo $username;?>&compan=<?php echo $company;?>";
	 </script>

		
	  </td>
                  </tr>
                </table>
	
</body>
</html>
