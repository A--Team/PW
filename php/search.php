<?php
  //Riceve in ingresso tramite 'post' i parametri di ricerca e restituisce i pacchetti che sodddisfano i parametri come ID (del pacchetto).  
  include 'pacchetto.php';
  $pacchetti=new pacchetto('ricerca',$_POST);
  if($pacchetti->isEmpty())
	echo "<h3>Nessun risultato trovato</h3>";
  else
	$pacchetti->stampa();
?>