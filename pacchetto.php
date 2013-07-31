<?php
    class pacchetto extends database{
    	
		var $id_pacchetto, $cf_utente, $num_persone, $num_notti, $data_partenza, $id_pernottamento, $attrazioni, $id_trasporto, $id_destinazione, 
				$prenotato,$costo,$foto,$citta,$tipo_trasporto,$tipo_pernottamento;
    	
		/*
		 * Costruttore dell'oggetto pacchetto
		 */
		 function pacchetto($record,$attrazioni){
		 		$this->id_pacchetto = $record['id'];
    			$this->num_persone = $record['persone'];
				$this->num_notti = $record['durata'];
				$this->data_partenza = $record['data_partenza'];
				$this->id_pernottamento = $record['id_pernottamento'];
				$this->id_trasporto = $record['id_trasporto'];
				$this->id_destinazione = $record['id_destinazione'];
				$this->tipo_pernottamento = $record['tipo_pernottamento'];
				$prezzo_pernottamento = $record['prezzo_pernottamento'];
				$this->tipo_trasporto = $record['tipo_trasporto'];
				$prezzo_trasporto = $record['prezzo_trasporto'];
				$this->citta = $record['citta'];
				$this->foto = $record['foto'];
				$prezzo_attr = array();
				while($record_attr = mysql_fetch_array($attrazioni))
				{
					$prezzo_attr[] = $record_attr['prezzo'];					
				}
				
				//Calcolo il costo totale
				$this->costo = $prezzo_pernottamento*$this->num_notti*$this->num_persone + $prezzo_trasporto*$this->num_persone;
				foreach($prezzo_attr as $p)
				{
					$this->costo = $this->costo + $p;
				}
			return true;
		 }
		 
		 function stampa()
		 {
			$html = "
					<a href='modifica.php?id_pacchetto=".$this->id_pacchetto."'>
					<div class='div_viaggio'>
						<p class='dest_viaggio'>
							".$this->citta."
							<div class='div_foto_viaggio'>
								<img src=./style/images/dest/".$this->foto." width=200px height=150px>
							</div> 
						</p>
						<p>
						Viaggio di ".$this->num_notti." notti per ".$this->num_persone." persona/e.<br>
						<span class='carat_viaggio'>Partenza il:</span> ".$this->data_partenza.".<br>
						<span class='carat_viaggio'>Trasporto:</span>". $this->tipo_trasporto."<br>
						<span class='carat_viaggio'>Pernottamento:</span>". $this->tipo_pernottamento."<br>
						<span class='costo_viaggio'>A soli:". $this->costo." €</span>
						</p>
					</div></a>";
			echo $html;	
		 }
    }
?>