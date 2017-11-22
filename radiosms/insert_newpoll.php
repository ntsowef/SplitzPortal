<?php

session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];

//echo "  hello world   ".$_POST['poll_question']." <br>";

include 'connect.php';
    $shortcode = '';
    
    $query = "SELECT * from radio_shortcode where radion_station_name='$company'";
    
    
    //echo "  ".$query;
    $result = mysql_query($query);
    $row  = mysql_fetch_array($result);
    if(is_array($row)) {
        $shortcode = $row['shortcode'];        
    }

echo " Shortcode ". $shortcode."<br>";
//if(@$_POST['Submit'])		{
   
     $id = $_REQUEST['userid'];
     $username = $_REQUEST['user'];
    // $company = $_REQUEST['compan'];
    // $admin= $_REQUEST['admin'];
    
      $poll = $_POST['poll_question']; // required
       $opt1 = $_POST['opt1']; // required
      $opt2 = $_POST['opt2']; // required
      $opt3 = $_POST['opt3']; // not required
      $opt4 = $_POST['opt4']; // required
      
    // include "connect.php";
     $query = "INSERT INTO cell_poll (id, status, quest, opt1, opt2, opt3, opt4, company, created_by, date_created) VALUES('','active','$poll','$opt1','$opt2','$opt3','$opt4','$company','$username',NOW())";
     echo $query;
     
     $result=mysql_query($query) or die('Failed to insert cell_poll '.mysql_error());
     if ($result){
         echo "<br> Poll was save succesfully <br>";
     $g = mysql_query("select max(id) from cell_poll");
    // $id=mysql_fetch_array($g);
     while($id=mysql_fetch_array($g))
		$poll_id = $id[0];		{
     //echo "<a href='poll_shortcode.php?poll_id=$id[0]'>Select a shortcode your wish to attach to this poll </a> <br>";
                                        }
           $query = "INSERT INTO poll_shortcode (id, shortcode, company, poll_id) values ('','$shortcode','$company','$poll_id')";
          //echo $query;
     
            $result=mysql_query($query) or die('Failed to insert poll_shortcode '.mysql_error());      
             if($result==true){
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=list_polls.php?user=$username&company=$company">';
        }
     }
     
     
     
  ?>
    
