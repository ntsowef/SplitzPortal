<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
           <form action="insert_poll_shortcode.php" method="post">   
               <h2>Choose ShortCode</h2>
               <table  align="center" style="margin: 0px auto;" width="450px">
                   <tr>
                    <td>Shortcode:</td>
                    <td>
                    	<select name="shortcode">
                        	<option>Select shortcode</option>
                            <?php
                            $poll_id = $_REQUEST['poll_id'];
                            $company = $_REQUEST['company'];
                            include ("connect.php");
                            $g = mysql_query("select shortcode from shortcodes");
					while($id=mysql_fetch_array($g))
					{
                                            echo "<option>".$id[0]."</option>";
                                        }
   							//	}
                            ?>
                        </select>
                    </td>
        		</tr>
                         <tr>
	 <td colspan="4" align="center">
             
	
	 <input type="submit" name="Submit" value="Submit">
	  </td>
    
	  </tr>
               </table>
               <input type="hidden" name="company" value="<?php echo $company;?>">
               <input type="hidden" name="poll_id" value="<?php echo $poll_id;?>">
           </form>  
    
    </body>
</html>
