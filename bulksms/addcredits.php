<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Computek Mobile::.</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>

		
	<?php
		//include "mtn_connect.php";
		include "connect.php";
		$username = $_REQUEST['username'];
		if(@$_POST['submit'])
		{
		 $invoiceno = $_POST['invoiceno'];
		 $invoiceamt = $_POST['invoiceamt'];
		 $invoicenet = $_POST['invoicenet'];
		 $invoicedate = $_POST['invoicedate'];
		 $company = $_POST['company'];
	         $credits= $_POST['credits'];
		 $acc_type='bulk';
		 $status='Ok';		
		if(empty($invoiceno) || empty($invoiceamt)|| empty($invoicenet)|| empty($invoicedate)|| empty($credits)|| empty($company))
		 {
		  $msg=$msg."All fields must be completed : InvoiceNo, InvoiceAmt, InvoiceNet, InvoiceDate,Credits, Company <br>";
		  $status="False";
		 }
				 
		 if($status=='Ok')
		  {
		   $insert="INSERT into bulk_credits values('invoiceno','$invoiceamt','$invoicenet','$invoicedate','$credits','$company','$username',now())";
		   $result=mssql_query($insert) or die("Could not insert bulk credits ");
		  ?>
		     <script language = "javascript" style = "text/javascript"> 
			 window.location = "addcredits.php?username=<?php echo $username;?>";									
		    </script>
		   <?php
		  }
		  else
		  {
		   {echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button'  value='Retry' onClick='history.go(-1)'>"; }
		  }
		}
		else
		{
		?>
		<form action="addcredits.php" method="POST" name="categ">
                    <table cellspacing="0" rules="none" align="center" bgcolor="white" width="400">
                       <tr>
                        <td valign="top" align="center" colspan="3"bgcolor="gray"><b><font size="3">Credit Update Form</b></td>
                       </tr>
                       <tr>                   
                       <td valign="top" width="49%" align="left">Invoice No</td><td align="left" colspan="2"><input type="text"  name="invoiceno" size="30"></td>
                       </tr>
		   <tr>
                       <td valign="top" width="49%"align="left">Invoice Gross Amount</td><td align="left" colspan="2"><input type="text"  name="invoiceamt" size="30"></td>
                       </tr>
		     <tr>                   
                       <td valign="top" width="49%" align="left">Invoice Net</td><td align="left" colspan="2"><input type="text"  name="invoicenet" size="30"></td>
                       </tr>
		   <tr>
                       <td valign="top" width="49%"align="left">Invoice Date(YYYY-MM-DD)</td><td align="left" colspan="2"><input type="text"  name="invoicedate" size="30"></td>
                       </tr>   
		   <tr>
                       <td valign="top"align="left">Credits</td><td align="left" colspan="2"><input type="text" name="credits" size="30"></td>
                       </tr>
                       <tr>
                       <td valign="top"align="left">Company</td>
                          <td colspan="2">
		       <select name="company" id="company">
		       <option id="">Select Company</option>
		       <?php
		       $query="select company from accounts order by company";
		       $result=mssql_query($query) or die('unable to connect ');
		       while(list($company)=mysql_fetch_row($result))
		       {
		        echo"<option id='$company'>$company</option>";
		       }
		      ?>
		       </select>
		       </td>
                       </tr>
		        <tr>
                         <td align="center" width="25%"></td><td colspan="2">
		         <input type="hidden" name="username" value="<? echo $username;?>">
                         </td>
                         </tr>
                         <tr><td></td>
			   <td align="right" valign="top" width=""><input type="submit" name="submit" value="Save" /> </td>  
			   <td align="right">
				
				
			</td>
		     </tr>
                     </table>
                </form> 
	<?php }?>
	
	
		
	  </td>
                  </tr>
                </table>
			
</body>
</html>
