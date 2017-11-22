<?php




session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
//$group_name = $_REQUEST['group_name'];



//$_SESSION["group_name"]=$_REQUEST['group_name'];

//echo "Manage Bulk Group Page  ".$company."   for group name ".$group_name;

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

// Including the DB connection file:
require 'connect.php';

$shortcode = '';
    
    $query = "SELECT * from radio_shortcode where radion_station_name='$company'";
    
    
    //echo "  ".$query;
    $result = mysql_query($query);
    $row  = mysql_fetch_array($result);
    if(is_array($row)) {
        $shortcode = $row['shortcode'];        
    }
// Removing notes that are older than an hour:
mysql_query("DELETE FROM notes WHERE id>3 AND dt<SUBTIME(NOW(),'0 1:0:0')");

$query = mysql_query("SELECT * FROM notes ORDER BY id DESC");

$notes = '';
$left='';
$top='';
$zindex='';




while($row=mysql_fetch_assoc($query))
{
	// The xyz column holds the position and z-index in the form 200x100x10:
	list($left,$top,$zindex) = explode('x',$row['xyz']);
   if ($row['id']==1){
       $textmessage = $row['text']." ON ".$shortcode;
	$notes.= '
	<div class="note '.$row['color'].'" style="left:'.$left.'px;top:'.$top.'px;z-index:'.$zindex.'">
		'.htmlspecialchars($textmessage).'
		<div class="author">'.htmlspecialchars($row['name']).'</div>
		<span class="data">'.$row['id'].'</span>
	</div>';
   }else{

       $textmessage = $row['text']." ON ".$shortcode;
       $notes.= '
	<div class="note '.$row['color'].'" style="left:'.$left.'px;top:'.$top.'px;z-index:'.$zindex.'">
		'.htmlspecialchars($textmessage).'
		<div class="author">'.htmlspecialchars($row['name']).'</div>
		<span class="data">'.$row['id'].'</span>
	</div>';
   }   
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        
<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" media="screen" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>

<script type="text/javascript" src="script.js"></script>
        <title></title>
        <style type="text/css">

            body {
                background: url('images/Bulk_SMS.png')fixed 50% / cover;
            }
        </style>

    </head>
    <body>
        
         <?php echo $notes?>

        <!--div id="main">
               

                <!--?php echo $notes?-->

        <!--/div-->
    </body>
</html>
