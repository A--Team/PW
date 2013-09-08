/**
 * Classe che implementa AJAX per la pagina 'commenti.php'
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
	var url = "./php/send_commento.php";
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
		var div = document.getElementById("new_comments");
		div.innerHTML = xmlHttp.responseText + div.innerHTML;	
		var comm = div.firstChild.childNodes[2];
		$(function() {$("#"+comm.id).rateit();});  	
		$(comm.parentNode).fadeIn();				
  	}
}

/*
 * Funzione che gestisce l'eliminazione di un commento
 */
function sendDelete(e,id){
	var risposta = confirm("Vuoi davvero eliminare questo commento?");
	if(risposta==true){
		xmlHttp = new XMLHttpRequest();
		var url = "./php/del_commento.php";
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
		$(parent_div).fadeOut('slow');		
	}
}

/*
 * Funzione per aggiornare il campo select delle città quando l'utente seleziona un continente
 */
/*
function update_cities(){
  var continent=document.getElementById("continent").value;
  if (window.XMLHttpRequest)
    xmlhttp=new XMLHttpRequest();
  else
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
	document.getElementById("city").disabled=false;
	$("#city").html(xmlhttp.responseText);
      }
    } 
  xmlhttp.open("POST","update_cities.php",true);
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send("continent="+continent);
}
*/

/*
 * Funzione per caricare i commenti relativi alla destinazione selezionata
 */
function show_comments(){
	var citta = document.getElementById("city").value;
	window.open("./commenti.php?citta="+citta,'_self','',false);
}
