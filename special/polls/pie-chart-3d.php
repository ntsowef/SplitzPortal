<?php

require 'connect.php';
//$id = 3;
$cakeDescription = "Highcharts Pie Chart";
$id = $_REQUEST['poll_id'];
$sql = "select bc.category as quest from mobile_poll m, bam_categories bc where bc.id=m.id and m.id=$id";

$result = mysql_query($sql);
$quest ='';
while ($r = mysql_fetch_array($result)) {
    $quest = $r['quest'];
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $cakeDescription ?></title>
        <link href="cake.generic.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
              var data = {
                         idd: <?php echo $id;?>
                         };
                var options = {
                    chart: {
                        renderTo: 'container',
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }

                    },
                    title: {
                        text: 'Results for <?php echo $quest;?>'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>({point.y} Votes)'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: []
                };
           

                $.getJSON("data/data-pie-chart2.php",data ,function(json) {
                    options.series = json;
                    chart = new Highcharts.Chart(options);
                });
            });
        </script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/highcharts-3d.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
               
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        
         <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script> 
    </body>
</html>
