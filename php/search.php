<?php
  //Riceve in ingresso tramite 'post' i parametri di ricerca e restituisce i pacchetti che sodddisfano i parametri come ID (del pacchetto).  
  include 'pacchetto.php';
  $pacchetti=new pacchetto('ricerca',$_POST);
  $pacchetti->stampa();
?>