<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:: Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>

		
	<?php
		// include"mtn_connect.php";
		 include"connect.php";
		 $id=$_REQUEST['userid'];
		 $username = $_REQUEST['user'];
		 $company = $_REQUEST['compan'];
		 $admin= $_REQUEST['admin'];
		 if(@$_POST['submit'])
		 {
		 $status1=1;
		 $status="Ok";
		 $msg="";
		 $id=$_POST['id'];
		 $username = $_POST['user'];
		 $company = $_POST['compan'];
	         $admin= $_POST['admin'];
		 $acc_type='bulk';
		 $firstname= $_POST['firstname'];
		 $lastname= $_POST['lastname'];
		 $usernam= trim($_POST['username']);
		 $password= trim($_POST['password']);
		 $admini= $_POST['admini'];
		
		if(empty($firstname) || empty($lastname))
		 {
		  $msg=$msg."Fields must be completed : Firstname, Lastname<br>";
		  $status="False";
		 }
		 if(empty($admini))
		 {
		  $msg=$msg."Admin must be completed <br>";
		  $status="False";
		 }
		 if(empty($username) || empty($password))
		 {
		  $msg=$msg."Fields must be completed : Username,Password<br>";
		  $status="False";
		 }
		 $sql="select username,password from accounts where username='$username' and password='$password'";
		 $res=mssql_query($sql);
		 if(mssql_num_rows($res)>0)
		  {
		    $msg=$msg."Change either your username or password: Already taken<br>";
		    $status="False";
		  }
		 if($status=='Ok')
		  {$date=date('Y'.'-'.'m'.'-'.'d');
		   $insert="INSERT into accounts values('$password','$usernam','$firstname','$lastname','$company','$admini','$status1','$acc_type','$acc_typep','$acc_typeo','$date')";
		   $result=mssql_query($insert) or die("Could not insert in accounts ");
		  ?>
		     <script language = "javascript" style = "text/javascript"> 
			 window.location = "moptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		    </script>
		   <?php
		  }
		  else
		  {
		   {echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>"; }
		  }
		}else{
		?>
		<form action="createuser.php" method="POST" name="categ">
                    <table cellspacing="0" rules="none" align="center" bgcolor="white" width="400">
                       <tr>
                        <td valign="top" align="center" colspan="3"bgcolor="gray"><b><font size="4">Create User Detail</b></td>
                        </tr>
                       <tr>                   
                       <td valign="top" width="69%" align="left">Firstname</td><td align="left"colspan="2"><input type="text"  name="firstname" size="29"></td>
                       </tr><tr>
                       <td valign="top" width="49%"align="left">Lastname</td><td align="left"colspan="2"><input type="text"  name="lastname" size="29"></td>
                       </tr>
		   <tr>
                       <td valign="top"align="left">Username</td>
                       <td align="left"colspan="2"><input type="text" name="username" size="29"></td>
                       </tr>
                       <tr>
                       <td valign="top"align="left">Password</td>
                       <td colspan="2"><input type="text" name="password" size="29"></td>
                       </tr>
		   <tr>
                       <td valign="top"align="left">Administrator</td>
                       <td  align="left"colspan="2"><select name="admini">
		           <option value="">Select</option>
		           <option value="Y">Yes</option>
		           <option value="N">No</option>
		         </select>
		    </td>
                       </tr>
                       <tr>
                         <td align="center" width="25%"></td><td colspan="2" >
		         <input type="hidden" name="id" value="<?php echo $id;?>">
                             <input type="hidden" name="user" value="<?php echo $username;?>">
                             <input type="hidden" name="compan" value="<?php echo $company;?>">
                             <input type="hidden" name="admin" value="<?php echo $admin;?>">
                          </td>
                         </tr>
                         <tr>
			 <td></td>
			 <td align="right" valign="top" width="90%">
			 <input type="submit" name="submit" value="Save" />
			  </td>  
			<td align="left">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				     <input type="hidden" name="user" value="<?php echo $username;?>">
				     <input type="hidden" name="compan" value="<?php echo $company;?>">
				     <input type="hidden" name="admin" value="<?php echo $admin;?>">
				 <a href="moptions.php?id=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exiting_03.gif" width="60" height="23"border="0"></a>
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
