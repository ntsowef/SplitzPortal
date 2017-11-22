<?php
#Pie Chart
//require '../../conn/connection.php';


require '../connect.php';
$id = $_GET['idd'];
$query="SELECT COUNT(*) AS Votes,quest, splitz_poll_ans.opt AS Opt FROM mobile_poll, splitz_poll_ans WHERE mobile_poll.id=splitz_poll_ans.poll_id AND mobile_poll.id=$id GROUP BY Opt";
//$query="SELECT COUNT(*) AS Votes,quest, splitz_poll_ans.opt AS Opt FROM mobile_poll, splitz_poll_ans WHERE mobile_poll.id=splitz_poll_ans.poll_id AND mobile_poll.id=1 GROUP BY Opt";


$result = mysql_query($query);



//result = mysql_query("SELECT id, year AS TAHUN, COUNT( * ) AS JUMLAH FROM activities GROUP BY TAHUN");
#$result = mysql_query("SELECT name, val FROM web_marketing");

//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Percentage';
//$rows['innerSize'] = '50%';
while ($r = mysql_fetch_array($result)) {
    $rows['data'][] = array(''.$r['Opt'].'"', $r['Votes']);    
}
$rslt = array();
array_push($rslt,$rows);
//print json_encode($rslt, JSON_NUMERIC_CHECK);
echo json_encode($rslt, JSON_NUMERIC_CHECK);
mysql_close($connection);


