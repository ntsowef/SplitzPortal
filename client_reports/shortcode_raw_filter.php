
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
        
        <form  method="post" action="shortcode_raw.php" class="dark-matter">
            
               <h3>Select Shortcode which you wish to retrieve the RAW DATA on</h3>
               <label>
                   
                         <span>Choose</span>
                   
                    	<select name="shortcode">
                        	<option>Select Shortcode</option>
                             <?php
                           // $g = mysql_query("select name from teams");
                           $g = mysql_query("select shortcode from shortcodes where shortcodetype='premium' order by shortcode asc");
					while($id=mysql_fetch_array($g))
					{
                                            echo "<option>".$id['shortcode']."</option>";
                                        }
   							
                            ?>

                        </select>
                    
                    </label>
               
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
