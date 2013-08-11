<?php
  include_once 'database.php';
  $continent=$_POST['continent'];
  
  $conn = database::dbConnect();
  $sql="SELECT id,citta FROM destinazione WHERE continente='".$continent."'";
  $risposta=database::qSelect($conn,$sql);
  $output='<option value="" disabled selected>Seleziona citta</option>';
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["citta"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?>
