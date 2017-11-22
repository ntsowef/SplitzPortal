<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile: Premium SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
	include "remote_connect.php";
	$userid = $_REQUEST['userid'];
	$username = strtolower($_REQUEST['user']);
	$company = strtolower($_REQUEST['compan']);
	if(@$_POST['submit'])	
	{$userid = $_REQUEST['userid'];
	 $username = strtolower($_POST['user']);
	 $company = strtolower($_POST['compan']);
	 $keyword = strtolower($_POST['keyword']);
	 $terms = strtolower($_POST['terms']);
	/*
	 $acctype='premium';
	 $query = "SELECT accounttype_p from accounts where username = '$username' and company = '$company' and accounttype_p='$acctype'";			 
	 $result = mssql_query($query) or die("Couldn't select infor from accounts ");
	 if(mssql_num_rows($result) == 0)
	  {
		?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Your company does not have a <?php echo $option;?> account with us. If you need it contact our sales team.');
			window.location = "soptions.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		</script>
		<?php
	  }
	*/
	 if(empty($terms))
	 {
	 ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Please tick Terms and Conditions');
			window.location = "screateservice.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>"";									
		</script>
	 <?php
	 }
	 if(!empty($keyword))
	 {$status=1;
	 $keyw=ucfirst($keyword);
	 $query="select shortcode,cost_inclusive from compu_shortcodes where shortcode not in(select shortcode from premium_services where keyword='$keyword' and status='$status') and shortcodetype='premium'";
	 $result=mssql_query($query) or die('error ');
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
	while (list($shortcode,$price)=mssql_fetch_row($result))
	 {$example="SMS ".$keyword." to ".$shortcode." to win a price";
	 $price="R".$price/100;
	  echo"
	 <tr>
	 <td>$keyword</td>
	 <td>$shortcode</td>
	 <td>$price</td>
	 <td><a href='screateservice1.php?keyword=$keyword&shortcode=$shortcode&user=$username&price=$price&compan=$company'>Create Service</a></td>
	 </tr>
	 ";
	 }
	 echo"
	 </table>
	 <table width='500'>
	 <tr><form action='soptions.php' method='post'>
	 <td colspan='4' align='right'>
	 <input type='hidden' name='user' value='$username'>
	 <input type='hidden' name='compan' value='$company'>
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
			window.location = "screateservice.php?user=<?php echo $username;?>&compan=<?php echo $company;?>&price=<?php echo $price;?>&shortcode=<?php echo $shortcode;?>&keyword=<?php echo $keyword;?>"";									
		</script>
	 <?php
	 }
	}
	else
	{
	?>
	<table width="400" valign="middle" align="center">
	<tr><td valign="middle" align="center">
	<form action="screateservice.php" method="post">
	<table valign="middle" >
	<tr><td valign="middle" align="center" colspan="2">Create a Shout Service<br>&nbsp;</td></tr>
	<tr>
	<td></td><td><input type="checkbox" name="terms" value="1">Agreed to Terms & Conditions</td>
	</tr>
	<tr><td width="20%"valign="top" align="left"></td>
	<td>Type Keyword: <input type="text" name="keyword" size="26">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	</td>
	</tr>
	</table>
	<table width="400" valign="middle">
	<tr>
	<td width="78%"valign="top" align="right">
	<input type="submit" name="submit" value="Submit">
	</td>
	<td align="left">
	<input type="hidden" name="user" value="<?php echo $username;?>">
	<input type="hidden" name="compan" value="<?php echo $company;?>">
	<a href="soptions.php?id=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exit.png" width="55" height="23"border="0"></a>
				  
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
