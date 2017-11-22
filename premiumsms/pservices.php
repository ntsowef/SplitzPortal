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
	//$id = $_REQUEST['userid'];
	//if(empty($id)){$id = $_REQUEST['id'];}
	//$username = strtolower($_REQUEST['user']);
	//$company = strtolower($_REQUEST['compan']);
	//$admin= $_REQUEST['admin'];
	if(@$_POST['exit'])
		{
		$username = strtolower($_REQUEST['user']);
		$company = strtolower($_REQUEST['compan']);
		$admin= $_REQUEST['admin'];
		?> 
			<script language = "javascript" style = "text/javascript"> 
			     //   alert('to ex');
				window.location = "poptions.php";	
			</script>
		<?php
		}
	if(@$_POST['exit1'])
		{
		//$id = $_REQUEST['userid'];
		//if(empty($id)){$id = $_REQUEST['userid'];}
	//	$username = strtolower($_REQUEST['user']);
	//	$company = strtolower($_REQUEST['compan']);
	//	$admin= $_REQUEST['admin'];
		?> 
			<script language = "javascript" style = "text/javascript"> 
			       // alert('to ex1');
				window.location = "pservices.php";									
			</script>
		<?php
		}
	if(@$_POST['submit'])	
	{
	 //$id = $_REQUEST['userid'];
	 
	// echo $username. '   '.$message.'   id = '.$id.'<br>';
	// if(empty($id)){
          //   $id = $_REQUEST['id'];
             
         //}
	// $username = strtolower($_REQUEST['user']);
	// $company = strtolower($_REQUEST['compan']);
	//  $admin= $_REQUEST['admin'];
	 $keyword = strtolower($_POST['keyword']);
	 if(!empty($keyword))
	 {$status=1;
	  $keyw=ucfirst($keyword);
	 echo"
	 <table width='500' valign='middle' align='center'>
	 <tr><td valign='middle' align='center'>
	 <form action='pservices.php' method='post'>
	 <table valign='middle' >
	 <tr><td valign='middle' align='left' colspan='2'><b><u>My Services</u></b></td></tr>
	 <tr><td valign='middle' align='center' colspan='2'>&nbsp;</td></tr>
	 <tr><td width='60%'valign='top' align='left'>Please Select a Service from the List</td>
	 <td><select  name='keyword' id='keyword'>
		<option value=''>Please select a Service</option>
		";
		 //include "mtn_connect.php";
		include "connect.php";
		 $query="select keyword from premium_services where company='$company'";
		 
		 echo $query;
		 $result=mysql_query($query) or die('error selecting service ');
		 while(list($key)=mysql_fetch_row($result))
		 {$key=ucfirst(strtolower($key));
		   echo"<option value='$key'>$key</option>";
		 }
			
	echo"
		</select>
	 </td>
	 </tr>
	 </table>
	 <table width='550' valign='middle'>
	 <tr>
	 <td width='68%'valign='top' align='right'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='hidden' name='userid' value='$id'>
	 </td>
	 <td align='left'>
	  <input type='submit' name 'submit' value='Submit'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='hidden' name='userid' value='$id'>
	 <input type='submit' name 'exit1' value='Exit'>
	</td>
	 </tr>
	 </form>
	 </table>
	 </tr>
	 </td></tr>
	 </table>
	 <table width='500' valign='middle' align='center'>
	 <tr>
	 <td colspan='4' align='left'><b>Keyword:</b> $keyword</td>
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
	 //include "mtn_connect.php";
	include "connect.php";
	 $query1="select id,keyword,shortcode,price,startdate,enddate,status from premium_services where company='$company' and keyword='$keyword'";
	 $result1=mysql_query($query1) or die('error selecting service ');
	 while(list($id,$keyword,$shortcode,$price,$startdate,$enddate,$status)=mysql_fetch_row($result1))
	 {if($status==1){$status='Active';}else{$status='InActive';}
	   $keyword=ucfirst(strtolower($keyword));
	   $startdate=substr($startdate,0,10);
	   $enddate=substr($enddate,0,10);
	 echo"
	 <tr>
	 <td width='10%'>$keyword</td>
	 <td width='10%'>$shortcode</td>
	 <td width='10%'>$price</td>
	 <td width='20%'>$startdate</td>
	 <td width='20%'>$enddate</td>
	 <td width='10%'>$status</td>
	 <td width='10%'><a href='pservices1.php?id=$id&user=$username&compan=$company'>Edit</a></td>
	 </tr>
	 ";
	 }
	 echo"
	  </table>
	 ";
	 }
	 else
	 {
	 /*
	 <table width='530'>
	 <tr>
	 <form action='pservices.php' method='post'>
	 <td colspan='4' align='right'>
	 
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='hidden' name='userid' value='$id'>
	 <input type='submit' name 'exit' value='Exit'>
	 </td>
	 </form>
	  </tr>
	 </table>
	 */
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please input valid Keyword');
			window.location = "pservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>&admin=<?php echo $admin;?>";									
		</script>
	 <?php
	 }
	}
	else
	{
	?>
	<table width="500" valign="middle" align="center">
	<tr><td valign="middle" align="center">
	<form action="pservices.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="left" colspan="2"><b><u>My Services</u></b></td></tr>
	<tr><td valign="middle" align="left" colspan="2">&nbsp;</td></tr>
	<tr><td width="60%"valign="top" align="left">Please Select a Service from the List</td>
	<td>
	<select  name="keyword" id="keyword">
	<option value=""> Please select a Service</option>
	<?php
	include "connect.php";
	 $query="select keyword from premium_services where company='$company'";
	 $result=mysql_query($query) or die('error selecting service ');
	 while(list($keyword)=mysql_fetch_row($result))
	 {$keyword=ucfirst(strtolower($keyword));
	   echo"<option value='$keyword'>$keyword</option>";
	 }
	?>
	</select>
	</td>
	</tr>
	</table>
	<table width="500" valign="middle">
	<tr><td valign="top" align="right"width="65%">
	
	</td>
	<td align="left">
	<input type="submit" name="submit" value="Submit">
	<input type="hidden" name="user" value="<?php echo $username?>">
	<input type="hidden" name="compan" value="<?php echo $company?>">
	<input type="hidden" name="user" value="<?php echo $username?>">
	<input type="hidden" name="compan" value="<?php echo $company?>">
	<input type="hidden" name="admin" value="<?php echo $admin?>">
	<input type="hidden" name="userid" value="<?php echo $id?>">
	<input type="submit" name="exit" value="Exit" />
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
