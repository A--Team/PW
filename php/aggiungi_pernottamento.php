<?php
  include_once 'database.php';
  $dest_id=$_POST["dest_id"];
  $tipologia=mysql_real_escape_string(trim($_POST["tipologia"]));
  $prezzo=mysql_real_escape_string(trim($_POST["prezzo"]));

  $conn = database::dbConnect();
  $sql="INSERT INTO pernottamento (prezzo,tipo,id_destinazione) VALUES('".$prezzo."','".$tipologia."','".$dest_id."')";
  database::qInsertInto($conn,$sql);
  mysql_close($conn);
?>  
