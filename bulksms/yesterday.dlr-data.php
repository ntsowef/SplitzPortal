<?php
/* Database connection start */
session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];

//$company = "Wireless Connect";
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];


$servername = "196.37.186.21";
$username = "root";
$password = "n4u2cc";
$dbname = "sms_data";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'msisdn', 
	1 => 'message_date',
	2=> 'date_sent',
	3=> 'status',
		
	
);

// getting total number records without any search
$sql = "SELECT msisdn, message_date, date_sent, status ";
$sql.=" FROM bulkmessages where company='$company' and message_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
$query=mysqli_query($conn, $sql) or die("nomination-data.php: get nominations");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT msisdn, message_date, date_sent, status ";
$sql.=" FROM bulkmessages where company='$company' and message_date > DATE_SUB(NOW(), INTERVAL 1 DAY)";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( msisdn LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR message_date LIKE '".$requestData['search']['value']."%' ";
        $sql.=" OR date_sent LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" OR status LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("nomination-data.php: get 12");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//echo $sql;

$query=mysqli_query($conn, $sql) or die("nominations-data.php: get 11");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["msisdn"];
	$nestedData[] = $row["message_date"];
	$nestedData[] = $row["date_sent"];
	$nestedData[] = $row["status"];
	//$nestedData[] = $row["date_added"];
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
