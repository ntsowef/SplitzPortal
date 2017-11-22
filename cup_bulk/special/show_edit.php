<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->runQuery("SELECT * FROM bam_categories WHERE id='" . $_GET["id"] . "'");
?>
<td colspan=6 class="edit-form">
<form name="frmToy" method="post" action="" id="frmToy">

<div>
<label>Category</label> 
<span id="category-info" class="info"></span><br/>
<input type="text" name="category" id="category" class="demoInputBox" value="<?php echo $result[0]["category"]; ?>">
</div>
<div>
<input type="button" name="submit" id="btnAddAction" value="Save" onClick="edit(<?php echo $result[0]["id"]; ?>);" />
</div>
</form>
</td>