<?php



session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$group_name = $_REQUEST['group_name'];



$_SESSION["group_name"]=$_REQUEST['group_name'];

//echo "Manage Bulk Group Page  ".$company."   for group name ".$group_name;
?>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>DataTables Editor - sms_table</title>

		<link rel="stylesheet" type="text/css" href="css/demo.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.editor.css">

		<script type="text/javascript" charset="utf-8" src="https://code.jquery.com/jquery-1.11.2.js"></script>
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="js/table.sms_table.js"></script>
	</head>
	<body>
            <div class="container">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="sms_table" width="50%">
				<thead>
					<tr>
						<th>msisdn</th>
					</tr>
				</thead>
			</table>

		</div>
        </body>
</html>