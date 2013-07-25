<?php
  //Riceve in ingresso tramite 'post' i parametri di ricerca e restituisce i pacchetti che sodddisfano i parametri come ID (del pacchetto). 
  include_once 'database.php';
  $continent=$_POST['continent'];
  $city=$_POST['city'];
  $type=$_POST['type'];
  $duration=$_POST['duration'];
  $npersons=$_POST['npersons'];
  
  $conn = database::dbConnect();  
  if($duration==2)
    $sql="SELECT * FROM pacchetto WHERE id_utente='0' AND persone='".$npersons."' AND durata<='3'";
  else if($duration==3)
    $sql="SELECT * FROM pacchetto WHERE id_utente='0' AND persone='".$npersons."' AND durata>'3'";
  else
    $sql="SELECT * FROM pacchetto WHERE id_utente='0' AND persone='".$npersons."'";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
      $sql_dest="SELECT * FROM destinazione WHERE id='".$el["id_destinazione"]."'";
      $risposta_dest=database::qSelect($conn,$sql_dest);
      $dest=mysql_fetch_array($risposta_dest);
      if($dest["continente"]==$continent && $dest["citta"]==$city && $dest["tipo"]==$type)
	$output=$output."<br>".$el["id"];
  }
  mysql_close($conn);
  if(strlen($output)>0)
    echo $output;
  else 
    echo "Nessun pacchetto trovato!";
?>
