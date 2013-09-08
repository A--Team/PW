<?php
  include_once 'database.php';
  $trasp_id=$_POST['trasp_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT tipo FROM trasporto WHERE id='".$trasp_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["tipo"];
  }
  mysql_close($conn);
  echo $output;
?>
 
