<?php
  include_once 'database.php';
  $tipo=mysql_real_escape_string(trim($_POST['tipo']));
  $prezzo=mysql_real_escape_string(trim($_POST['prezzo']));
  $pern_id=$_POST['pern_id'];
  $conn = database::dbConnect();
  $sql="UPDATE pernottamento SET tipo='".$tipo."',prezzo='".$prezzo."' WHERE id='".$pern_id."'";
  database::qUpdate($conn,$sql);
  mysql_close($conn);
?>  
