<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile: Premium SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
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
	 $keyword = strtoupper($_POST['keyword']);
	 if(!empty($keyword))
	 {$status=1;
	 $keyw=ucfirst($keyword);
	 $query="select shortcode,cost_inclusive from shortcodes where shortcode not in(select shortcode from premium_services where keyword='$keyword' and status='$status') and shortcodetype='premium'";
	 $result=mysql_query($query) or die('error ');
	 echo"
	 <table width='500' valign='middle' align='center'>
	 <tr><td valign='middle' align='center'>
	 <form action='scheck.php' method='post'>
	 <table valign='middle' >
	 <tr><td valign='middle' align='center' colspan='2'>&nbsp;</td></tr>
	 <tr><td valign='top' align='left'>Check Keyword Availability</td>
	 <td>
	 <input type='text' name='keyword' size='26'>
	 </td>
	 </tr>
	 <tr>
	 <td width='50%'valign='top' align='right'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 </td>
	 <td align='center'>
	  <input type='submit' name='submit' value='Submit'>
	  </td>
	 </tr>
	 </form>
	</table>

	 <table width='500' valign='middle' align='center'>
	 <tr>
	 <td colspan='4' align='center'>List of Available Short Codes: $keyw</td>
	 </tr>
	 <tr bgcolor='grey'>
	 <td>Keyword</td>
	 <td>Shortcode</td>
	 <td>Price</td>
	 <td align='center'>Example</td>
	 </tr>
	"; 
	while (list($shortcode,$price)=mssql_fetch_row($result))
	 {$example="SMS ".$keyword." to ".$shortcode." to win a price";
	 $price="R".$price/100;
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
	 <table width='500'>
	 <tr>
	 <form action='soptions.php' method='post'>
	 <td colspan='4' align='right'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
	 <input type='submit' value='Exit'>
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
			window.location = "scheck.php?user=<?php echo $username;?>&compan=<?php echo $company;?>";									
		</script>
	 <?php
	 }
	}
	else
	{
	?>
	<table valign="middle" align="center"border="5">
	<tr><td valign="middle" align="center">
	<form action="scheck.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2">&nbsp;</td></tr>
	<tr>
	<td colspan="2"valign="middle" align="center">Enter Your Keyword</td>
	</tr>
	<tr>
	<td colspan="2"align="center"><input type="text" name="keyword" size="26">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	</td>
	</tr>
	</table>
	<table width="250" valign="middle">
	<tr>
	<td valign="top" align="right"width="63%">
	<input type="submit" name="submit" value="Submit">
	</td>
	<td  align="left">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<a href="soptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>"><img src="images/exit.png" width="57" height="25"border="0"></a>
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
                </table>
		
</body>
</html>
