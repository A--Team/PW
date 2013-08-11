<?php
  include_once 'database.php';
  $conn = database::dbConnect();
  $sql="SELECT id,citta,tipo FROM destinazione";
  $risposta=database::qSelect($conn,$sql);
  $output='<option value="" disabled selected>Seleziona destinazione</option>';
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["citta"]."-".$el["tipo"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?> 
