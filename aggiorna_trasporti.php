<?php
  include_once 'database.php';
  error_reporting(E_ALL);
  ini_set('display_errors', 1);  
  $conn = database::dbConnect();
  $sql="SELECT id,tipo,prezzo FROM trasporto";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?>  