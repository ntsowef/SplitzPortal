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
         <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
         <link href="tablestyle.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>

        <title></title>
    </head>
    <body>
    
        <?php
        include 'connect.php';    
        ?>
        
        <form  method="post" action="customdate.drl.php" class="dark-matter">
            
               <h3>SELECT DATE WHICH U WANT TO RETRIEVE YOUR DELIVERY REPORTS</h3>
        
               
               <table>
                   <tr> <td><label><span>Date From</span>
                               <input type="text" id="datetimepicker" name="date_from" readonly>
                           </label></td>
                           <td><label><span>Date To:</span> 
                               <input type="text" id="datetimepicker1" name="to_date" readonly></label>
                           </td></tr>
               </table>
                 <label>
                        
                            <input type="submit"  class="button" name="cmdadd" value="Search" />
                  
                   
                </label>
        </form>
        
            <script src="js/jquery.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
format:'Y-m-d', 

lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1990-01-05'
});


$('#datetimepicker1').datetimepicker({
dayOfWeekStart : 1,
format:'Y-m-d', 

lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1990-01-05'
});
</script>
        
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
        

    </body>
</html>
