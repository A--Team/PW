/**
 * @author Matteo
 */

/*
 * Funzione che invia la richiesta per l'eliminazione di un commento
 */
var btn;
var glob_user;
var glob_dest;
var glob_commento;
var glob_voto;
/*
 * Funzione che gestisce l'invio di un commento
 */
function sendComment(dest,user){
	glob_dest = dest;
	glob_user = user;
	glob_commento = document.form_commento.commento.value;
	glob_voto = document.form_commento.voto.value;
	xmlHttp = new XMLHttpRequest();
	var url = "send_commento.php";
	xmlHttp.onreadystatechange = sendStateChange;	
	xmlHttp.open("POST",url,true);
	xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	var post_string = "id_dest="+dest+"&id_user="+user+"&commento="+glob_commento+"&voto="+glob_voto;		
	xmlHttp.send(post_string);
}

/*
 * Funzione di callback a eseguire una volta ricevuta la conferma dell'inserimento del commento
 */
function sendStateChange(){	
	if (xmlHttp.readyState==4 && xmlHttp.status==200){
		alert("Commento inserito con successo!");
		location.reload();
		
		/*
		var str = glob_user+";"+glob_dest+";"+glob_commento+";"+glob_voto+"--";
		alert(str);
		var data="oggi";
		var output = "<br><div>";
		output += "<span class='tit_commento'>$user - "+data+"</span>";					
		output += "<div class='rateit' data-rateit-value=$rating data-rateit-ispreset='true' data-rateit-readonly='true'></div><br>";					
		output += "<div class='corpo_commento'>$corpo</div>";
		output += "<input class='btn_elimina' type='button' value='Elimina' onclick='sendDelete(this,"."$id".")'><br></div>";
		*/
		
		
		/*		
		var tit_comm = document.getElementById("tit_commento");
		var div = document.createElement('div');
		div.innerHTML = xmlHttp.responseText;
		alert(xmlHttp.responseText);
		document.getElementById("content").insertBefore(div,tit_comm);
		*/
  	}
}

/*
 * Funzione che gestisce l'eliminazione di un commento
 */
function sendDelete(e,id){
	var risposta = confirm("Vuoi davvero eliminare questo commento?");
	if(risposta==true){
		xmlHttp = new XMLHttpRequest();
		var url = "del_commento.php";
		xmlHttp.onreadystatechange = deleteStateChange;	
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		var post_string = "id_comm="+id;
		btn = event.target || event.srcElement;	
		xmlHttp.send(post_string);
	}
}

/*
 * Funzione di callback da eseguire una volta ricevuta la conferma dell'eliminazione del commento
 */
function deleteStateChange(){
	if(xmlHttp.readyState == 4 && xmlHttp.status==200){
		//Elimino il div padre del pulsante
		var parent_div = btn.parentNode;
		while(parent_div.hasChildNodes()) {
    		parent_div.removeChild(parent_div.lastChild);
		}
	}
}
