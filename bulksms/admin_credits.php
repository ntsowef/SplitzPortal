<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    		
	<?php			
		if(@$_POST['submit'])	
	       {
	        $username = strtolower($_POST['username']);
		$password = strtolower($_POST['passwd']);
		$stat='Active';
		include "connect.php";
		$query = "SELECT id,username,password FROM admin WHERE username = '$username' AND password = '$password'";			 
		$result = mysql_query($query) or die("Couldn't select infor ADMIN".mysql_error());
		$num=mysql_num_rows($result);
		if ($num > 0)
		{list($id,$username,$password)=mysql_fetch_row($result);
			?> 
			<script language = "javascript" style = "text/javascript"> 
				window.location = "addcredits.php?username=<?php echo $username;?>";									
			</script>
			<?
		}
		else
		{
		  ?>
			<script language = "javascript" style = "text/javascript"> 
				alert('Incorrect Combination, Verify Username and Password');
				window.location = "logincredits.php";									
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
			<form action="logincredits.php" method="post">
			  <tr>
			    <td valign="top">Username:</td><td align="right"colspan="2">	<input type="text" name="username" /></td>
			    
			  </tr>
			  <tr>
			    <td valign="top">Password:</td><td align="right"colspan="2">	<input type="password" name="passwd" /></td>
			  </tr>
			  <tr>
			  <td></td>
			    <td align="right" valign="top" width="80%"></td>  
			    <td align="left" valign="top">
				<input type="submit" name="submit" value="Login" />
				<a href="logincredits.php"><img src="images/exiting_03.gif" width="60" height="23"border="0"></a>
			     </td>
			  </tr>
		        </form>
		    </table>
		<?php
		}
	?>    
	  
		
	  </td>
            </tr>
           </table>
	
	
    </body>
</html>
