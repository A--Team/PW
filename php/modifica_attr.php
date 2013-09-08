<?php
  include_once 'database.php';
  $tipo=mysql_real_escape_string(trim($_POST['tipo']));
  $prezzo=mysql_real_escape_string(trim($_POST['prezzo']));
  $attr_id=$_POST['attr_id'];
  
  $conn = database::dbConnect();
  $sql="UPDATE attrazioni SET tipo='".$tipo."',prezzo='".$prezzo."' WHERE id='".$attr_id."'";
  database::qUpdate($conn,$sql);
  mysql_close($conn);
?>   
