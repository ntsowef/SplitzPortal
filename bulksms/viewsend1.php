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
		if(empty($id))
		 {$id=$_REQUEST['id'];}
		$usernam = $_REQUEST['user'];
		$company = $_REQUEST['compan'];
		$admin= $_REQUEST['admin'];	 
		$dfrom = $_REQUEST['dfrom'];
		$dto = $_REQUEST['dto'];
		
		//PAGING
               $page_name="viewsend1.php"; 
                $start=$_GET['start'];// To take care global variable if OFF
                if(strlen($start) > 0 and !is_numeric($start))
                  {
                  echo "Data Error";
                  exit;
                  } 
                //Variables
                $lim=$_POST['limit'];
                $name=$_POST['name'];
                $eu=($start-0);
                if(!empty($lim))
                {$limit=$lim;}
                else
                {$limit=	        10;} //No of records to be shown per page.
                $current=	    $eu+$limit;
                $back=	      $eu-$limit;
                $next =        $eu + $limit;
                //include "mtn_connect.php";
                include "remote_connect.php";
		if(!empty($dfrom) && !empty($dto))
		{$queryc = "SELECT company,celnumber,message_date,message 
                                  FROM bulkpush WHERE date(message_date) >= '$dfrom' and date(message_date) <='$dto' and company='$company'";
	    	}
		 else	 
		 {$queryc = "SELECT company,celnumber,message_date,message FROM bulkpush where company='$company'";
		 }
		$resultc = mssql_query($queryc) or die("Couldn't select infor from bulkpush! ");
                $nume=mssql_num_rows($resultc);
                $pages=round($nume/$limit);
                if($pages==0){$pages=1;}
                    mssql_close();
                //PAGING END 1                     	     
	     
         $totlim=$eu+$limit;
	 $total=0;
	 include "connect.php";
	 if(!empty($dfrom) && !empty($dto))
         {
	// $query = "SELECT company,celnumber,message_date,message  
         //                         FROM bulkpush WHERE date(message_date) >= '$dfrom' and date(message_date) <='$dto' and Username='$company'  limit $eu, $limit";
	 $query = "SELECT company,celnumber,message_date,message  
                                  FROM bulkpush WHERE date(message_date) >= '$dfrom' and date(message_date) <='$dto' and Username='$company'order by id desc";
	   $result = mssql_query($query) or die("Couldn't select infor 1");			  
        $cnt = "SELECT  count(id) FROM bulkpush where date(message_date) >= '$dfrom' and date(message_date) <='$dto' and Username='$company'";
	$rescnt = mssql_query($cnt) or die("Couldn't select infor 2");
	}
	 else	 
	 {
	  $query = "SELECT  company,celnumber,message_date,message FROM bulkpush where company='$company'order by id desc";
	/*
	  $query = "select company,celnumber,message_date,message from
	  (select top $limit company,celnumber,message_date,message from 
	  (select top $totlim company,celnumber,message_date,message from bulkpush where company='$company') as newtbl ) as newtbl2 order by id desc";
	  */
	  $result = mssql_query($query) or die("Couldn't select infor 2");
	   $cnt = "SELECT  count(id) FROM bulkpush where company='$company'";
	   $rescnt = mssql_query($cnt) or die("Couldn't select infor 2");
	  }
	 list($recs)=mssql_fetch_row($rescnt);   
	 $num=mssql_num_rows($result);
	 if ($num > 0)
	 {
	
	  echo"
	  <table width='500'> 
	  <form action='moptions.php' method='post'>
	  ";
	
		  session_start();  
		  unset($_SESSION['report_header']);
		  unset($_SESSION['report_values']);
		  $_SESSION['report_header']=array("Company","Cell Number","Date Send","Message"); 
		  $i=0;
		echo"<b>". $_SESSION['report_values'][$i][0]="Total Records:".$recs;
		echo"<br>";
		echo"<b>". $_SESSION['report_values'][$i][0]="Company"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo"<b>". $_SESSION['report_values'][$i][1]="Cell Number"."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo"<b>". $_SESSION['report_values'][$i][2]="Date Send"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
		echo"<b>". $_SESSION['report_values'][$i][4]="Message"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
		echo"<br>";
		echo"<br>";
		while(list($username,$celnumber,$datesend,$message)=mssql_fetch_row($result))
		{  
		   $dsend=substr($datesend,0,10);
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
	
		$i++;
				
		echo"           
		    <tr>
		    <td align='left' valign='top'width='80'>";echo $_SESSION['report_values'][0]=$username." ";echo "</td>
		    <td align='left' valign='top'width='99'>";echo $_SESSION['report_values'][1]=$celnumber." ";echo "</td>
		    <td align='left' valign='top'width='80'>";echo $_SESSION['report_values'][2]=$dsend." ";echo "</td>
		    <td align='left' valign='top'>";echo $_SESSION['report_values'][4]=$message8." ";echo "</td>
		    </tr>";
		
		}
		
	  echo"<tr>
	        <td></td>
	        <td align='right'>
		<input type='hidden' name='userid' value='$id'>
		<input type='hidden' name='user' value='$usernam'>
		<input type='hidden' name='compan' value='$company'>
		<input type='hidden' name='admin' value='$admin'>
		</td>
		 <td></td>
		<td align='right'>
		  <a href='export_report.php?fn=bulk_report'>Generate Report</a>
		 <a href='viewsend.php?id=$id&user=$usernam&compan=$company&admin=$admin&dfrom=$dfrom&dto=$dto'>Exit</a>
	       	</td>
		</tr>	 
	  </form>
	  </table>";
	
	  }
	  else
	  {
	  ?>
		<script language = "javascript" style = "text/javascript"> 
		   alert("There is no matching records in our database");
		   window.location = "viewsend.php?userid=<?php echo $id;?>&user=<?php echo $usernam;?>&compan=<?php echo $company;?>&admin=<?php echo $admin;?>";									
		</script>
	    <?php
	  }
	  //<a href='save.php?id=$id&user=$usernam&compan=$company&admin=$admin&dfrom=$dfrom&dto=$dto'>Save Excel</a>
	 
	?>
	
	  </td>
                  </tr>
                </table>
	
</body>
</html>
