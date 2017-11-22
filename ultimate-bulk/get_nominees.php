<?php


include "connect.php";

$category = $_POST['category'];

echo $category;
$sql = "SELECT * FROM ultimate_nominees WHERE category_code='$category'";
$result = mysql_query($sql);
echo $sql; 
echo '<option value="">Please select...</option>';
while($row = mysql_fetch_array($result))
  {   $nominee = trim($row['first_name'])." ".trim($row['surname'])

    echo "".$nominee."".PHP_EOL;
   // echo '<option value="'.$row['allocate_code'].'">' . $row['nominee'] . "</option>";
    echo '<option value="'.$nominee.'">' . $nominee."</option>";
  //  echo $row['allocate_code'] ."<br/>";
  }
 
mysqli_free_result($result);