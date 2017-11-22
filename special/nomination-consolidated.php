<?php
/* Database connection start */
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
	0 =>'name', 
	1 => 'category',
	2=> 'reason',

	
);

// getting total number records without any search
$sql = "SELECT category_code as name, count(category_code) as category,  reason ";
$sql.=" FROM wireles_nomination GROUP BY category_code";
//echo $sql;
$query=mysqli_query($conn, $sql) or die("nomination-data.php: get nominations");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT category_code as name, count(category_code) as category,  reason ";
$sql.=" FROM wireles_nomination GROUP BY category_code ";
//echo $sql;
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR category LIKE '".$requestData['search']['value']."%' ";
        $sql.=" OR reason LIKE '".$requestData['search']['value']."%' "; 
	$sql.=" OR name LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("nomination-consolidated.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY category DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	

//echo "<br> ".$sql;

$query=mysqli_query($conn, $sql) or die("nominations-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["name"];
	$nestedData[] = $row["category"];
	
	$nestedData[] = $row["reason"];
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
