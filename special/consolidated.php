<!DOCTYPE html>
<html>
	<title>Consolidated Nomination List</title>
	<head>
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
                <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#nomination-grid').DataTable( {
				
				  	dom: 'T<"clear">lfrtip',
			   		"tableTools": {
			   	   	"sSwfPath": "swf/copy_csv_xls_pdf.swf",
			   	    	"sRowSelect": "multi",
				    	"aButtons": [
					        	"select_all", 
					        	"select_none",
							{
						    		"sExtends":    "collection",
						    		"sButtonText": "Export",
						    		"aButtons":    [ "csv", "xls", "pdf" ]
							}
                                                    ]
                                        },
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"nomination-consolidated.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".nomination-grid-error").html("");
							$("#nomination-grid").append('<tbody class="nomination-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#nomination-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		<style>
			div.container {
			    margin: 0 auto;
			    max-width:760px;
			}
			div.header {
			    margin: 30px auto;
			    line-height:30px;
			    max-width:760px;
			}
			body {
			    background: #f7f7f7;
			    color: #333;
			    font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
			}
		</style>
	</head>
	<body>
		<div class="header"><h1>Consolidated Nominations list <h1></div>
		<div class="container">
			<table id="nomination-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
					<thead>
						<tr>
							<th>Name</th>
							<th>Count</th>
							<th>Reason</th>
							
						</tr>
					</thead>
			</table>
		</div>
	</body>
</html>
