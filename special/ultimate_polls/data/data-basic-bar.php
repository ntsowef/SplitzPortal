<?php

#Basic Line
require '../../conn/remoteconn.php';

$id = $_REQUEST['id'];
$query="SELECT COUNT(*) AS Votes,quest, sms_poll_ans.opt AS Opt FROM cell_poll, sms_poll_ans WHERE cell_poll.id=sms_poll_ans.qst_id AND cell_poll.id='38' GROUP BY Opt";



$result = mysql_query($query);
//$result = mysql_query("SELECT id, year AS Year, month AS Month, COUNT( * ) AS Count FROM activities WHERE year=2013 GROUP BY MONTH ORDER BY id");
//echo $query;
$bln = array();
$bln['name'] = 'Option';
$rows['name'] = 'Votes';
while ($r = mysql_fetch_array($result)) {
    $bln['data'][] = $r['Opt'];
    $rows['data'][] = $r['Votes'];
}
$rslt = array();
array_push($rslt, $bln);
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);

mysql_close($con);


