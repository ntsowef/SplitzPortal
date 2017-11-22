<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>


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
          <td height="20">&nbsp;</td>
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
	$vtot=0;
	$vtot1=0;
	$vtot2=0;
	$ctot=0;
	$tot=0;
	require_once('calendar/classes/tc_calendar.php');
	$uid = $userid;
	$username = strtolower($username);
	$company = strtolower($company);
	$admin= $admin;
	$page_name="preports.php"; 
	
	
	
		
	$start=$_GET['start'];
	if(strlen($start) > 0 and !is_numeric($start)){
	echo "Data Error";
	exit;
	} 
	
	$eu = ($start - 0);
	$limit = 10; // No of records to be shown per page.
	$here = $eu + $limit;
	$back = $eu - $limit;
	$next = $eu + $limit;

	if(@$_POST['exit'])
		{
			$uid = $id;
			$username = strtolower($username);
			$company = strtolower($company);
			$admin= $admin;
			?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "poptions.php?userid=<?php echo $uid;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";	
			</script>
			<?php
		}	      

	
		

	$uid = $id;
	 //$username = strtolower($_REQUEST['username']);
	 //$company = strtolower($_POST['compan']);
	 $keyword = strtolower($_REQUEST['keyword']);
	 $startdate = isset($_REQUEST["startdate"]) ? $_REQUEST["startdate"] : "";
	 $enddate = isset($_REQUEST["enddate"]) ? $_REQUEST["enddate"] : "";
	// $celc=0;
	 $etl=0;
	 $voda=0;
	 $kwd =$keyword ;
	 	/*
	if($startdate == 0000-00-00)
	    {
		$startdate = '2010-01-01';
	    }
	if($enddate == 0000-00-00)
	   {
		$enddate ='2030-01-01';
	    }
	*/
	if($startdate == 0000-00-00)
	 {
	 $startdate ='2010-01-01 00:00:00';
	 }
	 else
	 {
	 $startdate =$startdate.' 00:00:00';
	 }
	if($enddate ==0000-00-00)
	 {
	 $enddate =date('Y'.'-'.'m'.'-'.'d 23:59:00');
	 }
	 else
	 {
	 $enddate=$enddate.' 23:59:00';
	 }
	$startdate =substr($startdate,0,19);
	$enddate =substr($enddate,0,19);
	include "connect.php";
	$query = "SELECT id,celnumber,keyword,shortcode,price,message,message_date from premium_transactions 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' order by message_date desc";        
	//echo $query.'<br>';
        
        $result = mysql_query($query) or die("Couldn't select infor ".mysql_error());
	$num=mysql_num_rows($result);
	if ($num > 0)
	{
	
	$query = "SELECT id,celnumber,keyword,shortcode,price,message,message_date from premium_transactions 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' order by message_date desc limit $eu, $limit";        
	$result = mysql_query($query) or die("Couldn't select infor ".mysql_error());
	//$num=mysql_num_rows($result);
	//----------------------------------------
	/*$count = "SELECT count(celnumber),price, operator from premium_transactions 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' Group by operator";        
	$res = mysql_query($count) or die("Couldn't select infor ".mysql_error());
	while(list($total,$price,$operator)=mysql_fetch_row($res))
	{
		
	   $operator=strtoupper($operator);
	   
	   $price=substr($price,1);
	   if(substr($operator,0,3)=='MTN' )
	   { $mtn=$total;  
		$mtn_rev=$mtn*$price;
	   }
	   elseif(substr($operator,0,2)=='VO' )
	   { $voda= $total;
		$voda_rev=$voda*$price;
	}
	   
	   elseif(substr($operator,0,3)=='CEL' )
	   { 
		$celc= $total;
		$celc_rev=$celc*$price;
		}	   
	   
	}*/
	
	$sql=mysql_query("select distinct price from premium_transactions where keyword ='$keyword' and company='$company'") or die("Couldn't select price infor ".mysql_error());
	list($R_price)=mysql_fetch_row($sql);
	$price = $R_price; //substr($R_price,1);
	
	$vo = "SELECT count(celnumber) from premium_transactions 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' and operator like'VODA%'";        
	$voda_res = mysql_query($vo) or die("Couldn't select infor ".mysql_error());
	list($voda_total)=mysql_fetch_row($voda_res);
	$voda_rev=$voda_total*$price;
	
	$etl = "SELECT count(celnumber) from premium_transactions 
				where keyword = '$keyword' and company='$company' and message_date between '$startdate' and '$enddate' and operator like'ETL%'";        
	$mtn_res = mysql_query($etl) or die("Couldn't select infor ".mysql_error());
	list($etl_total)=mysql_fetch_row($mtn_res);
	$etl_rev=$etl_total*$price;
	
		
	
	
	
	//----------------------------------
	if ($num > 0)
	{
	
		$tot=$voda_total+$etl_total;
		$tot_rev=$voda_rev+$etl_rev;
	
	  // <tr bgcolor=''><td  colspan='6'align='center'><font size='2'><b>Vodacom: $vtot  <b>MTN:$tot1  <b>CELC:$ctot   <b>Total Records: $tot</b></td></tr>
	   echo"<center><table width='550' border='0' bgcolor='white'> 
	  <tr bgcolor=''><td  colspan='6'align='center'><font size='2'>SMS Report between $startdate and $enddate</font></b></td></tr>
	   <tr bgcolor=''><td  colspan='6'align='center'><font size='2'>ETL : $etl_total = R$etl_rev<br> Vodacom : $voda_total = R$voda_rev  <br><B>Total Records : $tot = R$tot_rev</b></td></tr>
	   <tr bgcolor=''><td  colspan='6'align='right'><font size='2'><a href ='exportexcel.php?startdate=$startdate&enddate=$enddate&keyword=$kwd&compan=$company' />Export to excel</td></tr>
	  ";
	   echo"<tr bgcolor='white'>
	   <td width='11%'><font size='2'><b>Celnumber</font></td>
	   <td width='8%'><font size='2'><b>Keyword</font></td>
	   <td width='9%'><font size='2'><b>Shortcode</font></td>
	   <td width='5%'><font size='2'><b>Price</font></td>
	   <td width='18%'><font size='2'><b>Date</font></td>
	   <td width='47%'align='center'><font size='2'><b>Message</font></td>
	   </tr>
	   ";
	    while(list($id,$celnumber,$keyword,$shortcode,$price,$message,$message_date)=mysql_fetch_row($result))
	     {  $message_date=substr($message_date,0,10);
		if($bgcolor==''){$bgcolor='lightgray';}
			else{$bgcolor='';}
                  echo"
                  <tr bgcolor=$bgcolor>
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
		echo"<tr bgcolor=''>
		<td colspan='5'align='CENTER' height='20'></td>
		<td colspan='1'align='right' height='20'>
		<form action='preports.php' method='post'>
		<input type='hidden' name='userid' value='$uid'>
		<input type='hidden' name='user' value='$username'>
		<input type='hidden' name='compan' value='$company'>
		<input type='hidden' name='admin' value='$admin'>
		<input type='hidden' name='kwd' value='$kwd'>
		<input type='hidden' name='stdate' value='$startdate'>
		<input type='hidden' name='endate' value='$enddate'>		
		<a href ='exportexcel.php?startdate=$startdate&enddate=$enddate&keyword=$kwd&compan=$company' /><font size='2'>Export to excel
		</td>
		</tr>
		<tr>
		<td colspan ='6'align ='right'><input type='submit' name='exit' value='Exit'</td>
		</form>
		</tr>
		</table>";
		
		
echo "<table align = 'center' width='100%'><tr><td align='right' width='25%'>";
if($back >=0) {
print "<a href='$page_name?start=$back&startdate=$startdate&enddate=$enddate&compan=$company&keyword=$kwd&user=$username&admin=$admin'><font face='Verdana' size='2'>PREV</font></a>";
}

/*Let us display the page links at center. We will not display the current page as a link and we will give it red color with a higher size font*/

echo "</td><td align=center width='50%'>";
$i=0;
$l=1;
for($i=0;$i<$num;$i=$i+$limit)
{
    if($i<>$eu)
    {
    //echo " <a href='$page_name?start=$i&startdate=$startdate&enddate=$enddate&compan=$company&keyword=$kwd&user=$username&admin=$admin'><font face='Verdana' size='2'>$l</font></a> ";
    }
    else { echo "<font face='Verdana' size='4' color=red>$l</font>";} /// Current page is not displayed as link and given font color red
    $l=$l+1;
}
/*Now let us check for the NEXT link at the right side on our condition and accordingly display. 
If we are in the last page then we will not display the NEXT link */


echo "</td><td align='left' width='25%'>";
if($here < $num) {
print "<a href='$page_name?start=$next&startdate=$startdate&enddate=$enddate&compan=$company&keyword=$kwd&user=$username&admin=$admin'><font face='Verdana' size='2'>NEXT</font></a>";}
echo "</td></tr></table>";

	      }
	     else
	      {
		 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert("No messages in the database for the chosen criteria");
			window.location = "preports.php?userid=<?php echo $uid;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>&stdate=<?php echo $stdate;?>&endate=<?php echo $endate;?>";									
		</script>
		   <?php
	      }
	 }
	 else
	{
	 echo"
	 <table  valign='middle' align='center'border='0'>
	 <tr><td valign='middle' align='center'>
	 <form action='preports.php' method='post'>
	 <table valign='middle' >
	 <tr><td valign='middle' align='center' colspan='2'><h2>Premium Reports Per Keywords company </h2></td></tr>
	 <tr><td valign='middle' align='center' colspan='2'>&nbsp;</td></tr>
	 <tr><td width='60%'valign='top' align='left'>Select a Service</td>
	 <td><select  name='keyword' id='keyword'>
		<option value=''>Select a Service</option>
		";
		//include "mtn_connect.php";
		include "connect.php";
		 $query="select keyword from premium_services where company='$company'";
		 $result=mysql_query($query) or die('error selecting service ');
		 while(list($key)=mysql_fetch_row($result))
		 {$key=ucfirst(strtolower($key));
		   echo"<option value='$key'>$key</option>";
		 }
		?>	
	</select>
	 </td>
	 </tr>
	 <tr>
	     <td valign="top" align="left">Start Date</td>
	     <td valign="top" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("startdate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2009, 2055);
		$myCalendar->dateAllow('2009-12-15', '2025-03-01');
		//$myCalendar->setYearInterval($datey, 2025);
		//$myCalendar->dateAllow($date1, '2020-03-01');
		$myCalendar->setDateFormat('Y'.'-'.'m'.'-'.'d');
		$myCalendar->writeScript();
		$tripdt=$myCalendar->getDate();
	    ?>
	    </td>
	</tr>
	 <tr>
	     <td valign="top" align="left">End Date</td>
	     <td valign="top" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("enddate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
		$myCalendar->setYearInterval(2009, 2055);
		$myCalendar->dateAllow('2009-12-15', '2025-03-01');
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
	 <td width='58%'valign='top' align='right'>
	 <input type='hidden' name='username' value='$username'>
	  <input type='hidden' name='userid' value='$uid'>
	  <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 
	 </td>
	 <td align='left'>
	 <input type='submit' name='submit' value='Submit'>
	  <input type='hidden' name='username' value='$username'>
	  <input type='hidden' name='userid' value='$uid'>
	  <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='submit' name='exit' value='Exit'>
	 </td>
	 </tr>
	 </table>
	 
	 </td>
	 </tr>
	  </td></tr>
	 </table>
	 </form>
	 ";
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
      </table>
    </tr>
  </table>
</div>
</body>
</html>
