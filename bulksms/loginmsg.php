<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<?php			
		if(@$_POST['submit'])	
	       {
	        $username = strtolower($_POST['username']);
		$password = strtolower($_POST['passwd']);
		$stat='1';
		include "mtn_connect.php";
		$query = "SELECT id,username,password,company,admin,status,accounttype FROM accounts WHERE username = '$username' AND password = '$password' and status='$stat'";			 
		$result = mysql_query($query) or die("Couldn't select infor ".mysql_error());
		$num=mysql_num_rows($result);
		mysql_close();
		if ($num > 0)
		{list($id,$username,$password,$company,$admin,$status,$acc_type)=mysql_fetch_row($result);
		 if(trim($acc_type)=='obs')
		      {?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "client_reports.php?userid=<?php echo $id;?>&user=<? echo $username;?>&compan=<? echo $company;?>&admin=<?echo $admin;?>";									
			</script>
			<?php
		       }
		      
		 if(trim($acc_type)=='bulk')
		      {?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "moptions.php?userid=<?php echo $id;?>&user=<? echo $username;?>&compan=<? echo $company;?>&admin=<?echo $admin;?>";									
			</script>
			<?php
		       }
		}
		else
		{
		      ?>
			<script language = "javascript" style = "text/javascript"> 
				alert('Incorrect Combination, Username: '.<?php echo $username;?>.' Password:'.<?echo $password;?>);
				window.location = "loginmsg.php";									
			</script>
		       <?php
		}
		}
		else
		{        
		?> 
		    <table border ="7"align="center">
			<tr><td valign="middle">
			<table rules="none" align="center"bgcolor="white"width="250"height="90">
			<form action="loginmsg.php" method="post">
			  <tr>
			    <td valign="top">Username:</td><td align="right">	<input type="text" name="username" /></td>
			    
			  </tr>
			  <tr>
			    <td valign="top">Password:</td><td align="right">	<input type="password" name="passwd" /></td>
			  </tr>
			  <tr>
			    <td align="right" valign="top" width="76%"></td>  
			    <td align="right">
				<input type="submit" name="submit" value="Login" />
				<input type="button"value="Exit"/>
			     </td>
			  </tr>
		        </form>
		    </table>
		<?php
	}
	?>    
	  

</body>
</html>
