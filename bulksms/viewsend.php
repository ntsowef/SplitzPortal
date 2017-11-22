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
	      ?>
	      <table cellspacing="0" rules="none" align="center" border="10">
		    <form action="viewsend1.php" method="POST">
		    <tr>
		     <td valign="top" colspan="3" align="center">Select Report Options</td>
		     </tr>
		     <tr>
		     <td valign="top" colspan="3" align="center">&nbsp;&nbsp;</td>
		     </tr>
		     <tr>
		     <td valign="top" width="50%">From:&nbsp;&nbsp;(YYYY-MM-DD)</td><td colspan="2"><input type="text" size="20" name="dfrom"></td>
		     </tr>
		     <tr>
		     <td valign="top" width="50%">To: &nbsp;&nbsp;&nbsp;&nbsp;(YYYY-MM-DD)</td><td colspan="2"><input type="text" size="20" name="dto"></td>
		     </tr>
		     
		       <tr>
		           <td></td>
			 <td align="right" valign="top" width="20%"> 
			 <input type="submit" name="submit" value="Submit" />
			 </td>  
			 <td align="left"valign="top" >
				 <input type="hidden" name="id" value="<? echo $id;?>">
				<input type="hidden" name="user" value="<? echo $username;?>">
				<input type="hidden" name="compan" value="<? echo $company;?>">
				<input type="hidden" name="admin" value="<? echo $admin;?>">
			    </td>
		     </tr>
		      </table>
		
		
		
	  </td>
                  </tr>
                </table>
	
</body>
</html>
