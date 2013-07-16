<?php
    class pacchetto{
    	
		var $cf_utente, $num_persone, $num_notti, $data, $id_pernottamento, $id_attrazioni, $id_trasporto, $id_destinazione;
    	
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
		 function setAttrazioni($id){
		 	$this->id_attrazioni = nl2br(htmlentities($id));
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
		 
		/*
		 * Metodi GET per gli attributi di pacchetto
		 */
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
		 	return $this->id_attrazioni;
		 }
		 function getTrasporto(){
		 	return $this->id_trasporto;
		 }
		 function getDestinazione(){
		 	return $this->id_trasporto;
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
			$sql = "INSERT INTO `tourdb`.`pacchetto` (`persone`, `durata`, `data_partenza`, `id_utente`, `id_pernottamento`, `id_attrazioni`, `id_trasporto`, `id_destinazione`) VALUES 
	 		('$this->num_persone', '$this->num_notti', '$this->data', '$this->cf_utente', '$this->id_pernottamento', '$this->id_attrazioni', '$this->id_trasporto', '$this->id_destinazione');";
			//Eseguo la query
			database::qInsertInto($conn,$sql);
			
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
			$this->setAttrazioni($record['id_attrazioni']);
			$this->setTrasporto($record['id_trasporto']);
			$this->setDestinazione($record['id_destinazione']);
			
			return true;
		 }
    }
?>