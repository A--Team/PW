<?php
  include_once 'database.php';
  $trasp_id=$_POST['trasp_id'];
  $conn = database::dbConnect();
  $sql="UPDATE trasporto SET visible='FALSE' WHERE id='".$trasp_id."'";
  database::qUpdate($conn,$sql);
?>   
