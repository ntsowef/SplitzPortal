<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["id"])) {
	$result = mysql_query("DELETE FROM bam_categories WHERE id=".$_GET["id"]);
}
?>