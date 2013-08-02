//funzione per aggiornare il campo select delle città quando l'utente seleziona un continente. Usa ajax.
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

//funzione chiamata quando l'utente clicca sul bottone cerca. Richiama la pagina search.php passando i parametri di ricerca tramite post e aggiorna(asincronicamente) 'div_content' con gli ID dei pacchetti trovati.
function search()
{
  var xmlhttp;
  var continent=document.getElementById("continent").value;
  var city=document.getElementById("city").value;
  var type=document.getElementById("type").value;
  var duration=document.getElementById("duration").value;
  var npersons=document.getElementById("npersons").value;
  var data_partenza1=document.getElementById("datepicker1").value;
  var data_partenza2=document.getElementById("datepicker2").value;
  if(city.length>0 && data_partenza1.length>0 && data_partenza2.length>0){
    if (window.XMLHttpRequest)
      xmlhttp=new XMLHttpRequest();
    else
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
	$("#err_content").html("");
	document.getElementById("packets_content").innerHTML=xmlhttp.responseText;
	}
      } 
    xmlhttp.open("POST","search.php",true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var post_string="continent="+continent+"&"+"city="+city+"&"+"type="+type+"&"+"duration="+duration+"&"+"npersons="+npersons+"&"+"data_partenza1="+data_partenza1+"&"+"data_partenza2="+data_partenza2;
    xmlhttp.send(post_string);
  }
  else
    $("#err_content").html("Attenzione, non hai selezionato la città o il range della data di partenza");
}