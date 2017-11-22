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
        include "connect.php";
         $poll_id = $_REQUEST['poll_id'];
        // echo $poll_id;
         $company = $_REQUEST['company'];
         $shortcode = $_POST['shortcode'];
            if(isset($_POST['Submit'])){
                 
     $query = "INSERT INTO poll_shortcode (id, shortcode, company, poll_id) values ('','$shortcode','$company','$poll_id')";
    //echo $query;
     
     $result=mysql_query($query) or die('Failed to insert poll_shortcode '.mysql_error());      
     
     
            }
        ?>
    </body>
</html>
