<?php
	/*
		classe che si occupa di stamapare a video le anteprime dei pacchetti. Al costruttore bisogna passare una stringa con scritto che tipo
		di paccheti bisogna visualizzare.
		tutti=visualizza tutti i pacchetti;
		mirata=visualizza i pacchetti della pubblicità mirata
		wish=visualizza i pacchetti della wish_list
	*/



    class pacchetto{
    	
		var $pacchetti;
		/*
		 * Costruttore dell'oggetto pacchetto
		 */
		 function pacchetto($tipo_pacchetto){
		 	include 'database.php';
			
			$conn=database::dbConnect();
			$user=$_SESSION['username'];
			
			switch($tipo_pacchetto)
			{
				case 'tutti':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='".$user."' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione";
					break;
					}
				case 'mirata':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto 
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='agenzia' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione AND pacchetto.id_destinazione 
					IN	(SELECT destinazione.id FROM destinazione WHERE tipo=(SELECT destinazione.tipo 
						FROM destinazione WHERE destinazione.id IN 
						(SELECT pacchetto.id_destinazione FROM pacchetto WHERE pacchetto.id_utente='".$user."') 
						GROUP BY destinazione.tipo ORDER BY count(destinazione.tipo) DESC LIMIT 1))";
					break;
					}
				case 'wish':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='".$user."' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione AND pacchetto.prenotato=FALSE";
					break;
					}
		}
			$this->pacchetti=database::qSelect($conn,$query);
			database::dbClose();	
			return true;
		 }
		 
		 function stampa()
		 {
				$conn=database::dbConnect();
				
				while($pacchetto=mysql_fetch_array($this->pacchetti))
				{
					extract($pacchetto);
					$prezzo_attr = array();
					$query="SELECT prezzo FROM attrazioni WHERE id IN (SELECT id_attrazione FROM rel_attrazioni 
							WHERE id_pacchetto='".$id."')";
					$attrazioni=database::qSelect($conn,$query);
					while($record_attr = mysql_fetch_array($attrazioni))
					{
						$prezzo_attr[] = $record_attr['prezzo'];					
					}
					
					//Calcolo il costo totale
					$costo = $prezzo_pernottamento*$durata*$persone + $prezzo_trasporto*$persone;
					foreach($prezzo_attr as $p)
					{
						$costo = $costo + $p;
					}
					$html = "
							<a href='modifica.php?id_pacchetto=".$id."'>
							<div class='div_viaggio'>
								<p class='dest_viaggio'>
									".$citta."
									<div class='div_foto_viaggio'>
										<img src=./style/images/dest/".$foto." width=200px height=150px>
									</div> 
								</p>
								<p>
								Viaggio di ".$durata." notti per ".$persone." persona/e.<br>
								<span class='carat_viaggio'>Partenza il:</span> ".$data_partenza.".<br>
								<span class='carat_viaggio'>Trasporto:</span>". $tipo_trasporto."<br>
								<span class='carat_viaggio'>Pernottamento:</span>". $tipo_pernottamento."<br>
								<span class='costo_viaggio'>A soli:". $costo." €</span>
								</p>
							</div></a>";
					echo $html;
				}
				database::dbClose();
		 }
    }
?>