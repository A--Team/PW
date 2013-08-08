/**
 * Classe che implementa AJAX per la pagina 'wish_list.php'
 */

/*
 * Funzione che gestisce l'eliminazione di un pacchetto
 */
function elimina(e,id){
	var risposta = confirm("Vuoi davvero eliminare questo pacchetto dalla tua wish list?");
	if(risposta==true){
		xmlHttp = new XMLHttpRequest();
		var url = "del_wish.php";
		xmlHttp.onreadystatechange = eliminaStateChange;	
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		var post_string = "id="+id;
		btn = event.target || event.srcElement;	
		xmlHttp.send(post_string);
	}
}

/*
 * Funzione di callback da eseguire una volta ricevuta la conferma dell'eliminazione del pacchetto
 */
function eliminaStateChange(){
	if(xmlHttp.readyState == 4 && xmlHttp.status==200){
		//Elimino il div padre del pulsante
		var parent_div = btn.parentNode;
		$(parent_div).fadeOut('slow');		
	}
}