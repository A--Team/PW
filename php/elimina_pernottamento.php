<?php
  include_once 'database.php';
  $pern_id=$_POST['pern_id'];
  $conn = database::dbConnect();
  $sql="UPDATE pernottamento SET visible='FALSE' WHERE id='".$pern_id."'";
  database::qUpdate($conn,$sql);
?>   
 
