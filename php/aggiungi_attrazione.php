<?php
  include_once 'database.php';
  $id_attr=$_POST['id_attr'];
  $vettore_attrazioni=$_POST['vettore_attrazioni'];
  $vettore_attrazioni=explode(',', $vettore_attrazioni);
  
  $conn = database::dbConnect();
  $output="";
  if($vettore_attrazioni!=""){
    for($i=0;$i<count($vettore_attrazioni);$i++){
      $sql="SELECT id,tipo,prezzo FROM attrazioni WHERE id='".$vettore_attrazioni[$i]."'";
      $risposta=database::qSelect($conn,$sql);
      while($el=mysql_fetch_array($risposta)){
	$output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
      }
    }
  }
  $sql="SELECT id,tipo,prezzo FROM attrazioni WHERE id='".$id_attr."'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_array($risposta)){
    $output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
  }
  mysql_close($conn);
  echo $output;
?>  
 
