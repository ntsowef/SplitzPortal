<?php
include_once('../connect.php');
include_once('function.php');


session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];



if(isset($_POST['pageId']) && !empty($_POST['pageId']))
{
    $id=$_POST['pageId'];
}
else
{
    $id='0';
}
$pageLimit=PAGE_PER_NO*$id;
$query="select group_name sms_group where company='$company' order by id desc
limit $pageLimit,".PAGE_PER_NO;
//echo $query;
$res=mysql_query($query);
$count=mysql_num_rows($res);
$HTML='';
if($count > 0)
{
    while($row=mysql_fetch_array($res))
    {
        $group_name=$row['group_name'];
        //$link=$row['postlink'];
        $HTML.='<div>';
        $HTML.='<a href=manage_bulk.php>'.$group_name.'</a>';
        $HTML.='</div><br/>';
    }
}
else
{
    $HTML='No Data Found';
}
echo $HTML;
?>