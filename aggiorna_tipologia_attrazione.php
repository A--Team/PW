<?php
  include_once 'database.php';
  $attr_id=$_POST['attr_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT tipo FROM attrazioni WHERE id='".$attr_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["tipo"];
  }
  mysql_close($conn);
  echo $output;
?>  
