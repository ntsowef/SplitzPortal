<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$base_url = 'http://'.$host.$uri.'/';
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Splitz Marketing: Bulk SMS</title>
<link href="newyear.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
	include "connect.php";
	$username = trim($_REQUEST['user']);
	if(empty($username))
	{
	$username = trim($_REQUEST['username']);
	}
	$admin = $_REQUEST['admin'];
	$id = $_REQUEST['id'];
	$dt=date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	if(@$_POST['submit'])
		{
		 $invoiceno = $_POST['invoiceno'];
		 $invoiceamt = trim($_POST['invoiceamt']);
		 $invoicenet = trim($_POST['invoicenet']);
		 $invoicedate = $_POST['invoicedate'];
		 $company = $_POST['company'];
		 $username = $_POST['user'];
	         $zonec= $_POST['zone'];
		 $acc_type='bulk';
		 $status='Ok';
		 $st=1;
		 if(empty($invoiceno) || empty($invoiceamt)|| empty($invoicedate)|| empty($company))
		 {
		  $msg=$msg."All fields must be completed : InvoiceNo, InvoiceAmt, InvoiceNet, InvoiceDate, Credits, Company <br>";
		  $status="False";
		 }
		
					 
		 if($status=='Ok')
		  { 	$cr=explode(" ",$zonec);
			 $i=0;
			 foreach ($cr as $value)
			 {
			  if($i==0){$zone=trim(strtoupper($value));}
			  if($i==1){$zoneprice=trim($value);}
			  if($i==2){$other1=trim($value);}
			  $i++;
			 }
			// echo" <br> Zone ". $zone." Zone Price " .$zoneprice;
			 $credits=round($invoiceamt/($zoneprice));
			 $qry="select id from bulk_credits where company ='$company' and status='$st'";
                      //   echo $qry ."<br>";
			 $resq=mysql_query($qry) or die('unable to select bulk credits ');
			 if(mysql_num_rows($resq)>0)
			   {
			   list($creditid)=mysql_fetch_row($resq);
			   $sql1="select credits from bulk_credits where id='$creditid' and company='$company'";
                         //  echo "  ".$sql1."  <br>";
			   $res1=mysql_query($sql1);
			   list($credts)=mysql_fetch_row($res1);
                           $credits=$credits+$credts;
			   //$upd="update bulk_credits set status='0' where id ='$creditid'";
                          // echo "  Up ".$upd."  <br>";
                           $del = "delete from bulk_credits where id='$creditid'";
			   $resu=mysql_query($del) or die('unable to update bulk credits ');
                           
                           
                          // echo "  old Credits ".$credts." ".$credits;
			  // $credits=$credits+$credts;
                           
			 //  echo" <br> c1 ". $credits."  Amount ".$invoiceamt."  Zone price".$zoneprice;
			   $stat=1;
			   $insert="INSERT into bulk_credits values('','$invoiceno','$invoiceamt','$invoicenet','$invoicedate','$credits','$company','$username','$stat','$dt')";
			   // echo" <br>query ". $insert;
			   $result=mysql_query($insert) or die("Could not insert bulk credits ");
			   }
			   else
			   {
			    $credits=round($invoiceamt/($zoneprice));
			    echo" <br> c2 ". $credits.$invoiceamt."  ".$zoneprice;
			    $stat=1;
			    $insert="INSERT into bulk_credits values('','$invoiceno','$invoiceamt','$invoicenet','$invoicedate','$credits','$company','$username','$stat','$dt')";
			    
                            echo" <br>query ". $insert;
                            $result=mysql_query($insert) or die("Could not insert bulk credits ");
			   }

			  ?>
			     <script language = "javascript" style = "text/javascript"> 
				window.location = "index.php";									
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
                    <table cellspacing="0" rules="none" align="center" bgcolor="white" width="380"border="5">
                       <tr>
                        <td valign="top" align="center" colspan="3"bgcolor="gray"><b><font size="3">Credit Update Form</b></td>
                       </tr>
                       <tr>                   
                       <td valign="top" width="70%" align="left">Invoice No</td><td align="left" colspan="2"><input type="text"  name="invoiceno" size="30"></td>
                       </tr>
		   <tr>
                       <td valign="top" width="49%"align="left">Invoice Amount</td><td align="left" colspan="2"><input type="text"  name="invoiceamt" size="30"></td>
                       </tr>
		   <tr>
                       <td valign="top" width="49%"align="left">Invoice Date</td><td align="left" colspan="2"><input type="text"  name="invoicedate" size="30"></td>
                       </tr>   
		   <tr>
                       <td valign="top"align="left">Company</td>
                          <td colspan="2">
		       <select name="company" id="company">
		       <option id="">Select Company</option>
		       <?php
		       $query="select distinct company_name from company order by company_name";
		       $result=mysql_query($query) or die('unable to connect ');
		       while(list($company_name)=mysql_fetch_row($result))
		       {
		        echo"<option id='$company_name'>$company_name</option>";
		       }
		      ?>
		       </select>
		       </td>
                       </tr>
		    <tr>
                       <td valign="top"align="left">Message Zone</td><td align="left" colspan="2">
		       <select name="zone">
		       <option id="">Select Zone</option>
		       <?php
		       $query1="select price_level, price from messageprices";
		       $result1=mysql_query($query1) or die('unable to connect ');
		       while(list($zone,$price)=mysql_fetch_row($result1))
		       {$zonep=$zone."   ".$price;
		        $zon=$zone." ".$price;
		         echo"<option id='$zon'>$zonep </option>";
		       }
		      ?>
		       </select>
		</td>
                       </tr>
		   <tr>
                         <td align="center" width="25%"></td><td colspan="2">
		         <input type="hidden" name="user" value="admin">
		         <input type="hidden" name="id" value="3">
		         <input type="hidden" name="admin" value="Y">
                         </td>
                         </tr>
                         <tr><td></td>
			 <td align="right" valign="top" width="70%"><input type="submit" name="submit" value="Save" /> </td>  
			<td align="left">
                           
                    <script>
                    function goBack()
                      {
                      window.history.back()
                      }
                    </script>
                    <input type="button" value="Go Back" onclick="goBack()"/>
				</td>
		     </tr>
                     </table>
                    
	<?php
        
                           }?>
		
		
	  </td>
                  </tr>
                </table>
</body>
</html>
