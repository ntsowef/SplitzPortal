
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
	//$username = strtolower($_REQUEST['user']);
	//$company = strtolower($_REQUEST['compan']);
	//$admin= $_REQUEST['admin'];
	if(@$_POST['exit'])
		{
		$id = $_REQUEST['userid'];
		$username = strtolower($_REQUEST['user']);
		$company = strtolower($_REQUEST['compan']);
		$admin= $_REQUEST['admin'];
		?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "poptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";	
			</script>
		<?php
		}
	
	if(@$_POST['submit'])	
	{
	// $id = $_REQUEST['userid'];
	// $username = strtolower($_REQUEST['user']);
	// $company = strtolower($_REQUEST['compan']);
	 $keyword = strtolower($_POST['keyword']);
	// $admin= $_REQUEST['admin'];
	 if(!empty($keyword))
	 {$status=1;
	 $keyw=ucfirst($keyword);
	 include "connect.php";
	 $query="select shortcode,cost_inclusive from shortcodes where shortcode not in(select shortcode from premium_services where keyword='$keyword' and status='$status') and shortcodetype='premium' order by cost_inclusive";
	 $result=mysql_query($query) or die('error ');
	 echo"
	 <table width='500' valign='middle' align='center'>
	 <tr>
	 <td valign='middle' align='center'>
	  
	  <form action='pcheck.php' method='post'>
	  <table valign='middle' >
	   <tr>
	      <td valign='middle' align='center' colspan='2'>&nbsp;</td>
	   </tr>
	   <tr>
	      <td valign='top' align='left'><b>Check Keyword Availability</b></td>
	      <td><input type='text' name='keyword' size='26'></td>
	 </tr>
	 <tr>
	   <td width='50%'valign='top' align='right'>
	       <input type='hidden' name='userid' value='$id'>
	       <input type='hidden' name='user' value='$username'>
	       <input type='hidden' name='compan' value='$company'>
	       <input type='hidden' name='admin' value='$admin'>
	   </td>
	   <td align='right'>
	   <input type='submit' name='submit' value='Submit' />
	   </td>
	 </tr>
	 </table>
         </form>
	
	 <table width='540' valign='middle' align='center'>
	 <tr>
	    <td colspan='4' align='center'><b>List of Available Short Codes: $keyw</b></td>
	 </tr>
	 <tr bgcolor='grey'>
	    <td>Keyword</td>
	    <td>Shortcode</td>
	    <td>Price</td>
	    <td align='center'>Example</td>
	 </tr>
	"; 
	while (list($shortcode,$price)=mysql_fetch_row($result))
	 {$example="SMS ".$keyword." to ".$shortcode." to win a price";
	 $price="R".$price;
	  echo"
	 <tr>
	 <td>$keyword</td>
	 <td>$shortcode</td>
	 <td>$price</td>
	 <td>$example</td>
	 </tr>
	 ";
	 }
	 echo"
	 </table>
	 
	 <table width='540'>
	 <tr>
	 <form action='pcheck.php' method='post'>
	 <td colspan='4' align='right'>
	 <input type='hidden' name='userid' value='$id'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='submit' name='exit' value='Exit' />
	 </td>
         </form>
	  </tr>
	 </table>
	 
          </td>
          </tr>
	</table>
	 ";
	 }
	 else
	 {
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please input valid Keyword');
			window.location = "pcheck.php";									
		</script>
	 <?php
	 }
	}
	else
	{
	?>
	<table valign="middle" align="center"border="0">
	<tr><td valign="middle" align="center">
	<form action="pcheck.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2">&nbsp;</td></tr>
	<tr>
	<td colspan="2"valign="middle" align="center">Enter Your Keyword</td>
	</tr>
	<tr>
	<td colspan="2"align="center"><input type="text" name="keyword" size="26">
	<input type="hidden" name="userid" value="<?php echo $id;?>">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
	</td>
	</tr>
	</table>
	<table width="250" valign="middle">
	<tr>
	<td valign="top" align="right"width="68%">
	<input type="submit" name="submit" value="Submit" />
	</td>
	<td  align="left">
	<input type="hidden" name="userid" value="<?php echo $id;?>">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
	<input type="submit" name="exit" value="Exit" />
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
