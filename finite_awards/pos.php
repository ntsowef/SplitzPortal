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
        <title>Splitz Bulk POS</title>
        <link href="css/tables_form.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" >
           $(document).ready(function($) {
        var list_target_id = 'nominee'; //first select list ID
        var list_select_id = 'category'; //second select list ID
        var initial_target_html = '<option value="">Please select a categories...</option>'; //Initial prompt for target select

        //$('#'+list_target_id).html(initial_target_html); //Give the target select the prompt option

        $('#category').change(function(e) {
          //Grab the chosen value on first select list change
          var selectvalue = $(this).val();
          var dataString = 'category='+selectvalue;
           // alert (selectvalue);             
          //Display 'loading' status in the target select list
          $('#nominee').html('<option value="">Loading...</option>');

          if (selectvalue == "") {
              //Display initial prompt in target select if blank value selected
             $('#nominee').html(initial_target_html);
          } else {
            //Make AJAX request, using the selected value as the GET
            $.ajax({
                    type: "POST",
                    url: "get_nominees.php",
                    data: dataString,
                    cache: false,
                  // url: 'get_nominees.php?category_code='+selectvalue,
                   success: function(output) {
                   //   alert(output);
                      $('#nominee').html(output);
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + " "+ thrownError);
                }});
              }
          });
      });

        </script>
        
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
              echo $nominee;
              if ($status == "Ok"){
                 if (strlen($msisdn)==8){
                     $msisdn = "+266".$msisdn;
                 }
                     
                 $base_price = 2.00;
                  
                 $num_votes = round($amount/$base_price);
                 
               //  echo  "number of votes for this number are ".$num_votes."<br>";
                 
              $query = "INSERT INTO uma_votes_transaction (id,user_id,date_loggedin,msisdn,nominee,cash_received,votes_allocated, category)VALUES('','$username',NOW(),'$msisdn','$nominee','$amount','$num_votes','$category')";
                 // echo ''.$query;
              $ey = mysql_query($query);
              
              $select = "SELECT * from mobile_poll_shortcode where id='$category'";
              
              $result = mysql_query($select);
              $arr = mysql_fetch_array($result);
              $team_id = $arr['id'];
              
              
              $ii = 0;
              while ($ii < $num_votes){
              
             $query = "INSERT INTO uma_bulk_votes_queue (id, msisdn, nominee, category_code, date_voted) VALUES(id,'$msisdn','$nominee','$category',NOW()) ";
             // echo $query;
             $eye =  mysql_query($query);
              $ii++;
              }
              $message = $num_votes." votes were allocated to ".$nominee.", in the Finite WO MEN AWARDS. Continue to vote to support your candidate.";
              $query1="INSERT INTO bulkmessages(id, message, msisdn, queued, message_date, company, username)
                                    VALUES('','$message','$msisdn', 'Q',now(),'BAM','Thabang')";
              $eyee =  mysql_query($query1);
               
      // echo $query;
            if(($ey==true)){
           
             ?>
                        <script language = "javascript" type = "text/javascript"> 
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
                   
                    	<select name="category" id="category">
                        	<option>Select Category</option>
                            <?php
                           // $g = mysql_query("select name from teams");
                           $g = mysql_query("select * from ultimate_categories order by id");
					while($id=mysql_fetch_array($g))
					{
                                            echo "<option value=".$id['category_code'].">".$id['category']."</option>";
                                        }
   							//	}
                            ?>
                        </select>
                    
                    </label>
                      <label>
                       <span>Nominee</span>
                    
                       <select name="nominee" id="nominee"></select>
                      
                      
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
