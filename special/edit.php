<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
mysql_query("UPDATE bam_categories set  category_code = '".$_POST["category"]."'  WHERE  id=".$_GET["id"]);
$result = $db_handle->runQuery("SELECT * FROM bam_categories WHERE id='" . $_GET["id"] . "'");
?>
<td class="category"><?php echo $result[0]["category"]; ?></td>
<td class="action">
<a class="btnEditAction" onClick="showEdit(<?php echo $_GET["id"]; ?>)">Edit</a> <a class="btnDeleteAction" onClick="del(<?php echo $_GET["id"]; ?>)">Delete</a>
</td>