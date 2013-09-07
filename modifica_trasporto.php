<?php
  include_once 'database.php';
  $tipo=mysql_real_escape_string(trim($_POST['tipo']));
  $prezzo=mysql_real_escape_string(trim($_POST['prezzo']));
  $trasp_id=$_POST['trasp_id'];
  $conn = database::dbConnect();
  $sql="UPDATE trasporto SET tipo='".$tipo."',prezzo='".$prezzo."' WHERE id='".$trasp_id."'";
  database::qUpdate($conn,$sql);
  mysql_close($conn);
?>   
