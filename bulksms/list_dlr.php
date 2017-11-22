
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
        <link href="tablestyle.css" rel="stylesheet" type="text/css" />
        <title></title>
    </head>
    <body>
        <h2>  </h2>
         <div class="CSSTableGenerator">
             <table >
                  <tr>
                        <td>
                            Transaction#
                        </td>
                         <td>
                            Description
                        </td>
                      
                      
                    </tr>
                 <tr>
                        <td>
                            Transaction1
                        </td>
                       
                        <td>
                            <a href="today.drl.php?company=<?php echo $company; ?>"> Process Todays Delivery Report</a>
                        </td>
                      
                    </tr>
                    <tr>
                        <td>
                            Transaction2
                        </td>
                       
                        <td>
                            <a href="yesterday.drl.php?company=<?php echo $company; ?>"> Process Yesterday Delivery Report</a>
                        </td>
                      
                    </tr>
                  <tr>
                        <td>
                            Transaction3
                        </td>
                       
                        <td>
                            <a href="weekly.drl.php?company=<?php echo $company; ?>"> Process Weekly Delivery Report</a>
                        </td>
                      
                    </tr>
                     <tr>
                        <td>
                            Transaction4
                        </td>
                       
                        <td>
                            <a href="monthly.drl.php?company=<?php echo $company; ?>"> Process Monthly Delivery Report</a>
                        </td>                      
                    </tr>
                     <tr>
                        <td>
                            Transaction5
                        </td>
                       
                        <td>
                            <a href="custom_dates.php?company=<?php echo $company; ?>"> Process Custom Dates Report</a>
                        </td>                      
                    </tr>
             </table>
         </div>    
         <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
        
    </body>
</html>
