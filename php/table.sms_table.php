<?php
session_start();



$table_name = "sms_group_".$_SESSION["group_name"];
//$table_name = "sms_group_Family1";
//echo " table name ".$table_name;
/*
 * Editor server script for DB table sms_table
 * Created by http://editor.datatables.net/generator
 */

// DataTables PHP library and database connection
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;


// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, $table_name, 'msisdn' )
	->fields(
		Field::inst( 'msisdn' )
			->validator( 'Validate::notEmpty' )
	)
	->process( $_POST )
	->json();
