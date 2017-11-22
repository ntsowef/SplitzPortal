<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 
        $currentDate = date("Y-m-d");
         include "connect.php";
         
         $sql = "select msisdn from competition_weekly_winners where date_created like '".$currentDate."%'";
        echo $sql;
         
         $resc=mysql_query($sql) or die('Unable to select from competition_weekly_winners');
        // put your code here
         
             if(mysql_num_rows($resc) > 0)
		{
                   while(list($msisdn)=mysql_fetch_row($resc)){
                       echo " Weekly Winner is ".$msisdn;
                   }  
                }
        ?>
    </body>
</html>
