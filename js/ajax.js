//type=0 aggiorna update_target,type=1 aggiorna update_target con val,type=2 chiama solo la pagina php 
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
      }
    } 
  xmlhttp.open("POST",page_to_open,false);
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send(post_parameters);
}

function aggiorna_citta(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","aggiorna_citta.php","continent="+continent,0);
  document.getElementById("city").disabled=false;
}

function recupera_destinazioni(){
    ajax_request("#destinazione","recupera_destinazioni.php","",0);
}
function aggiorna_citta_pacchetto(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","aggiorna_citta.php","continent="+continent,0);
  document.getElementById("city").disabled=false;
  document.getElementById("pernottamento").innerHTML="";
  document.getElementById("trasporto").innerHTML="";
  document.getElementById("attrazioni").innerHTML="";
  document.getElementById("attrazioni_pacchetto").innerHTML="";
}
function update_packet_options(){
  var dest_id=document.getElementById("city").value;
  aggiorna_pernottamento(dest_id);
  aggiorna_trasporto(dest_id);
  aggiorna_attrazioni(dest_id);
}

function aggiorna_pernottamento(dest_id){
  ajax_request("#pernottamento","aggiorna_pernottamento.php","dest_id="+dest_id,0);
}

function aggiorna_trasporto(dest_id){
  ajax_request("#trasporto","aggiorna_trasporto.php","dest_id="+dest_id,0);
}

function aggiorna_attrazioni(dest_id){
  ajax_request("#attrazioni","aggiorna_attrazioni.php","dest_id="+dest_id,0);
}
function aggiorna_trasporti(){
  var dest_id=document.getElementById("destinazione").value;
  ajax_request("#lista_trasporti","aggiorna_trasporto.php","dest_id="+dest_id,0);
}
function aggiorna_opzioni_trasporto(){
  var trasp_id=document.getElementById("lista_trasporti").value;
  ajax_request("#tipologia_mod","aggiorna_tipologia_trasporto.php","trasp_id="+trasp_id,1);
  ajax_request("#prezzo_mod","aggiorna_prezzo_trasporto.php","trasp_id="+trasp_id,1);
}
function mod_trasporto(){
  trasp_id=document.getElementById("lista_trasporti").value;
  tipologia=document.getElementById("tipologia_mod").value;
  prezzo=document.getElementById("prezzo_mod").value;
  if(trasp_id && !$.trim($('#tipologia_mod').val())=='' && tipologia.length>0 && prezzo.length>0 && !isNaN(parseFloat(prezzo).toFixed(2)) && prezzo>0){
    ajax_request("","modifica_trasporto.php","tipo="+tipologia+"&prezzo="+prezzo+"&trasp_id="+trasp_id,2);
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
    ajax_request("","aggiungi_trasporto.php","tipologia="+tipologia+"&prezzo="+prezzo+"&dest_id="+dest_id,2);
    document.getElementById("tipologia").value="";
    document.getElementById("prezzo").value="";
    aggiorna_trasporti();
  }
  else
    alert("Attenzione: opzioni di aggiunta trasporto non valide!");
}

function aggiungi_attrazione(){
  id_attr=document.getElementById("attrazioni").value;
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni){
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(jQuery.inArray(id_attr, vettore_attrazioni)===-1){
    ajax_request("#attrazioni_pacchetto","aggiungi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni,0);
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
    ajax_request("#attrazioni_pacchetto","rimuovi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni,0);
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
  var d=new Date(datepicker);
  var today=new Date();
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
      ajax_request("#confirm_content","crea_pacchetto.php",post_string,0);
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
  
  if(city.length>0 && data_partenza1.length>0 && data_partenza2.length>0){
    post_string="continent="+continent+"&"+"city="+city+"&"+"type="+type+"&"+"duration="+duration+"&"+"npersons="+npersons+"&"+"data_partenza1="+data_partenza1+"&"+"data_partenza2="+data_partenza2;
    ajax_request("#content","search.php",post_string,0);
    $("#err_content").html("");
  }
  else
    $("#err_content").html("Attenzione, non hai selezionato la città o il range della data di partenza.");
}