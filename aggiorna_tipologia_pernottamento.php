<?php
  include_once 'database.php';
  $pern_id=$_POST['pern_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT tipo FROM pernottamento WHERE id='".$pern_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["tipo"];
  }
  mysql_close($conn);
  echo $output;
?> 
