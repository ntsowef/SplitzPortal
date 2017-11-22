<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>

		
	<?php
                $id=$_REQUEST['userid'];
		$username = $_REQUEST['user'];
		$company = $_REQUEST['compan'];
		$admin= $_REQUEST['admin'];
	       if(@$_POST['submit'])
                  {$id=$_POST['id'];
		    $username = $_POST['user'];
		    $company = $_POST['compan'];
		    $admin= $_POST['admin'];
		    $option= $_POST['option'];
	
		  if($option=='sendmsg')
                    { 
                     $id=$_POST['id'];
		     //echo"testing2";
	            ?>
                         <script language = "javascript" style = "text/javascript"> 
                         window.location = "bulkmsgs.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                        // window.location = "test_m.php";									
                    </script>
                         <?php
                    }
		    elseif($option=='createuser')
                    {$id=$_POST['id'];
		      //echo"testing3";
                       if($admin=='Y')
			  {
			  ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "createuser.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			  <?php
			   }
			   else
			   {
			    ?>
			      <script language = "javascript" style = "text/javascript"> 
			          alert('You have no administrative rights to create another user');
				  window.location = "moptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			      <?php
			   }
                     }
		     elseif($option=='viewsend')
                    {$id=$_POST['id'];
		   // echo"testing4";
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
                          window.location = "viewsend.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
		   }
		   elseif(@$_POST['exit'])
                   {	$id=$_REQUEST['id'];
			$username = $_REQUEST['user'];
			$company = $_REQUEST['compan'];
			$admin= $_REQUEST['admin'];
                    ?>
                        <table border ="5"align="center">
                         <tr><td valign="top">
                        <form action="moptions.php" method="POST">
                        <table cellspacing="0" rules="none" align="center" bgcolor="white" width="300">
                         <tr>
                         <td valign="top" align="center" colspan="3"bgcolor="#D2D2D3" ><b>Choose an Option</b></td>
                         </tr>
                          <tr>
                         <td align="left" width="35%"></td> <td align="left"colspan="2">
                         <input type="radio" name="option" value="createuser">Create User<br>
	               <input type="radio" name="option" value="sendmsg">Send Messages<br>
                         <input type="radio" name="option" value="viewsend">View Send Messages<br>
                         </td>
                         </tr>
                         <tr>
                         <td align="center" width="35%"></td><td colspan="2">
                         <input type="hidden" name="id" value="<?php echo $id;?>">
                         <input type="hidden" name="user" value="<?php echo $username;?>">
                         <input type="hidden" name="compan" value="<?php echo $company;?>">
                         <input type="hidden" name="admin" value="<?php echo $admin;?>">
                          </td>
                         </tr>
                         <tr><td></td>
			 <td align="right" valign="top" width="80%">
			 <input type="submit" name="submit" value="Select" />
			  </td>  
			<td align="left"valign="top">
				 <input type="hidden" name="id" value="<?php echo $id;?>">
				 <input type="hidden" name="user" value="<?php echo $username;?>">
				 <input type="hidden" name="compan" value="<?php echo $company;?>">
				 <input type="hidden" name="admin" value="<?php echo $admin;?>">
				<a href="index.php?id=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exit.png" width="55" height="22"border="0"></a>
			    </td>
		     </tr> 
			 
                         </table>
                                        </td>
                         </tr> </table>
                         <?php
                    }else
                    {
		   
		 ?>
		 <table border ="5"align="center">
                    <tr><td valign="top">
                    <form action="moptions.php" method="POST">
                        <table cellspacing="0" rules="none" align="center" bgcolor="white" width="300">
                         <tr>
                         <td valign="top" align="center" colspan="3"bgcolor="#D2D2D3" ><b>Choose an Option</b></td>
                         </tr>
                          <tr>
                         <td align="left" width="35%"></td><td align="left"colspan="2">
		     <input type="radio" name="option" value="createuser">Create User<br>
	               <input type="radio" name="option" value="sendmsg">Send Messages<br>
                         <input type="radio" name="option" value="viewsend">View Send Messages<br>
                         </td>
                         </tr>
			<tr>
                         <td align="center" width="35%"></td><td colspan="2">
                         <input type="hidden" name="id" value="<?php echo $id;?>">
		      <input type="hidden" name="user" value="<?php echo $username;?>">
                         <input type="hidden" name="compan" value="<?php echo $company;?>">
                         <input type="hidden" name="admin" value="<?php echo $admin;?>">
                          </td>
                         </tr>
                         <tr>
			 <td></td>
			 <td align="right" valign="top" width="80%"><input type="submit" name="submit" value="Select" />
			  </td>  
			<td align="left" valign="top" >
				
				 <input type="hidden" name="id" value="<?php echo $id;?>">
				 <input type="hidden" name="user" value="<?php echo $username;?>">
				 <input type="hidden" name="compan" value="<?php echo $company;?>">
				 <input type="hidden" name="admin" value="<?php echo $admin;?>">
				<a href="http://www.computekmobile.co.za/myservices/options.php?username=<?php echo $username;?>&company=<?php echo $company;?>&admin=<?php echo $admin;?>"><img src="images/exiting_03.gif" width="60" height="23"border="0"></a>
			</td>
		     </tr> 
                         </table>
                     
                          </td>
                         </tr> </table>                        
                        <?php
                    }
		?>
		
	  
		
	  </td>
                  </tr>
                </table>
		
	



</body>
</html>
