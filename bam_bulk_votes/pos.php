<?php


session_start();
$username = $_SESSION["username"];
$company = $_SESSION["company"];
$id = $_SESSION["user_id"];
$admin = $_SESSION["admin"];
$_SESSION['logged_in'] = true; //set you've logged in
$_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
$_SESSION['expire_time'] = 3*5*60;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Splitz Bulk POS </title>
        <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
    </head>
    <body bgcolor="#99CC66">
        <?php
         include "connect.php";
         $amount= trim($_POST['amount']);
         $category= trim($_POST['category']);
         $nominee = trim($_POST['nominee']);
         $msisdn= trim($_POST['msisdn']);
          $status="Ok";
         
           if(isset($_POST['cmdadd'])){
               //echo " Add was pressed";
              if(empty($amount) && empty($msisdn)) {
                   $msg=$msg."Fields must be completed : Amount, MSISDN<br>";
		  $status="False";
              }
              
             if($category == 'Select Category'){
                 $msg=$msg."Select the category<br>";
		  $status="False";
             } 
              
              if ($status == "Ok"){
                 if (strlen($msisdn)==8){
                     $msisdn = "+266".$msisdn;
                 }
                     
                 $base_price = 1.00;
                  
                 $num_votes = round($amount/$base_price);
                 
               //  echo  "number of votes for this number are ".$num_votes."<br>";
                 
                 $query = "INSERT INTO bam_votes_transaction (id,user_id,date_loggedin,msisdn,cash_received,votes_allocated, category)VALUES('','$username',NOW(),'$msisdn','$amount','$num_votes','$category')";
                 // echo ''.$query;
              $i = mysql_query($query);
              
              $select = "SELECT * from mobile_poll_shortcode where id='$category'";
              
              $result = mysql_query($select);
              $arr = mysql_fetch_array($result);
              $team_id = $arr['id'];
              
              
              $ii = 0;
              while ($ii < $num_votes){
              
              $query = "INSERT INTO bam_bulk_votes_queue (id, msisdn, nominee, category_code, date_voted) VALUES(id,'$msisdn','$nominee','$category',NOW()) ";
             // echo $query;
              $eye =  mysql_query($query);
              $ii++;
              }
              $message = $num_votes." votes were allocated to ".$nominee.", thanks for voting and continue to do so.";
               $query1="INSERT INTO bulkmessages(id, message, msisdn, queued, message_date, company, username)
                                     VALUES('','$message','$msisdn', 'Q',now(),'TestRS','Thabang')";
               $eyee =  mysql_query($query1);
               
      // echo $query;
            if(($i==true)&&($eye=true)&&($eyee=true)){
            // echo '<META HTTP-EQUIV="Refresh" Content="0"; URL=confirmation.php?msisdn=$msisdn&amount=$amount>';
               // echo 'something went right';
             
             ?>
                        <script language = "javascript" style = "text/javascript"> 
				window.location = "confirmation.php?msisdn=<?php echo $msisdn;?>&amount=<?php echo $amount;?>&votes=<?php echo $num_votes;?>&userid=<?php echo $username;?>&team=<?php echo $keyword;?>";	
			</script>
            <?php
             }
                  
              }else{
                  echo "<font face='Verdana' size='2' color=red>$msg</font><br>"; 
              }
           }
       /*  } else{
             header("Location:login.php");
         }*/
        ?>
        
      <?php 
      $present_time = time();
      if( $_SESSION['last_activity'] < $present_time-$_SESSION['expire_time'] ) { //have we expired?
    //redirect to logout.php
               header('Location:logout.php'); //change yoursite.com to the name of you site!!
        } else{ //if we haven't expired:
        $_SESSION['last_activity'] = $present_time; //this was the moment of last activity.
        
      
      
      if ($_SESSION['username'] != ""){
         // echo " Last Activity ".$_SESSION['last_activity']." Expire time ".$_SESSION['expire_time'];
          ?> 
                        
        <div>
         
                <form action='pos.php' method='post' class="dark-matter">
                    <h1>Bulk voting Point Of Sales</h1> 
                    
                       <label>
                       <span>Amount</span>
                    
                        <input type="text" name="amount" size="5"> 
                       </label>
                       <label>
                   
                         <span>Category </span>
                   
                    	<select name="category">
                        	<option>Select Category</option>
                            <?php
                           // $g = mysql_query("select name from teams");
                           $g = mysql_query("select * from bam_categories order by id");
					while($id=mysql_fetch_array($g))
					{
                                            echo "<option value=".$id['id'].">".$id['category']."</option>";
                                        }
   							//	}
                            ?>
                        </select>
                    
                    </label>
                      <label>
                       <span>Nominee</span>
                    
                        <input type="text" name="nominee" size="5"> 
                       </label>
                       <label>
                     <span> MSISDN</span>
                      
                        <input type="text" name="msisdn" size="15"> 
                    
                       </label>
                    <label>
                        
                            <input type="submit"  class="button" name="cmdadd" value="Transact" />
                       
                   
                </label>
                    <lable>
                             <span>REPORT</span>
                        <a href="reports/individual_report.php">Check own report</a>
                    </lable>
                </form>
                
            </table>
            
            
        </div>
      <?php } else {
          header("Location:login.php");
        }
        
      }
        ?>
        
    </body>
</html>
