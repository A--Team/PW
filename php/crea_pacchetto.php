<?php
  include_once 'database.php';
  $npersons=$_POST["npersons"];
  $duration=$_POST["duration"];
  $datepicker=$_POST["datepicker"];
  $sconto=$_POST["sconto"];
  $pernottamento=$_POST["pernottamento"];
  $trasporto=$_POST["trasporto"];
  $city=$_POST["city"];
  $vettore_attrazioni=$_POST['vettore_attrazioni'];
  $vettore_attrazioni=explode(',', $vettore_attrazioni);
  
  $conn = database::dbConnect();
  $sql="INSERT INTO pacchetto (persone,durata,data_partenza,id_utente,id_pernottamento,id_trasporto,id_destinazione,prenotato,sconto)
  VALUES ('".$npersons."','".$duration."',DATE('".$datepicker."'),'agenzia','".$pernottamento."','".$trasporto."','".$city."','0','".$sconto."')";
  database::qInsertInto($conn,$sql);
  $sql="SELECT MAX(id) FROM pacchetto WHERE id_utente='agenzia'";
  $risposta=database::qSelect($conn,$sql);
  while($el=mysql_fetch_row($risposta)){
    $id_pack=$el['0'];
  }
  if(count($vettore_attrazioni)>0){
    foreach($vettore_attrazioni as $id_attr){
      $sql="INSERT INTO rel_attrazioni (id_pacchetto,id_attrazione) VALUES ('".$id_pack."','".$id_attr."')";
      database::qInsertInto($conn,$sql);
    }
  }
  mysql_close($conn);
  echo "Il pacchetto è stato creato. Clicca <a href='agenzia.php'>qui</a> per visualizzare i pacchetti.";
?>
