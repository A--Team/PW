<?php
  include_once 'database.php';
  $continent=$_POST['continent'];
  
  $conn = database::dbConnect();
  $sql="SELECT citta FROM destinazione WHERE continente='".$continent."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    echo "<option value=".$el["citta"].">".$el["citta"]."</option>";
  }
?>
