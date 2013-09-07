<?php
  include_once 'database.php';
  $dest_id=$_POST['dest_id'];
  
  $conn = database::dbConnect();
  $sql="SELECT id,tipo,prezzo FROM pernottamento WHERE visible=1 AND id_destinazione='".$dest_id."'";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
  }
  mysql_close($conn);
  
  echo $output;
?> 
