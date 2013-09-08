//type=0 aggiorna update_target,type=1 aggiorna update_target con val,type=2 chiama solo la pagina php ,type=3 per src immagini
function ajax_request(update_target,page_to_open,post_parameters,type){
  if (window.XMLHttpRequest)
    xmlhttp=new XMLHttpRequest();
  else
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
	if(type==0)
	  $(update_target).html(xmlhttp.responseText);
	else if(type==1)
	  $(update_target).val(xmlhttp.responseText);
	else if(type==3)
	  document.getElementById(update_target).src='./style/images/dest/'+xmlhttp.responseText;
      }
    } 
  xmlhttp.open("POST",page_to_open,false);
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send(post_parameters);
}

function aggiorna_citta(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","./php/aggiorna_citta.php","continent="+continent,0);
  document.getElementById("city").disabled=false;
}

function recupera_destinazioni(){
    ajax_request("#destinazione","./php/recupera_destinazioni.php","",0);
}
function aggiorna_citta_pacchetto(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","./php/aggiorna_citta.php","continent="+continent,0);
  document.getElementById("city").disabled=false;
  document.getElementById("pernottamento").innerHTML="";
  document.getElementById("trasporto").innerHTML="";
  document.getElementById("attrazioni").innerHTML="";
  document.getElementById("attrazioni_pacchetto").innerHTML="";
}
function update_packet_options(city){
  if(city==""){
  	var dest_id=document.getElementById("city").value;
  	aggiorna_pernottamento(dest_id);
  	aggiorna_trasporto(dest_id);
  	aggiorna_attrazioni(dest_id);
  }
  else{
  	var dest_id=city;  
  	aggiorna_attrazioni(dest_id);
  }
}

function aggiorna_pernottamento(dest_id){
  ajax_request("#pernottamento","./php/aggiorna_pernottamento.php","dest_id="+dest_id,0);
}

function aggiorna_trasporto(dest_id){
  ajax_request("#trasporto","./php/aggiorna_trasporto.php","dest_id="+dest_id,0);
}

