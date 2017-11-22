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
	$userid = $_REQUEST['userid'];
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	if(@$_POST['submit'])	
	{$userid = $_REQUEST['userid'];
	 $username = strtolower($_REQUEST['user']);
	 $company = strtolower($_REQUEST['compan']);
	 $keyv= strtolower($_POST['keyword']);
	 $shcode= trim(substr($keyv,5,50));
	 $keyword  =substr($keyv,0,5);
	 //echo"<br>k s ".$keyword.' '.$shcode ;
	 
	 if(!empty($keyword))
	 {$status=1;
	  $keyw=ucfirst($keyword);
	 echo"
	 <table width='500' valign='middle' align='center'>
	 <tr><td valign='middle' align='center'>
	 <form action='sservices.php' method='post'>
	 <table valign='middle' >
	 <tr><td valign='middle' align='left' colspan='2'>My Services</td></tr>
	 <tr><td valign='middle' align='center' colspan='2'>&nbsp;</td></tr>
	 <tr><td width='60%'valign='top' align='left'>Please Select a Service from the List</td>
	 <td><select  name='keyword' id='keyword'>
		<option value=''>Please select a Service</option>
		";
		 $query="select keyword,shortcode from premium_services where company='$company'";
		 $result=mssql_query($query) or die('error selecting service '.mssql_get_last_message());
		 while(list($key,$shortcode)=mssql_fetch_row($result))
		 {
		   $key=strtoupper($key);
		   $dis=$key.' '.$shortcode;
		   echo"<option value='$dis'>$dis</option>";
		 }
			
	echo"
		</select>
	 </td>
	 </tr>
	 </table>
	 <table width='500' valign='middle'>
	 <tr>
	 <td width='71%'valign='top' align='right'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='submit' name='submit' value='Submit'>
	 </td>
	 <td align='left'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	  <a href='soptions.php?id=$id&user=$user&compan=$company&admin=$admin'><img src='images/exit.png' width='55' height='20'border='0'></a>
	 </td>
	 </tr>
	 </form>
	 </table>
	 </tr>
	 </td></tr>
	 </table>
	 <table width='500' valign='middle' align='center'>
	 <tr>
	 <td colspan='4' align='left'>Keyword: $keyword</td>
	 </tr>
	 <tr bgcolor='grey'>
	 <td>Keyword</td>
	 <td>Shortcode</td>
	 <td>Price</td>
	 <td>Created</td>
	 <td>End Date</td>
	 <td>Status</td>
	 <td align='center'>Update</td>
	 </tr>
	"; 
	 $query1="select id,keyword,shortcode,price,startdate,enddate,status from premium_services where company='$company' and keyword='$keyword' and shortcode='$shcode'";
	 $result1=mssql_query($query1) or die('error selecting service 1'.mssql_get_last_message());
	 while(list($id,$keyword,$shortcode,$price,$startdate,$enddate,$status)=mssql_fetch_row($result1))
	 {if($status==1){$status='Active';}else{$status='InActive';}
	   $keyword=ucfirst(strtolower($keyword));
	 echo"
	 <tr>
	 <td>$keyword</td>
	 <td>$shortcode</td>
	 <td>$price</td>
	 <td>$startdate</td>
	 <td>$enddate</td>
	 <td>$status</td>
	 <td><a href='sservices1.php?id=$id&user=$username&compan=$company'>Edit</a></td>
	 </tr>
	 ";
	 }
	 echo"
	 </table>
	 <table width='500'>
	 <tr><form action='soptions.php' method='post'>
	 <td colspan='4' align='right'>
	 <input type='submit' value='Exit'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 </td></form>
	  </tr>
	 </table>
	 ";
	 }
	 else
	 {
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please input valid Keyword');
			window.location = "sservices.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>";									
		</script>
	<?php
	 }
	}
	else
	{
	?>
	<table width="500" valign="middle" align="center">
	<tr><td valign="middle" align="center">
	<form action="sservices.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="left" colspan="2">My Services</td></tr>
	<tr><td valign="middle" align="left" colspan="2">&nbsp;</td></tr>
	<tr><td width="60%"valign="top" align="left">Please Select a Service from the List</td>
	<td>
	<select  name="keyword" id="keyword">
	<option value=""> Please select a Service</option>
	<?php
	 $query="select keyword,shortcode from premium_services where company='$company'";
	 $result=mssql_query($query) or die('error selecting service 2');
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
	</table>
	<table width="500" valign="middle">
	<tr><td valign="top" align="right"width="71%">
	<input type="submit" name="submit" value="Submit">
	</td>
	<td align="left">
	<input type="hidden" name="user" value="<?php echo $username?>">
	<input type="hidden" name="compan" value="<?php echo $company?>">
	<input type="hidden" name="user" value="<?php echo $username?>">
	<input type="hidden" name="compan" value="<?php echo $company?>">
	<a href="soptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>"><img src="images/exit.png" width="55" height="23"border="0"></a></form></td>
	</form></td>
	</tr>
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
		
</body>
</html>
