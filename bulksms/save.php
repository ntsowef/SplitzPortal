<?php
	$id=$_REQUEST['id'];
	$usernam = $_REQUEST['user'];
	$company = $_REQUEST['compan'];
	$admin= $_REQUEST['admin'];	 
	$dfrom = $_REQUEST['dfrom'];
	$dto = $_REQUEST['dto'];
	echo"com: ".$company." dfr: ".$dfrom." dto: ".$dto;
	include "remote_connect.php";
	 if(!empty($dfrom) && !empty($dto))
         {
	 $query = "SELECT company,celnumber,message_date,message  
                                  FROM bulkpush WHERE date(message_date) >= '$dfrom' and date(message_date) <='$dto' and Username='$company'";
	   $result = mssql_query($query) or die("Couldn't select infor 1".mysql_error());			  
         }
	 else	 
	 {
	  $query = "SELECT  company,celnumber,message_date,message FROM bulkpush where company='$company'";
	  $result = mssql_query($query) or die("Couldn't select infor 2".mysql_error());
	 }
	    
	$num=mssql_num_rows($result);
	if ($num > 0)
	{
	header ("Content-type: application/csv\nContent-Disposition: \"inline; filename=Bulk_Report.csv\"");
	echo"Company,Cell Number,Date Send,Message\n"; 
	while(list($username,$celnumber,$datesend,$message)=mssql_fetch_row($result))
		{  $dsend=substr($datesend,0,10);
		   if(strlen($message)>50)
		    {$message1=substr($message,0,50)."<br/>".substr($message,50);}
		    else
		    {$message1=$message;}
		   if(strlen($message1)>100)
		   {$message2=substr($message1,0,100)."<br/>".substr($message1,100);}
		    else
		    {$message2=$message1;}
		   if(strlen($message2)>150)
		   {$message3=substr($message2,0,150)."<br/>".substr($message2,150);}
		    else
		    {$message3=$message2;}
		    if(strlen($message3)>200)
		    {$message4=substr($message3,0,200)."<br/>".substr($message3,200);}
		      else
		    {$message4=$message3;}
		    
		    if(strlen($message4)>200)
		    {$message5=substr($message4,0,200)."<br/>".substr($message4,250);}
		      else
		    {$message5=$message4;}
		    if(strlen($message5)>200)
		    {$message6=substr($message5,0,200)."<br/>".substr($message5,300);}
		      else
		    {$message6=$message5;}
		    if(strlen($message6)>200)
		    {$message7=substr($message6,0,200)."<br/>".substr($message6,350);}
		      else
		    {$message7=$message6;}
		    if(strlen($message7)>200)
		    {$message8=substr($message7,0,200)."<br/>".substr($message7,400);}
		      else
		    {$message8=$message7;}
		    echo"$username,$celnumber,$dsend,$message8";
		}
	  ?>
		<script language = "javascript" style = "text/javascript"> 
		   alert("File saved ");
		   window.location = "moptions.php?userid=<?echo $id;?>&user=<? echo $username;?>&compan=<? echo $company;?>&admin=<?echo $admin;?>";									
		</script>
	    <?php
	  }
	  else
	  {
	  ?>
		<script language = "javascript" style = "text/javascript"> 
		   alert("There is no matching records in our database");
		   window.location = "viewsend.php?userid=<?echo $id;?>&user=<? echo $username;?>&compan=<? echo $company;?>&admin=<?echo $admin;?>";									
		</script>
	    <?php
	  }
?>