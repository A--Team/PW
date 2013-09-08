<?php
  include_once 'database.php';
  $id=$_POST['id'];
  $conn = database::dbConnect();
  $query="DELETE FROM pacchetto WHERE id='".$id."'";
  database::qDelete($conn,$query);
  database::dbClose();
?>   
