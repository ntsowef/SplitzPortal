<?php

session_start();

$company = $_SESSION["company"];

$page = $_SERVER['PHP_SELF'];
$sec = "30";
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <title></title>
    </head>
    <body>
        
  
<a style="font-family:verdana;font-size:20px;">
    <br><center><u>Welcome <?php echo $company; ?> </u></center><br></a>
<style type="text/css">
.marquee_code
{height:200px;
width:1200px;
background-color:2F20FA;
font-family:Helvetica;
font-size:24pt;
color:FF9061;
border-width:1px;
border-style:outset;
border-color:4ECAB5;
}
</style>
<?php

include 'connect.php';
//echo $company;
//$company = 'metro fm';
//while (1){
  $query = "SELECT id, message, msisdn from temp_marquee where company='".$company."' and status = 0 limit 1";
 // echo $query;
  $resc=mysql_query($query) or die('Unable to select from temp_marquee');
  if(mysql_num_rows($resc) > 0)
  {
      if (list($id,$message,$msisdn) = mysql_fetch_row($resc)) {
          echo "<marquee class='marquee_code' direction='left' behavior='scroll' scrollamount='4' >".$message."</marquee>";
          
       $query = "UPDATE temp_marquee SET status=1 where id=".$id;    
       $resu=mysql_query($query) or die('unable to update temp_marquee ');
      }
     
     
              
  }
 //  sleep(3);
//} 
?>


    </body>
</html>