function aggiorna_attrazioni(dest_id){
  ajax_request("#attrazioni","./php/aggiorna_attrazioni.php","dest_id="+dest_id,0);
}
function aggiorna_trasporti(){
  var dest_id=document.getElementById("destinazione").value;
  ajax_request("#lista_trasporti","./php/aggiorna_trasporto.php","dest_id="+dest_id,0);
}
function aggiorna_destinazioni(){
  var cont=document.getElementById("continente").value;
  document.getElementById('cont_copia').value=cont;
  ajax_request("#lista_destinazioni","./php/aggiorna_destinazione.php","cont="+cont,0);
}
function aggiorna_pernottamenti(){
  var dest_id=document.getElementById("destinazione").value;
  ajax_request("#lista_pernottamenti","./php/aggiorna_pernottamento.php","dest_id="+dest_id,0);
}
function aggiorna_attrazioni2(){
  var dest_id=document.getElementById("destinazione").value;
  ajax_request("#lista_attrazioni","./php/aggiorna_attrazioni.php","dest_id="+dest_id,0);
}
function aggiorna_opzioni_destinazione(){
  var dest_id=document.getElementById("lista_destinazioni").value;
  ajax_request("#citta_mod","./php/aggiorna_citta_destinazione.php","dest_id="+dest_id,1);
  ajax_request("#tipologia_mod","./php/aggiorna_tipologia_destinazione.php","dest_id="+dest_id,1);
  ajax_request("immagine_mod","./php/aggiorna_immagine_destinazione.php","dest_id="+dest_id,3);
  ajax_request("#descrizione_mod","./php/aggiorna_descrizione_destinazione.php","dest_id="+dest_id,1);
}
function aggiorna_opzioni_trasporto(){
  var trasp_id=document.getElementById("lista_trasporti").value;
  ajax_request("#tipologia_mod","./php/aggiorna_tipologia_trasporto.php","trasp_id="+trasp_id,1);
  ajax_request("#prezzo_mod","./php/aggiorna_prezzo_trasporto.php","trasp_id="+trasp_id,1);
}
function aggiorna_opzioni_pernottamento(){
  var pern_id=document.getElementById("lista_pernottamenti").value;
  ajax_request("#tipologia_mod","./php/aggiorna_tipologia_pernottamento.php","pern_id="+pern_id,1);
  ajax_request("#prezzo_mod","./php/aggiorna_prezzo_pernottamento.php","pern_id="+pern_id,1);
}
function aggiorna_opzioni_attrazione(){
  var attr_id=document.getElementById("lista_attrazioni").value;
  ajax_request("#tipologia_mod","./php/aggiorna_tipologia_attrazione.php","attr_id="+attr_id,1);
  ajax_request("#prezzo_mod","./php/aggiorna_prezzo_attrazione.php","attr_id="+attr_id,1);
}
function mod_destinazione(){
  dest_id=document.getElementById("lista_destinazioni").value;
  citta=document.getElementById("citta_mod").value;
  tipologia=document.getElementById("tipologia_mod").value;
  file=document.getElementById("file_mod").value;
  descrizione=document.getElementById("descrizione_mod").value;
  if(dest_id && !$.trim($('#tipologia_mod').val())=='' && tipologia.length>0 && !$.trim($('#citta_mod').val())=='' && citta.length>0 && file){
    $("#mod_form").ajaxForm(function(){aggiorna_destinazioni()}).submit();
    document.getElementById("citta_mod").value="";
    document.getElementById("tipologia_mod").value="";
    document.getElementById("immagine_mod").src='./style/images/noimage.png';
    document.getElementById("descrizione_mod").value="";
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}
function elimina_destinazione(){
  if(!confirm("Vuoi davvero eliminare quesa destinazione?"))
  	return;
  dest_id=document.getElementById("lista_destinazioni").value;
  if(dest_id)
  {
    ajax_request("","./php/elimina_destinazione.php","dest_id="+dest_id,2);
    document.getElementById("citta_mod").value="";
    document.getElementById("tipologia_mod").value="";
    document.getElementById("descrizione_mod").value="";
    document.getElementById("immagine_mod").src='./style/images/noimage.png';
    aggiorna_destinazioni();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}
function agg_destinazione(){
  cont=document.getElementById("continente").value;
  citta=document.getElementById("citta").value;
  tipologia=document.getElementById("tipologia").value;
  file=document.getElementById("file").value;
  descrizione=document.getElementById("descrizione").value;
  if(cont && !$.trim($('#tipologia').val())=='' && tipologia.length>0 && !$.trim($('#citta').val())=='' && citta.length>0 && file){
    $("#agg_form").ajaxForm(function(){aggiorna_destinazioni()}).submit();
    document.getElementById("citta").value="";
    document.getElementById("tipologia").value="";
    document.getElementById("file").value="";
    document.getElementById("descrizione").value="";
  }
  else
    alert("Attenzione: opzioni di aggiunta destinazione non valide!");
}

function mod_trasporto(){
  trasp_id=document.getElementById("lista_trasporti").value;
  tipologia=document.getElementById("tipologia_mod").value;
  prezzo=document.getElementById("prezzo_mod").value;
  if(trasp_id && !$.trim($('#tipologia_mod').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/modifica_trasporto.php","tipo="+tipologia+"&prezzo="+prezzo+"&trasp_id="+trasp_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_trasporti();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function elimina_trasporto(){
  if(!confirm("Vuoi davvero eliminare questo trasporto?"))
  	return;
  trasp_id=document.getElementById("lista_trasporti").value;
  if(trasp_id)
  {
    ajax_request("","./php/elimina_trasporto.php","trasp_id="+trasp_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_trasporti();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function agg_trasporto(){
  dest_id=document.getElementById("destinazione").value;
  tipologia=document.getElementById("tipologia").value;
  prezzo=document.getElementById("prezzo").value;
  if(!$.trim($('#tipologia').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/aggiungi_trasporto.php","tipologia="+tipologia+"&prezzo="+prezzo+"&dest_id="+dest_id,2);
    document.getElementById("tipologia").value="";
    document.getElementById("prezzo").value="";
    aggiorna_trasporti();
  }
  else
    alert("Attenzione: opzioni di aggiunta trasporto non valide!");
}
function mod_pernottamento(){
  pern_id=document.getElementById("lista_pernottamenti").value;
  tipologia=document.getElementById("tipologia_mod").value;
  prezzo=document.getElementById("prezzo_mod").value;
  if(pern_id && !$.trim($('#tipologia_mod').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/modifica_pernottamento.php","tipo="+tipologia+"&prezzo="+prezzo+"&pern_id="+pern_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_pernottamenti();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function elimina_pernottamento(){
  if(!confirm("Vuoi davvero eliminare questo pernottamento?"))
  	return;
  pern_id=document.getElementById("lista_pernottamenti").value;
  if(pern_id)
  {
    ajax_request("","./php/elimina_pernottamento.php","pern_id="+pern_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_pernottamenti();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function agg_pernottamento(){
  dest_id=document.getElementById("destinazione").value;
  tipologia=document.getElementById("tipologia").value;
  prezzo=document.getElementById("prezzo").value;
  if(!$.trim($('#tipologia').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/aggiungi_pernottamento.php","tipologia="+tipologia+"&prezzo="+prezzo+"&dest_id="+dest_id,2);
    document.getElementById("tipologia").value="";
    document.getElementById("prezzo").value="";
    aggiorna_pernottamenti();
  }
  else
    alert("Attenzione: opzioni di aggiunta pernottamento non valide!");
}

function mod_attrazione(){
  attr_id=document.getElementById("lista_attrazioni").value;
  tipologia=document.getElementById("tipologia_mod").value;
  prezzo=document.getElementById("prezzo_mod").value;
  if(attr_id && !$.trim($('#tipologia_mod').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/modifica_attr.php","tipo="+tipologia+"&prezzo="+prezzo+"&attr_id="+attr_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_attrazioni2();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function elimina_attrazione(){
  if(!confirm("Vuoi davvero eliminare questa attrazione?"))
  	return;
  attr_id=document.getElementById("lista_attrazioni").value;
  if(attr_id)
  {
    ajax_request("","./php/elimina_attrazione.php","attr_id="+attr_id,2);
    document.getElementById("tipologia_mod").value="";
    document.getElementById("prezzo_mod").value="";
    aggiorna_attrazioni2();
  }
  else
    alert("Attenzione: opzioni di modifica non valide!");
}

function agg_attrazione(){
  dest_id=document.getElementById("destinazione").value;
  tipologia=document.getElementById("tipologia").value;
  prezzo=document.getElementById("prezzo").value;
  if(!$.trim($('#tipologia').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","./php/aggiungi_attr.php","tipologia="+tipologia+"&prezzo="+prezzo+"&dest_id="+dest_id,2);
    document.getElementById("tipologia").value="";
    document.getElementById("prezzo").value="";
    aggiorna_attrazioni2();
  }
  else
    alert("Attenzione: opzioni di aggiunta attrazione non valide!");
}

function aggiungi_attrazione(){
  id_attr=document.getElementById("attrazioni").value;
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni){
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(jQuery.inArray(id_attr, vettore_attrazioni)===-1){
    ajax_request("#attrazioni_pacchetto","./php/aggiungi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni,0);
  }
}

function rimuovi_attrazione(){
  id_attr=document.getElementById("attrazioni_pacchetto").value;
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni) {
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(id_attr.length>0)
    ajax_request("#attrazioni_pacchetto","./php/rimuovi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni,0);
}

function elimina_pacchetto(){
  id=document.getElementById("pacchetto").value; 
  if(id!=""){
  	if(confirm("Vuoi davvero eliminare questo pacchetto?")){
  		post_string="id="+id;
    	ajax_request("","./php/elimina_pacchetto.php",post_string,0);
    	location.reload;
	}
  }
  else 
    alert("Seleziona il pacchetto da eliminare.");
}

function controlla_form(){
  city=document.getElementById("city").value;
  npersons=document.getElementById("npersons").value;
  duration=document.getElementById("duration").value;
  datepicker=document.getElementById("datepicker").value;
  npersons=document.getElementById("npersons").value;
  sconto=document.getElementById("sconto").value;
  pernottamento=document.getElementById("pernottamento").value;
  trasporto=document.getElementById("trasporto").value;
  id_attr=document.getElementById("attrazioni_pacchetto").value;
  var er = /^[0-9]+$/;
  var d=new Date(datepicker);
  var today=new Date();
  if(!er.test(npersons)){
  	$("#err_content").html("Inserire un numero intero positivo per il numero di persone");
	  return;
  }
  if(d <= today)
  {
	  $("#err_content").html("La data di partenza è precedente alla data odierna");
	  return;
  }
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni) {
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(!isNaN(sconto) && sconto>=0 && sconto<=100){
    if(city.length>0 && datepicker.length>0 && pernottamento.length>0 && trasporto.length>0){
      post_string="city="+city+"&"+"duration="+duration+"&"+"npersons="+npersons+"&"+"datepicker="+datepicker+"&"+"sconto="+(sconto/100)+"&"+"pernottamento="+pernottamento+"&"+"trasporto="+trasporto+"&"+"vettore_attrazioni="+vettore_attrazioni;
      $("#err_content").html("");
      ajax_request("#confirm_content","./php/crea_pacchetto.php",post_string,0);
      document.getElementById("city").innerHTML="";
      document.getElementById("city").disabled=true;
      document.getElementById("datepicker").value="";
      document.getElementById("sconto").value="";
      document.getElementById("pernottamento").innerHTML="";
      document.getElementById("trasporto").innerHTML="";
      document.getElementById("attrazioni").innerHTML="";
      document.getElementById("attrazioni_pacchetto").innerHTML="";
   }
   else{
      $("#confirm_content").html("");
      $("#err_content").html("Attenzione, riempire tutti i campi.");
   }
  }
  else{
     $("#err_sconto").html("Attenzione, sconto deve essere un numero compreso fra 0 e 100.");
  }
}
  
function search(){
  var xmlhttp;
  var continent=document.getElementById("continent").value;
  var city=document.getElementById("city").value;
  var type=document.getElementById("type").value;
  var duration=document.getElementById("duration").value;
  var npersons=document.getElementById("npersons").value;
  var data_partenza1=document.getElementById("datepicker1").value;
  var data1=data_partenza1.split("/");
  var data_partenza1= data1[2]+"-"+data1[1]+"-"+data1[0];	
  var data_partenza2=document.getElementById("datepicker2").value;
  var data2=data_partenza2.split("/");
  var data_partenza2= data2[2]+"-"+data2[1]+"-"+data2[0];
  var er = /^[0-9]+$/;
  
  if(city.length>0 && data1.length==3 && data2.length==3 && er.test(npersons) && npersons>0){
    post_string="continent="+continent+"&"+"city="+city+"&"+"type="+type+"&"+"duration="+duration+"&"+"npersons="+npersons+"&"+"data_partenza1="+data_partenza1+"&"+"data_partenza2="+data_partenza2;
    ajax_request("#content","./php/search.php",post_string,0);
    $("#err_content").html("");
  }
  else
    $("#err_content").html("Attenzione, non hai selezionato la città o il range della data di partenza o il n. persone non è un numero valido");
}

