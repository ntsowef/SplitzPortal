<?php
 
     	$id=$_POST['id'];
	$logname = $_REQUEST['user'];
	$username = $_REQUEST['user'];
	$company = $_REQUEST['compan'];
	$admin= $_POST['admin'];
	$credits= $_REQUEST['credits'];
	$creditid= $_REQUEST['creditid'];
	$SendSMG = $_POST['Message'];
	$message=$SendSMG.' ::'.$company;
	
	if (strlen(trim($SendSMG)) == 0)
	{
	?>
      <script language = "javascript" style = "text/javascript"> 
	  	alert("Please enter your message");
		window.href = "bulkmsgs.php";
	</script>
	<?php
	}
/*
	
*/
	include "connect.php";
	$DateSend=date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
	$blnSent = false;
	
	if (strlen($SendSMG) == 0)
	{
		?>
		<script language = "javascript" style = "text/javascript"> 
			alert("Please enter your message");
			window.href = "bulkmsgs.php";
		</script>
		<?php
	}

//}
//else
//{ 
    include "connect.php";	
    $strLine = $_POST['Phone_numbers'];
    $Phone_numbers = $_POST['Phone_numbers'];
    $company = $_POST['compan'];
    $admin= $_POST['admin'];
    $credits= $_REQUEST['credits'];
    $creditid= $_REQUEST['creditid'];
    $SendSMG = $_POST['Message'];
    $message=$SendSMG.':: '.$company;
    $SendSMG  = urlencode($SendSMG);
    $sms_group = strtolower($_POST['sms_group']);
    $x=strstr($Phone_numbers,",");
   
    
   
   if($credits>0)
   {
	
       
       
              $query = "SELECT  msisdn from sms_group_".$sms_group;
              //echo $query;
              $result = mysql_query($query) or die("Couldn't Select sms_group ".mysql_get_last_message());
               $msgcount=0;
		
              while ($row = mysql_fetch_array($result)) {
                  
               //   echo $msgcount."   cell no= ".$row['msisdn']." <br>";
                  if($credits > $msgcount ){
                     $msgcount ++;
                     $message=str_replace("'"," ",$message);
                      $query1="INSERT INTO bulkmessages(id, message, msisdn, queued, message_date, company, username) VALUES('','$message','".$row['msisdn']."', 'Q',NOW(),'$company','$username')";
	             // echo $query1."<br>";
                      $res = mysql_query($query1) or die("Couldn't Insert bulkpush 2 ");
                      if ($res){
                         $credits=$credits-1;
			$sqlu="update bulk_credits set credits='$credits' where id='$creditid'";
                        $resu=mysql_query($sqlu) or die('Unable to update credits ');
                        echo " <br> ".$sqlu; 
                      }
                     
                  }
		/*
               if($credits > $msgcount )
		//	{ 
			$celnumber=$row['msisdn'];
			$msgcount++;
			
                      
			$message=str_replace("'"," ",$message);
		
                        
                        $query1="INSERT INTO bulkmessages(id, message, msisdn, queued, message_date, company, username) VALUES('','$message','$celnumber', 'Q',NOW(),'$company','$username')";
			//echo $query1;
			$result = mysql_query($query1) or die("Couldn't Insert bulkpush 2 ");
			
						
			$credits=$credits-1;
			$sqlu="update bulk_credits set credits='$credits' where id='$creditid'";
                        
                       // echo " <br> ".$sqlu;
			$resu=mysql_query($sqlu) or die('Unable to update credits ');
			//echo $credits;
		//	}*/
              }
              
          
		
                
               
	
             mysql_close();	
	 }
	else
	{	
		$blnSent == true;
		?>
		  <script language = "javascript" style = "text/javascript"> 
		    alert("Credits are finished. Buy some more credits keep posting messages. Processing record: <?php echo $value;?>");
		    window.href = "bulk_group.php";
		</script>
		 <?php
	}
//}

	  ?>
		<script language = "javascript" style = "text/javascript"> 
			alert('Message sending Completed');
			window.location = "bulk_group.php";									
		</script>
             <?php

 
?>