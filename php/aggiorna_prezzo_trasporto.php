<?php
  include_once 'database.php';
  $trasp_id=$_POST['trasp_id'];
    
  $conn = database::dbConnect();
  $sql="SELECT prezzo FROM trasporto WHERE id='".$trasp_id."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$el["prezzo"];
  }
  mysql_close($conn);
  echo $output;
?> 
