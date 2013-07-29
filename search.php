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
    $sql="SELECT * FROM pacchetto WHERE id_utente='agenzia' AND persone='".$npersons."' AND durata<='3'";
  else if($duration==3)
    $sql="SELECT * FROM pacchetto WHERE id_utente='agenzia' AND persone='".$npersons."' AND durata>'3'";
  else
    $sql="SELECT * FROM pacchetto WHERE id_utente='agenzia' AND persone='".$npersons."'";
  $risposta=database::qSelect($conn,$sql);
  $output="";
  while($el=mysql_fetch_array($risposta)){
      $sql_dest="SELECT * FROM destinazione WHERE id='".$el["id_destinazione"]."'";
      $risposta_dest=database::qSelect($conn,$sql_dest);
      $dest=mysql_fetch_array($risposta_dest);
      if($dest["continente"]==$continent && $dest["citta"]==$city && $dest["tipo"]==$type){
	//trasporto
	$sql_trasp = "SELECT * FROM trasporto WHERE id='".$el["id_trasporto"]."'";
	$risposta_trasp = database::qSelect($conn, $sql_trasp);
	$trasp= mysql_fetch_array($risposta_trasp);
	//pernottamento
	$sql_pern = "SELECT * FROM pernottamento WHERE id='".$el["id_pernottamento"]."'";
	$risposta_pern = database::qSelect($conn, $sql_pern);
	$pern= mysql_fetch_array($risposta_pern);

	//creo il codice html dei pacchetti
	$costo = $pern["prezzo"]*$el["durata"]*$el["persone"] + $trasp["prezzo"]*$el["persone"];
	$output=$output.
	"
	  <div class='div_viaggio'>
		  <p class='dest_viaggio'>".$dest["citta"]."
			  <div class='div_foto_viaggio'>
				  <img src=./style/images/dest/".$dest["foto"].">
			  </div> 
		  </p>
		  <p>
		  Viaggio di ".$el["durata"]." notti per ".$el["persone"]." persona/e.<br>
		  <span class='carat_viaggio'>Partenza il:</span>".$el["data_partenza"].".<br>
		  <span class='carat_viaggio'>Trasporto:</span>". $trasp["tipo"]."<br>
		  <span class='carat_viaggio'>Pernottamento:</span>".$pern["tipo"]."<br>
		  <span class='costo_viaggio'>A soli: ".$costo."€</span>
		  </p>
	  </div>";
      }
  }
  mysql_close($conn);
  if(strlen($output)>0)
    echo $output;
  else 
    echo "Nessun pacchetto trovato!";
?>
