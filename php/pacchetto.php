<?php
	/*
		classe che si occupa di stamapare a video le anteprime dei pacchetti. Al costruttore bisogna passare una stringa con scritto che tipo
		di paccheti bisogna visualizzare.
		tutti=visualizza tutti i pacchetti;
		mirata=visualizza i pacchetti della pubblicità mirata
		wish=visualizza i pacchetti della wish_list
	*/
	//Imposto localizzazione italiana per la visualizzazione delle date
	setlocale(LC_TIME, 'ita', 'it_IT.utf8');
	
    class pacchetto{    	
		
		var $pacchetti;
		/*
		 * Costruttore dell'oggetto pacchetto
		 */

		 function pacchetto($tipo_pacchetto,$parametri){
		 	include_once 'database.php';
			include 'config.php';
			
			$conn=database::dbConnect();
			if(isset($_SESSION[$session_name]))
				$user=$_SESSION['username'];
			$today=getdate();
			$data_corrente=$today['year']."-".$today['mon']."-".$today['mday'];
			extract($parametri);
			
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
					WHERE pacchetto.data_partenza>'".$data_corrente."' AND pacchetto.id_utente='agenzia' AND pernottamento.id=pacchetto.id_pernottamento 
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
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione AND pacchetto.prenotato=FALSE AND destinazione.visible=TRUE";
					break;
					}
				case 'storico':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='".$user."' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione AND pacchetto.prenotato=TRUE
					AND pacchetto.data_partenza < NOW()";
					break;
					}
				case 'ordini':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='".$user."' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione AND pacchetto.prenotato=TRUE
					AND pacchetto.data_partenza >= NOW()";
					break;
					}
				case 'home':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.sconto>0 AND pacchetto.id_utente='agenzia' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione 
					AND pacchetto.data_partenza>'".$data_corrente."'";
					break;
					}
				case 'catalogo':{
					$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pacchetto.id_utente='agenzia' AND pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione
					AND pacchetto.data_partenza>'".$data_corrente."'";
					break;
					}
				case 'ricerca':
					{
						$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
					pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
					destinazione.foto
					FROM pacchetto,pernottamento,trasporto,destinazione 
					WHERE pernottamento.id=pacchetto.id_pernottamento 
					AND trasporto.id=pacchetto.id_trasporto AND destinazione.id=pacchetto.id_destinazione 
					AND pacchetto.id IN (SELECT id FROM pacchetto 
					WHERE id_utente='agenzia' AND persone='".$npersons."' AND durata<='".$duration."' 
					AND data_partenza BETWEEN DATE('".$data_partenza1."')	AND DATE('".$data_partenza2."')
					AND id_destinazione='".$city."')";
					break;
					}				
		}
			$this->pacchetti=database::qSelect($conn,$query);			
			database::dbClose();
			return true;
		 }
		 
		 function isEmpty(){
		 	if(mysql_num_rows($this->pacchetti)==0)
		 		return true;
			else 				
				return false;
		 }
		 		 
		 function stampa($tipo=null)
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
					$costo = ($prezzo_pernottamento*$durata*$persone + $prezzo_trasporto*$persone)*(1-$sconto);
					foreach($prezzo_attr as $p)
					{
						$costo = $costo + $p;
					}
					//Imposto il link da richiamare al click su un pacchetto
					switch ($tipo) {
						case 'storico':
							$link = "./commenti.php?citta=".urlencode($citta);
							break;						
						default:
							$link = "modifica.php?id_pacchetto=$id";
							break;
					}
					$html = "
							<div style='float:left'>
							<a href=$link>
							<div class='div_viaggio'>
								<p class='dest_viaggio'>
									".$citta."
									<div class='div_foto_viaggio'>
										<img src=./style/images/dest/".$foto." width=200px height=150px>
									</div> 
								</p>
								<p>
								Viaggio di ".$durata." notti per ".$persone." persona/e.<br>
								<span class='carat_viaggio'>Partenza il:</span>&nbsp;".strftime("%d %B %Y",strtotime($data_partenza)).".<br>
								<span class='carat_viaggio'>Trasporto:</span>&nbsp;". $tipo_trasporto."<br>
								<span class='carat_viaggio'>Pernottamento:</span>&nbsp;". $tipo_pernottamento."<br>
								<span class='costo_viaggio'>A soli:&nbsp;". $costo." € ";
					if($sconto!=0)
						$html.="(".($sconto*100)."% di sconto!)";
					$html .= "
								</span>
								</p>
							</div></a>";
					echo $html;
					if($tipo=="elimina"){
						$html = "<br><input style='margin-left:30px; margin-bottom:15px;' type='button' class='btn_commenta' value='Elimina' onclick=elimina(this,".$id.")></div>";
						echo $html;
					}
					else{
						echo "</div>";
					}
				}
				database::dbClose();
		 }
		 
		 
    }
?>