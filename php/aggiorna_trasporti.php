<?php
  include_once 'database.php'; 
  $conn = database::dbConnect();
  $sql="SELECT id,tipo,prezzo FROM trasporto WHERE visible='1'";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?>  