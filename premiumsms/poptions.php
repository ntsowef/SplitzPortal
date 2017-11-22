
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
               $id=$_REQUEST['userid'];
		$username = $_REQUEST['user'];
		$company = $_REQUEST['compan'];
		$admin= $_REQUEST['admin'];
		if(@$_POST['exit'])
		{
			if(empty($id))
			{$id = $_REQUEST['id'];}
			$username = strtolower($_REQUEST['user']);
			$company = strtolower($_REQUEST['compan']);
			?> 
			<script language = "javascript" style = "text/javascript"> 
				//window.location = "/datacom_mobile/options.php?username=<?php echo $username;?>&company=<?php echo $company;?>&admin=<?php echo $admin;?>";	
				window.location = "poptions.php?id=<?php echo $id;?>&username=<?php echo $username;?>&company=<?php echo $company;?>&admin=<?php echo $admin;?>";	
			</script>
			<?php
		}	       
		
		if(@$_POST['submit'])
                  {$id=$_POST['id'];
		    $username = $_POST['user'];
		    $company = $_POST['compan'];
		    $admin= $_POST['admin'];
		    $option= $_POST['option'];
		//echo"<br>username ".$username.' co '.$company;
		  if($option=='pcreatesvc')
                    { 
                   ?>
                         <script language = "javascript" style = "text/javascript"> 
                         window.location = "pcreateservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		     </script>
                         <?php
                    }
		    elseif($option=='pcheck')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "pcheck.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='pservices')
                    {
                          ?>
			      <script language = "javascript" style = "text/javascript"> 
				  window.location = "pservices.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
			     </script>
			   <?php
			 
                     }
		     elseif($option=='preports')
                    {
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
                          window.location = "preports.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
		      else
                    {
                    ?>
                         <script language = "javascript" style = "text/javascript"> 
			 alert('Please select an option');
                          window.location = "poptions.php?userid=<?php echo $id;?>&user=<?php echo $username;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
                     </script>
                          <?php
                     }
		   }
		   else
		   {
                    ?>
                        <table border ="0"align="center">
                         <tr><td valign="top">
                        <form action="poptions.php" method="POST">
                        <table cellspacing="0" rules="none" align="center" bgcolor="" width="300">
                         <tr>
                         <td valign="top" align="center" colspan="3"bgcolor="" ><b>Select an Option</b></td>
                         </tr>
                          <tr>
                         <td align="left" width="30%">
		    </td> <td align="left"colspan="2">
		     <input type="radio" name="option" value="pcreatesvc">Create Service<br>
                         <input type="radio" name="option" value="pservices">My Services<br>
                         <input type="radio" name="option" value="pcheck">Check Service Availability<br>
                         <input type="radio" name="option" value="preports">Reports<br>
                         </td>
                         </tr>
                          <tr><td></td>
			 <td align="right" valign="top" width="20%">
			 <input type="hidden" name="id" value="<?php echo $id;?>"/>
				 <input type="hidden" name="user" value="<?php echo $username;?>"/>
				 <input type="hidden" name="compan" value="<?php echo $company;?>"/>
				 <input type="hidden" name="admin" value="<?php echo $admin;?>"/>
				<input type="submit" name="submit" value="Submit" />
			  </td>  
			<td align="left"valign="top">
				 <input type="hidden" name="id" value="<?php echo $id;?>"/>
				 <input type="hidden" name="user" value="<?php echo $username;?>"/>
				 <input type="hidden" name="compan" value="<?php echo $company;?>"/>
				 <input type="hidden" name="admin" value="<?php echo $admin;?>"/>
				 <input type="submit" name="exit" value="Exit" />
				  </td>
		     </tr> 
			 
                         </table>
                           </td>
			   </form>
                         </tr> 
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
