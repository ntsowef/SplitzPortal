<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
<?php			
		$username = strtolower($_REQUEST['user']);
		$company = strtolower($_REQUEST['compan']);
		$admin = $_REQUEST['admin'];
		if(@$_POST['submit'])	
	       {
	        $username = strtolower($_POST['usernam']);
		$password = strtolower($_POST['passwd']);
		$stat=1;
		$acctype='bulk';
		include "connect.php";
		$query = "SELECT id,company,admin,status,accounttype,accounttype_p,accounttype_o FROM accounts 
				WHERE username = '$username' and password = '$password' and status='$stat' and accounttype='$acctype'";			 
		$result = mssql_query($query);
		$num=mssql_num_rows($result);
		//mysql_close();
		if ($num > 0)
		{
		 list($id,$company,$admin,$status,$acc_type,$accounttype_p,$accounttype_o)=mssql_fetch_row($result);
		 if(trim($acc_type)=='obs')
		      {
		      ?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "client_reports.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			</script>
			<?php
		       }
		      
		 if(trim($acc_type)=='bulk')
		      {//echo"<br> usr 2: ".$username." pwd ".$password;
		      ?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "moptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			</script>
			<?php
		       }
		}
		else
		{//echo"<br> usr 3: ".$username." pwd ".$password;
		      ?>
			<script language = "javascript" style = "text/javascript"> 
				alert('Incorrect Combination, Username');
				window.location = "index.php";									
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
			<form action="index.php" method="post">
			  <tr>
			    <td valign="top">Username:</td><td align="right" colspan="2">	<input type="text" name="usernam" /></td>
			    
			  </tr>
			  <tr>
			    <td valign="top">Password:</td><td align="right"colspan="2">	<input type="password" name="passwd" /></td>
			  </tr>
			  <tr>
			  <td><input type="hidden" name="username" value="<?php echo $username;?>"/>
				<input type="hidden" name="company" value="<?php echo $company;?>"/>
				<input type="hidden" name="admin" value="<?php echo $admin;?>"/>
			  </td>
			    <td align="right" valign="top" width="80%">
				<input type="submit" name="submit" value="Login" />
			    </td>
			     <td align="left" valign="top" >
			     	<a href="http://www.computekmobile.co.za/myservices/options.php?username=<?php echo $username;?>&company=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exiting_03.gif" width="60" height="23"border="0"></a>
			    </td>
			  </tr>
		        </form>		   
		   </table>
		   
		    </td>
			  </tr>
		</table>
	<?php
	}
	?>    
	  
		
	  </td>
                  </tr>
                </table>
	
</body>
</html>
