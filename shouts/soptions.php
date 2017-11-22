<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile: Premium SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
        $id=$_REQUEST['userid'];
	$username = $_REQUEST['user'];
	$company = $_REQUEST['compan'];
	$admin= $_REQUEST['admin'];
	if(@$_POST['submit'])
         {
	    $id=$_POST['id'];
	    $username = $_POST['user'];
	    $company = $_POST['compan'];
	    $admin= $_POST['admin'];
	    $option= $_POST['option'];
	  if($option=='screatesvc')
                    { 
                   ?>
                         <script language = "javascript" style = "text/javascript"> 
                         window.location = "screateservice.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		     </script>
                         <?php
                    }
		    elseif($option=='scheck')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "scheck.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='sservices')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "sservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='sreports')
                    {
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
                          window.location = "sreports.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
		      else
                    {
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
			 alert('Please select an option');
                          window.location = "soptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
	 }
	 else
	 {
         ?>
                        <table border ="5"align="center">
                         <tr><td valign="top">
                        <form action="soptions.php" method="POST">
                        <table cellspacing="0" rules="none" align="center" bgcolor="white" width="300">
                         <tr>
                         <td valign="top" align="center" colspan="3"bgcolor="#D2D2D3" ><b>Shout Services</b></td>
                         </tr>
                          <tr>
                         <td align="left" width="30%">
		    </td> <td align="left"colspan="2">
		     <input type="radio" name="option" value="screatesvc">Create <br>
                         <input type="radio" name="option" value="sservices">Current Services<br>
                         <input type="radio" name="option" value="scheck">Check Keyword Availability<br>
                         <input type="radio" name="option" value="sreports">Reports<br>
                         </td>
                         </tr>
                          <tr><td></td>
			 <td align="right" valign="top" width="20%">
			 <input type="hidden" name="id" value="<?php echo $id;?>"/>
				 <input type="hidden" name="user" value="<?php echo $username;?>"/>
				 <input type="hidden" name="compan" value="<?php echo $company;?>"/>
				 <input type="hidden" name="admin" value="<?php echo $admin;?>"/>
			 <input type="submit" name="submit" value="Select" />
			  </td>  
			<td align="left"valign="top">
				 <input type="hidden" name="id" value="<?php echo $id;?>"/>
				 <input type="hidden" name="user" value="<?php echo $username;?>"/>
				 <input type="hidden" name="compan" value="<?php echo $company;?>"/>
				 <input type="hidden" name="admin" value="<?php echo $admin;?>"/>
				
			    </td>
		     </tr> 
			 
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
