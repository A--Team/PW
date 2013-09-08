<?php
  include_once 'database.php';
  $dest_id=$_POST['dest_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT descrizione FROM destinazione WHERE id='".$dest_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["descrizione"];
  }
  mysql_close($conn);
  echo $output;
?>     
