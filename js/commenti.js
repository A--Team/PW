/**
 * @author Matteo
 */

/*
 * Funzione che invia la richiesta per l'eliminazione di un commento
 */
var btn;

function sendDelete(e,id){
	var risposta = confirm("Vuoi davvero eliminare questo commento?");
	if(risposta==true){
		xmlHttp = new XMLHttpRequest();
		var url = "exec_commenti.php";
		xmlHttp.onreadystatechange = stateChange;	
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		var post_string = "id_comm="+id;
		btn = event.target || event.srcElement;	
		xmlHttp.send(post_string);
	}
}

/*
 * Funzione di callback da eseguire una volta ricevuta la risposta
 */
function stateChange(){
	if(xmlHttp.readyState == 4){
		//Elimino il div padre del pulsante
		var parent_div = btn.parentNode;
		while(parent_div.hasChildNodes()) {
    		parent_div.removeChild(parent_div.lastChild);
		}
	}
}
