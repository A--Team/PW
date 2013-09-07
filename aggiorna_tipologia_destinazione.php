<?php
  include_once 'database.php';
  $dest_id=$_POST['dest_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT tipo FROM destinazione WHERE id='".$dest_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["tipo"];
  }
  mysql_close($conn);
  echo $output;
?>     
