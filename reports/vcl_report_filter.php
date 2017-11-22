
<html>
    <head>
        <meta charset="UTF-8">
         <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
         <link href="tablestyle.css" rel="stylesheet" type="text/css" /> 
         <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
         
        <title></title>
    </head>
    <body>
    
        <?php
        include 'connect.php';    
        ?>
        
        <form  method="post" action="vcl_report.php" class="dark-matter">
            
               <h1>Choose dates which you wish to generate your invoice</h1>
               
                    <table>
                   <tr> <td><label><span>From</span>
                               <input type="text" id="datetimepicker" name="date_from" readonly>
                           </label></td>
                           <td><label><span>To</span> 
                               <input type="text" id="datetimepicker1" name="to_date" readonly></label>
                           </td></tr>
               </table>
                    </label>
                 <label>
                        
                            <input type="submit"  class="button" name="cmdadd" value="Search" />
                             
                   
                </label>
        </form>
        
                  <script src="./jquery.js"></script>
<script src="./jquery.datetimepicker.js"></script>
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
        
    </body>
</html>
