<?php
include "connect.php";
function is_radio($name){
    $is_radio = false;
    $result = mysql_query("SELECT * from radio_shortcode where radion_station_name='$name'");
    $num_row  = mysql_num_rows($result);
    if ($num_row>0){
        
        $is_radio = true;
    }else{
        $is_radio = false;
    }
    return $is_radio;
    
    
}

function get_shortcode($name){
    $shortcode = '';
    
    $query = "SELECT * from radio_shortcode where radion_station_name='$name'";
    
    
    //echo "  ".$query;
    $result = mysql_query($query);
    $row  = mysql_fetch_array($result);
    if(is_array($row)) {
        $shortcode = $row['shortcode'];        
    }
    
    return $shortcode;
            
}


?>
