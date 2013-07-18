<?php
    class pacchetto{
    	
		var $id, $cf_utente, $num_persone, $num_notti, $data, $id_pernottamento, $attrazioni, $id_trasporto, $id_destinazione, $prenotato;
    	
		/*
		 * Costruttore dell'oggetto pacchetto
		 */
		 function __construct($cf){
		 	$this->cf_utente = $cf;
			return true;
		 }
		 
		/*
		 * Metodi SET per gli attributi di pacchetto
		 */		 
		 function setCF($cf){
		 	$this->cf_utente = nl2br(htmlentities($cf));
			return true;
		 }
		 function setNumPersone($num){
		 	$this->num_persone = nl2br(htmlentities($num));
			return true;
		 }
		 function setDurata($notti){
		 	$this->num_notti = nl2br(htmlentities($notti));
			return true;
		 }
		 function setDataPartenza($data){
		 	$this->data = nl2br(htmlentities($data));
			return true;
		 }
		 function setPernottamento($id){
		 	$this->id_pernottamento = nl2br(htmlentities($id));
			return true;
		 }
		 function addAttrazioni($id){
		 	$this->attrazioni[] = nl2br(htmlentities($id));
			return true;
		 }
		 function setTrasporto($id){
		 	$this->id_trasporto = nl2br(htmlentities($id));
			return true;
		 }
		 function setDestinazione($id){
		 	$this->id_destinazione = nl2br(htmlentities($id));
			return true;
		 }
		 function setPrenotato($bool){
		 	$this->prenotato = nl2br(htmlentities($bool));
		 }
		 
		/*
		 * Metodi GET per gli attributi di pacchetto
		 */
		 function getID(){
		 	return $this->id;
		 }
		 function getCF(){
		 	return $this->cf_utente;
		 }
		 function getNumPersone(){
		 	return $this->num_persone;
		 }
		 function getDurata(){
		 	return $this->num_notti;
		 }
		 function getDataPartenza(){
		 	return $this->data;
		 }
		 function getPernottamento(){
		 	return $this->id_pernottamento;
		 }
		 function getAttrazioni(){
		 	return $this->attrazioni;
		 }
		 function getTrasporto(){
		 	return $this->id_trasporto;
		 }
		 function getDestinazione(){
		 	return $this->id_trasporto;
		 }
		 function getPrenotato(){
		 	return $this->prenotato;
		 }
		 
		/*
		 * Metodi per il salvataggio e il caricamento del pacchetto dal DB
		 */
		 function salvaPacchetto(){
		 	//Carico script di interfaccia al database
    		include_once 'database.php';
			//Creo la connessione al database
			$conn = database::dbConnect();
			//Preparo la query di inserimento
			$sql = "INSERT INTO `tourdb`.`pacchetto` (`persone`, `durata`, `data_partenza`, `id_utente`, `id_pernottamento`, `id_attrazioni`, `id_trasporto`, `id_destinazione`, `prenotato`) VALUES 
	 		('$this->num_persone', '$this->num_notti', '$this->data', '$this->cf_utente', '$this->id_pernottamento', '$this->id_attrazioni', '$this->id_trasporto', '$this->id_destinazione','$this->prenotato');";
			//Eseguo la query
			database::qInsertInto($conn,$sql);
			
			//Salvo l'elenco delle attrazioni selezionate
			//Creo la connessione al database
			$conn = database::dbConnect();
			//Preparo la query di inserimento
			$att = $this->getAttrazioni();
			for ($i=0; $i<$att.length ; $i++) { 
				$sql = "INSERT INTO `rel_attrazioni`(`id_pacchetto`, `id_attrazione`) VALUES (" . $this->getID() . "," . $att[i] .")";
				//Eseguo la query
				database::qInsertInto($conn,$sql);
			}
			mysql_close();
			
			return true;
		 }
		 function caricaPacchetto($id){
		 	//Carico script di interfaccia al database
    		include_once 'database.php';
			//Creo la connessione al database
			$conn = database::dbConnect();
			//Preparo la query di selezione
			$sql = "SELECT * FROM `pacchetto` WHERE `id` = '$id'";
			$result = database::qSelect($conn, $sql);
            $record = mysql_fetch_array($result);
            mysql_close();		
			
			//Popolo il pacchetto con i dati prelevati dal database
			$this->setCF($record['id_utente']);
			$this->setNumPersone($record['persone']);
			$this->setDurata($record['durata']);
			$this->setDataPartenza($record['data_partenza']);
			$this->setPernottamento($record['id_pernottamento']);			
			$this->setTrasporto($record['id_trasporto']);
			$this->setDestinazione($record['id_destinazione']);
			$this->setPrenotato($record['prenotato']);
			
			//Popolo il pacchetto con l'elenco delle attrazioni selezionate
			//Creo la connessione al database
			$conn = database::dbConnect();
			//Preparo la query di selezione
			$sql = "SELECT `id_attrazione` FROM `rel_attrazioni` WHERE `id_pacchetto` = '$id'";
			$result = database::qSelect($conn, $sql);                      
            while ($record = mysql_fetch_array($result)) {
                $this->addAttrazioni($record['id_attrazione']);
            }            
			mysql_close();
			
			return true;
		 }
    }
?>