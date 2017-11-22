<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$shortcode = $_SESSION['shortcode'];

//echo $shortcode;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
body {
	background-color: #75889b;
}
</style>
<link href="backgroundControl.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script language = "javascript" style = "text/javascript"> 

function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}

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
    <body>
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
                    <td class="contentBg">
                         
	<?php
	require_once('calendar/classes/tc_calendar.php');
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	$admin= $_REQUEST['admin'];
	$keyword=$_REQUEST['keyword'];
	//$shortcode=$_REQUEST['shortcode'];
	//$price=$_REQUEST['price'];
	
	if(@$_POST['exit'])
        {
            $username = strtolower($_REQUEST['user']);
             $company = strtolower($_REQUEST['compan']);
             $keyword=$_REQUEST['keyword'];
            // $shortcode=$_REQUEST['shortcode'];
            // $price=$_REQUEST['price'];
            ?> 
                    <script language = "javascript" style = "text/javascript"> 
                            window.location = "poptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>&admin=<?php echo $admin;?>";	
                    </script>
            <?php
        }

	if(@$_POST['submit'])	
	{$username = strtolower($_REQUEST['user']);
	 $company = strtolower($_REQUEST['compan']);
	 $admin= $_REQUEST['admin'];
	 $keyword=$_REQUEST['keyword'];
	// $shortcode=$_REQUEST['shortcode'];
	// $price=$_REQUEST['price'];
	 $startdate = isset($_REQUEST["startdate"]) ? $_REQUEST["startdate"] : "";
	 $enddate = isset($_REQUEST["enddate"]) ? $_REQUEST["enddate"] : "";
	 $message=$_POST['message'];
	 $cmessage=$_POST['cmessage'];
	 $compname=$_POST['cname'];
	 $comp_type='comp_compaign';
	 $terms=1; 
	 $status="OK";
	 
	 if($startdate == 0000-00-00)
	    {
		$msg=$msg."Select start date for competition<br>";
		$status="False";
	    }
	 if($enddate == 0000-00-00)
	   {
		$msg=$msg."Select end date for competition<br>";
		$status="False";
	   }
	  if(empty($message))
	   {$msg="Complete Reply message<br>";
	    $status="False";
	   }
	   if(empty($cmessage))
	   {$msg="Complete Reply message for closed Competition<br>";
	    $status="False";
	   }
	   if(empty($compname))
	   {$msg="Complete field for Competition name<br>";
	    $status="False";
	   }
	 if($status=='OK')
	 {	$stat=1;
		$dt=date('Y'.'-'.'m'.'-'.'d');
		
		include "connect.php";
                
                $query = "select cost_inclusive from shortcodes where shortcode='$shortcode'";
    
             $price = "";
          // echo "  ".$query;
            $result = mysql_query($query);
            $row  = mysql_fetch_array($result);
            if(is_array($row)) {
                $price = $row['cost_inclusive'];        
            }
           // echo "  price ".$price;
                
                $newKey = strtoupper($keyword);
		$sql="insert into premium_services values('','$newKey','$shortcode','$price','$company','$message','$startdate','$enddate','$cmessage','$terms','$stat','$comp_type','$dt','$username')";
		
		echo $sql."<br>";
		$result=mysql_query($sql) or die('Failed to insert premium_services'.mysql_error());
		
		?>
		  <script language="javascript">
		   alert('Premium service for : <?php echo strtoupper($keyword);?> created successifully');
		   window.location="pcreateservices.php?&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";
		 </script>
		<?php    
	 }
	 else
	 {echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>";
	 }
	}
	else
	{
	?>
	<table width="540" valign="middle" align="center">
	<tr><td valign="middle" align="center">
	<form action="pcreate.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2">Create a Competition Service<br>&nbsp;</td></tr>
	<tr>
	<td valign="top" width="50%"align="LEFT">Enter Reply Message<br>(160 characters)</td>
	<td align="LEFT" ><textarea name="message" cols="45" rows="2"onkeypress="return imposeMaxLength(this, 160);"></textarea></td>
	</tr>
	<tr>
	     <td valign="top" align="LEFT">Start Date</td>
	     <td valign="top"align="LEFT" >
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
	     <td valign="top" align="LEFT">End Date</td>
	     <td valign="top" align="LEFT" >
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
	<td>Select Reply for Message after Closing Date(160 characters)</td>
	<td align="LEFT" valign="top"><select name="cmessage">
	<option value="Please note that the competition is closed">Please note that the competition is closed</option>
	<option value="Thank you, the competition deadline has passed">Thank you, the competition/compaign deadline has passed</option>
	</select>
	</td>
	</tr>
	<tr><td valign="top" align="left">Competition Name: </td>
	<td align="LEFT" ><input type="text" name="cname" size="26">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
	</td>
	</tr>
	</table>
	<table width="540" valign="middle">
	<tr>
	<td valign="top" align="right"width="75%">
	
	</td>
	<td valign="top"align="left">
	<input type="submit" name="submit" value="Submit" />
	<input type="submit" name="exit" value="Exit" />
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
	<input type="hidden" name="shortcode" value="<?php echo $shortcode;?>">
	<input type="hidden" name="price" value="<?php echo $price;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
	</form>
	</td>
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
