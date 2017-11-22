<?php
 include "connect.php";
$poll_id = $_REQUEST['poll_id'];

//echo " found the poll id ".$poll_id;
$query = "DELETE FROM mobile_poll where id='$poll_id'";
echo $query;

$result=mysql_query($query) or die('Unable to DELETE cell_poll');

if ($result ){
   // echo "Delete was successful";
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=list_polls.php">';
}else{
    echo " failed to remove the poll ";
}