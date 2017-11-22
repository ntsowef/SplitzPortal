
/*
 * Editor client script for DB table sms_table
 * Created by http://editor.datatables.net/generator
 */

(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajax": "php/table.sms_table.php",
		"table": "#sms_table",
		"fields": [
			{
				"label": "msisdn",
				"name": "msisdn"
			}
		]
	} );

	$('#sms_table').DataTable( {
		"dom": "Tfrtip",
		"ajax": "php/table.sms_table.php",
		"columns": [
			{
				"data": "msisdn"
			}
		],
		"tableTools": {
			"sRowSelect": "os",
			"aButtons": [
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]
		}
	} );
} );

}(jQuery));

