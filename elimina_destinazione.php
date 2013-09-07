<?php
  include_once 'database.php';
  $dest_id=$_POST['dest_id'];
  $conn = database::dbConnect();
  $sql="UPDATE destinazione SET visible='FALSE' WHERE id='".$dest_id."'";
  database::qUpdate($conn,$sql);
  mysql_close($conn);
?>    
