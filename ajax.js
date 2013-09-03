function ajax_request(update_target,page_to_open,post_parameters){
  if (window.XMLHttpRequest)
    xmlhttp=new XMLHttpRequest();
  else
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
	$(update_target).html(xmlhttp.responseText);
      }
    } 
  xmlhttp.open("POST",page_to_open,false);
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xmlhttp.send(post_parameters);
}

function aggiorna_citta(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","aggiorna_citta.php","continent="+continent);
  document.getElementById("city").disabled=false;
}

function recupera_destinazioni(){
    ajax_request("#destinazione","recupera_destinazioni.php","");
}

function aggiorna_citta_pacchetto(){
  var continent=document.getElementById("continent").value;
  ajax_request("#city","aggiorna_citta.php","continent="+continent);
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
  ajax_request("#pernottamento","aggiorna_pernottamento.php","dest_id="+dest_id);
}

function aggiorna_trasporto(dest_id){
  ajax_request("#trasporto","aggiorna_trasporto.php","dest_id="+dest_id);
}

function aggiorna_attrazioni(dest_id){
  ajax_request("#attrazioni","aggiorna_attrazioni.php","dest_id="+dest_id);
}

function aggiungi_attrazione(){
  id_attr=document.getElementById("attrazioni").value;
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni) {
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(jQuery.inArray(id_attr, vettore_attrazioni)===-1){
    ajax_request("#attrazioni_pacchetto","aggiungi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni);
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
    ajax_request("#attrazioni_pacchetto","rimuovi_attrazione.php","id_attr="+id_attr+"&"+"vettore_attrazioni="+vettore_attrazioni);
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
  opzioni = $('#attrazioni_pacchetto option');
  vettore_attrazioni = $.map(opzioni ,function(opzioni) {
      return opzioni.value;
  });
  vettore_attrazioni=vettore_attrazioni.join(',');
  if(!isNaN(sconto) && sconto>=0 && sconto<=100){
    if(city.length>0 && datepicker.length>0 && pernottamento.length>0 && trasporto.length>0){
      post_string="city="+city+"&"+"duration="+duration+"&"+"npersons="+npersons+"&"+"datepicker="+datepicker+"&"+"sconto="+(sconto/100)+"&"+"pernottamento="+pernottamento+"&"+"trasporto="+trasporto+"&"+"vettore_attrazioni="+vettore_attrazioni;
      $("#err_content").html("");
      ajax_request("#confirm_content","crea_pacchetto.php",post_string);
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

function aggiungi_destinazione(){
  
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
    ajax_request("#content","search.php",post_string);
    $("#err_content").html("");
  }
  else
    $("#err_content").html("Attenzione, non hai selezionato la città o il range della data di partenza.");
}