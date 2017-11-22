<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$keyword=$_REQUEST['keyword'];
$shortcode=$_REQUEST['shortcode'];
$price=$_REQUEST['price'];
?>
<html>
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
        <?php
       require_once('calendar/classes/tc_calendar.php');
	/*$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	$admin= $_REQUEST['admin'];
	$keyword=$_REQUEST['keyword'];
	$shortcode=$_REQUEST['shortcode'];
	$price=$_REQUEST['price'];
	*/

	if(@$_POST['submit'])	
	{$username = strtolower($_REQUEST['user']);
	 $company = $_REQUEST['company'];
	 
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
	 
	 if($status=='OK')
	 {	$stat=1;
		$dt=date('Y'.'-'.'m'.'-'.'d');
	
		include "connect.php";
               // echo " I am guilty of this keyword ".$keyword;
		$sql = "SELECT celnumber FROM premium_transactions WHERE company = '$company' AND keyword = '$keyword' AND (message_date >= '$startdate' AND message_date <= '$enddate')";
		 // echo $sql;
		 $resc=mysql_query($sql) or die('Unable to select from premium_transactions');
	    
               $num_records = mysql_num_rows($resc);  
               if($num_records > 0)
		{
		 
		     
		echo "<h2> This campaign has generated ".$num_records." entries from ".$startdate." to ".$enddate."</h2>";
		}
		 $sql = "SELECT celnumber, COUNT(celnumber) AS entries, keyword FROM premium_transactions WHERE company = '$company' AND keyword = '$keyword' AND (message_date >= '$startdate' AND message_date <= '$enddate') GROUP BY celnumber LIMIT 100"; 
		 //$sql2 = "select sender, count(sender) as entries, keyword from smsmo where keyword='$keyword' and (created >= '$startdate' and created <= '$enddate') GROUP BY sender ASC LIMIT 20";
                // echo $sql ."<br>";         
                 echo "<table border='1' style='width:300px'>  <tr> <th> CELL NUMBER</th> <th> Keyword </th> </tr>";		
		 $resc2=mysql_query($sql) or die('Unable to select from premium_transactions');
		  if(mysql_num_rows($resc2) > 0)
		  {  $ii =0;
		   while(list($sender,$entries, $keyword)=mysql_fetch_row($resc2)){
		       $receiver_array[$ii]=$sender;
			  
			    echo "<tr> <td>".$sender."</td> <td>".$keyword."</td></tr>";
               
			   $ii++;
		   }
                   
		 }
		echo "</table>";
		echo "<br>";
                $a = mt_rand(0,$ii);
                 //  echo " Random number".$a;
                $b = mt_rand(0,$ii);
                //$sqlInsert = "insert into competition_weekly_winners (id,msisdn, date_created) VALUES ('','".$receiver_array[$a]."',now())";
                
                //echo $sqlInsert;
               // $res1 = mysql_query($sqlInsert) or die("Couldn't competition_weekly_winner ");
                
	//	echo "<h3>The winner which was picked from the above list was".$receiver_array[$a]." </h3>" ;
		
		
		//fclose()
		?>
		
		
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
                <form action="radiodraw.php" method="post">
	<table valign="middle" >
	
	<tr>
	     <td valign="top" align="LEFT">Start Date</td>
	     <td valign="top"align="LEFT" >
	     <?php
		$date1=date('Y'.'-'.'m'.'-'.'d');
		$datey=date('Y');
		$myCalendar = new tc_calendar("startdate", true, false);
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		$myCalendar->setPath("calendar/");
	
		$myCalendar->setYearInterval($datey, 2025);
		//$myCalendar->dateAllow($date1, '2020-03-01');
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
		
		$myCalendar->setYearInterval($datey, 2025);
		$myCalendar->dateAllow($date1, '2020-03-01');
		$myCalendar->setDateFormat('Y'.'-'.'m'.'-'.'d');
		$myCalendar->writeScript();
		$tripdt=$myCalendar->getDate();
	    ?>
	     </td>
	 </tr>
	
	
	</table>
	<table width="540" valign="middle">
	<tr>
	<td valign="top" align="right"width="75%">
	
	</td>
	<td valign="top"align="left">
	<input type="hidden" name="keyword" value="<?php echo $keyword;?>">
        <input type="hidden" name="company" value="<?php echo $company;?>">
        <input type="submit" name="submit" value="Submit" />
	<input type="submit" name="exit" value="Exit" />
	
	</form>
	</td>
	</tr>
	</table>
	</tr>
	</td></tr>
	</table>
	<?php
            mysql_close();
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
    </body>
</html>
