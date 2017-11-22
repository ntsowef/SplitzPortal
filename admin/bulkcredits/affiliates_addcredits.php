<?php
session_start();
$username = $_SESSION["username"];
$parent_company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$reseller = $_SESSION['reseller'];
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
	$dt=date('Y-m-d h:m:s');
	if(@$_POST['submit'])
		{
		 $invoiceno = $_POST['invoiceno'];
		 $pcredits = trim($_POST['credits']);
		 $invoicenet = trim($_POST['invoicenet']);
		 $invoiceamt = $_POST['invoiceamt'];
		 $company = $_POST['company'];
		 $username = $_POST['user'];
	         $zonec= $_POST['zone'];
		 $acc_type='bulk';
		 $status='Ok';
		 $st=1;
		 if(empty($invoiceno) || empty($pcredits)|| empty($parent_company))
		 {
		  $msg=$msg."All fields must be completed : InvoiceNo, Credits, Company <br>";
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
			 $credits=$pcredits;
			 $qry="select id from bulk_credits where company ='$parent_company' and status='$st'";
                      //   echo $qry ."<br>";
			 $resq=mysql_query($qry) or die('unable to select bulk credits ');
			 if(mysql_num_rows($resq)>0)
			   {
			   list($creditid)=mysql_fetch_row($resq);
			   $sql1="select credits from bulk_credits where id='$creditid' and company='$parent_company'";
                       
                           // adding previous credits to new credits
			   $res1=mysql_query($sql1);
			   list($credts)=mysql_fetch_row($res1);
                           //$credits=$credits+$credts;
			  // $del = "delete from bulk_credits where id='$creditid'";
			  // $resu=mysql_query($del) or die('unable to update bulk credits ');
                           $newCredits = $credts-$credits;
                           
                   	   $stat=1;
                           $update = "UPDATE bulk_credits SET credits='$newCredits' where id='$creditid'";
			   //$insert="INSERT into bulk_credits values('','$invoiceno','$invoiceamt','$invoicenet','$invoicedate','$newCredits','$parent_company','$username','$stat','$dt')";
			
			   $result=mysql_query($update) or die("Could not update bulk credits ");
                           
                            $insert1 =   "INSERT into bulk_credits values('','$invoiceno','$invoiceamt','$invoicenet',NOW(),'$credits','$company','$username','$stat','$dt')";
                            $result1=mysql_query($insert1) or die("Could not insert bulk credits1 ");
                        
			   }
			  else
			   {
			   // $credits=round($invoiceamt/($zoneprice));
			   // echo" <br> c2 ". $credits.$invoiceamt."  ".$zoneprice;
			    $stat=1;
			    $insert="INSERT into bulk_credits values('','$invoiceno','$invoiceamt','$invoicenet',NOW(),'$credits','$company','$username','$stat','$dt')";
			    
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
    <?php 
       $query= "SELECT c.company_name FROM company c, affiliates f WHERE c.company_name = f.affiliate_name AND f.parent_company='$parent_company'";
  
       echo $query;
       ?>
    <form action="affiliates_addcredits.php" method="POST" name="categ">
                    <table cellspacing="0" rules="none" align="center" bgcolor="white" width="380"border="5">
                       <tr>
                        <td valign="top" align="center" colspan="3"bgcolor="gray"><b><font size="3">Credit Update Form</b></td>
                       </tr>
                       <tr>                   
                       <td valign="top" width="70%" align="left">Invoice No</td><td align="left" colspan="2"><input type="text"  name="invoiceno" size="30"></td>
                       </tr>
                         <tr>                   
                       <td valign="top" width="70%" align="left">Amount</td><td align="left" colspan="2"><input type="text"  name="invoiceamt" size="30"></td>
                       </tr>
		   <tr>
		   <tr>
                       <td valign="top" width="49%"align="left">Credits</td><td align="left" colspan="2"><input type="text"  name="credits" size="30"></td>
                       </tr>
		 
                       <td valign="top"align="left">Company</td>
                          <td colspan="2">
		       <select name="company" id="company">
		       <option id="">Select Company</option>
		       <?php
                      $query= "SELECT c.company_name FROM company c, affiliates f WHERE c.company_name = f.affiliate_name AND f.parent_company='$parent_company'";
		      // $query="select distinct affiliate_name from affiliates where parent_company='$company' order by affiliate_name";
                       echo $query;
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
