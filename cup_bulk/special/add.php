<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = mysql_query("INSERT INTO bam_categories(id,category_code) VALUES('','".$_POST["category"]."')");
?>