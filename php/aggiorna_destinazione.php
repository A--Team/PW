<?php
  include_once 'database.php';
  $cont=$_POST['cont'];
  
  $conn = database::dbConnect();
  $sql="SELECT id,citta,tipo FROM destinazione WHERE visible='1' AND continente='".$cont."'";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["citta"]."-".$el["tipo"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?> 
