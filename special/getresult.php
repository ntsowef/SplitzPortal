<?php
require_once("dbcontroller.php");
require_once("pagination.class.php");
$db_handle = new DBController();

$name = "";
$code = "";

$perPage = new PerPage();


$orderby = " ORDER BY category_code";
$sql = "SELECT * FROM bam_categories " . $queryCondition;
$paginationlink = "getresult.php?page=";					
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $sql . $orderby .  " limit " . $start . "," . $perPage->perpage; 
$result = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $db_handle->numRows($sql);
}
$perpageresult = $perPage->perpage($_GET["rowcount"], $paginationlink);
?>
<form name="frmSearch" method="post" action="index.php">
			<!--div class="search-box">
			<p><input type="hidden" id="rowcount" name="rowcount" value="<?php echo $_GET["rowcount"]; ?>" /><input type="text" placeholder="Name" name="name" id="name" class="demoInputBox" value="<?php echo $name; ?>"	/><input type="text" placeholder="Code" name="code" id="code" class="demoInputBox" value="<?php echo $code; ?>"	/><input type="button" name="go" class="btnSearch" value="Search" onclick="getresult('<?php echo $paginationlink . $page; ?>')"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'"></p>
			</div-->
			
			<table cellpadding="10" cellspacing="1">
        <thead>
					<tr>
                                         <th><strong>Category Code</strong></th>
                                         <th><strong>Category Description</strong></th>
					
					
					</tr>
				</thead>
				<tbody>
<?php
if(!empty($result)) {
foreach($result as $k=>$v) {
?>
<tr id="toy-<?php echo $result[$k]["id"]; ?>">
<td class="category"><?php echo $result[$k]["category_code"]; ?></td>
<td class="category"><?php echo $result[$k]["category"]; ?></td>

</tr>
<?php
}}
if(isset($perpageresult)) {
?>
<tr>
<td colspan="6" align=right> <?php echo $perpageresult; ?></td>
</tr>
<?php } ?>
<tbody>
</table>
</form>	