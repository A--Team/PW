<?php
  include_once 'database.php';
  $id_attr=$_POST['id_attr'];
  $vettore_attrazioni=$_POST['vettore_attrazioni'];
  $vettore_attrazioni=explode(',', $vettore_attrazioni);
  $conn = database::dbConnect();
  $output="";
  foreach($vettore_attrazioni as $id){
    if($id!=$id_attr){
      $sql="SELECT id,tipo,prezzo FROM attrazioni WHERE id='".$id."'";
      $risposta=database::qSelect($conn,$sql);
      while($el=mysql_fetch_array($risposta)){
	$output=$output."<option value=".$el["id"].">".$el["tipo"]."-".$el["prezzo"]."</option>";
      }
    }
  }
  mysql_close($conn);
  echo $output;
?>  