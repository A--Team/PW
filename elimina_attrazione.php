<?php
  include_once 'database.php';
  $attr_id=$_POST['attr_id'];
  $conn = database::dbConnect();
  $sql="UPDATE attrazioni SET visible='FALSE' WHERE id='".$attr_id."'";
  database::qUpdate($conn,$sql);
  mysql_close($conn);
?>   