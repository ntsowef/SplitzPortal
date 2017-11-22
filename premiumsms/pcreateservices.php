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
	include "connect.php";
	//$id = $_REQUEST['userid'];
	//$username = strtolower($_REQUEST['user']);
	//$company = strtolower($_REQUEST['compan']);
	//$admin= $_REQUEST['admin'];
	if(@$_POST['exit'])
		{
		if(empty($id)){$id = $_REQUEST['id'];}
		$username = strtolower($_REQUEST['user']);
		$company = strtolower($_REQUEST['compan']);
		$admin= $_REQUEST['admin'];
		?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "poptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>&userid=<?php echo $id;?>";	
			</script>
		<?php
		}
		
		//echo $username;
	if(@$_POST['submit'])	
	{
	// $id = $_REQUEST['id'];
	// if(empty($id)){
       //  $id = $_REQUEST['userid'];}
	// $admin= $_REQUEST['admin'];
	// $username = strtolower($_POST['user']);
	// $company = strtolower($_POST['compan']);
	 $keyword = strtolower($_POST['keyword']);
	 $terms = strtolower($_POST['terms']);
	 //echo"Terms ".$terms ;
	 $acctype='premium';
	 $query = "SELECT accounttype_p from accounts where username = '$username' and company = '$company' and accounttype_p='$acctype'";
    // echo $query. "<br>";	 
	 $result = mysql_query($query) or die("Couldn't select information from accounts ");
	 if(mysql_num_rows($result) == 0)
	  {
		?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Your company does not have a <?php echo $option;?> account with us. If you need it contact our sales team.');
			window.location = "poptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>&userid=<?php echo $id;?>";									
		</script>
		<?php
	  }

	 if(empty($terms))
	 {
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please tick Terms and Conditions');
			window.location = "pcreateservices.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>&admin=<?php echo $admin;?>&userid=<?php echo $id;?>";									
		</script>
	 <?php
	 }
	 if(!empty($keyword))
	 {$status=1;
	    $keyw=ucfirst($keyword);
	 //include "mtn_connect.php";
	
	 $query="select shortcode,cost_inclusive from shortcodes where shortcode not in(select shortcode from premium_services where keyword='$keyword' and status='$status') and shortcodetype='premium'order by cost_inclusive";
	 $result=mysql_query($query) or die('error ');
	 echo"
	 <table width='400' valign='middle' align='center'>
	 <tr>
	 <td colspan='4' align='center'>List of Available Short Codes: $keyw</td>
	 </tr>
	 <tr bgcolor='grey'>
	 <td width='25%'>Keyword</td>
	 <td width='25%'>Shortcode</td>
	 <td width='25%'>Price</td>
	 <td align='left'width='25%'>Create Service</td>
	 </tr>
	"; 
	while (list($shortcode,$price)=mysql_fetch_row($result))
	 {$example="SMS ".$keyword." to ".$shortcode." to win a price";
		// $price="R".$price/100;
		if($shortcode==32123)
		 {
		      if($username=='enitiate')
		         {
			 //$price="R".$price;
			  echo"
			 <tr>
			 <td>$keyword</td>
			 <td>$shortcode</td>
			 <td>$price</td>
			 <td><a href='pcreateservices1.php?keyword=$keyword&shortcode=$shortcode&user=$username&price=$price&compan=$company&id=$id'>Create Service</a></td>
			 </tr>
			 ";
			 }
		  }
		else
		  {
			//$price="R".$price;
			  echo"
			 <tr>
			 <td>$keyword</td>
			 <td>$shortcode</td>
			 <td>$price</td>
			 <td><a href='pcreateservices1.php?keyword=$keyword&shortcode=$shortcode&user=$username&price=$price&compan=$company&id=$id'>Create Service</a></td>
			 </tr>
			 ";		  
		  }
			 
	 }
	 echo"
	 </table>
	 <table width='500'>
	 <tr><form action='poptions.php' method='post'>
	 <td colspan='4' align='right'>
	 <input type='hidden' name='userid' value='$id'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='hidden' name='admin' value='$admin'>
	 <input type='submit' value='Exit'>
	  </td>
	  </form>
	  </tr>
	 </table>
	 ";
	 }
	 else
	 {
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please input valid Keyword');
			window.location = "pcreateservices.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>&admin=<?php echo $admin;?>";									
		</script>
	 <?php
	 }
	}
	else
	{
	?>
	<table width="400" valign="middle" align="center">
	<tr><td valign="middle" align="center">
	<form action="pcreateservices.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2"><b><u>Create a Premium SMS Service</u></b><br>&nbsp;</td></tr>
	<tr>
	<td></td><td><input type="checkbox" name="terms" value="1">Agreed to Terms & Conditions</td>
	</tr>
	<tr><td width="20%"valign="top" align="left"></td>
	<td>Type Keyword: <input type="text" name="keyword" size="26">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<input type="hidden" name="admin" value="<?php echo $admin;?>">
	</td>
	</tr>
	</table>
	<table width="400" valign="middle">
	<tr>
	<td width="78%"valign="top" align="right">
	<input type="submit" name="submit" value="Submit" />
	</td>
	<td align="left">
	<input type="hidden" name="id" value="<?php echo $id;?>">
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
