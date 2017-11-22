<?php
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/table.css" type="text/css"/>	
        <title></title>
    </head>
    <body>
        <?php
         include "connect.php";	
        $query= "select * from sms_group where company='$company' ORDER BY group_name";
        
           $result = mysql_query($query) or die("Couldn't Select sms_group ".mysql_get_last_message());
               $msgcount=0;
              $numofRows = mysql_num_rows($result);
              if ($numofRows > 0){
                echo "<div  class='CSS_Table_Example' style='width:600px;height:150px;'> <br>";
                
                echo " <table> ";
                echo "<p><tr><td>Group Name</td> <td>Size</td>  </tr> </p>";
                while ($row = mysql_fetch_array($result)) {
                    
                   // $sql = "SELECT count(*) FROM sms_group_".row['group_name'];
                  //   $result1 = mysql_query($sql) or die("Couldn't Select sms_group ".mysql_get_last_message());
                   //  if (list($count)=mysql_fetch_row($result1))
                       echo "<p><tr> </p> "; 
                     //  echo " <p> <td>".$row['group_name']." </td> <td".$count." </td> </p>";
                       
                       echo " <p> <td>".$row['group_name']." </td> <td><a href='manage_group.php?group_name=".$row['group_name']."'>Manage</a> </td> </p>";
                       echo "<p></tr></p>";
                }
              echo " </table> <br>";
              echo  "</div>";
              }else{
                  echo " Please create groups because you currently don't have bulk groups";
              }
                  
        ?>
    </body>
</html>
