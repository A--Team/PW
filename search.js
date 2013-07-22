function search()
{
  var xmlhttp;
  var continent=document.getElementById("continent").value;
  var city=document.getElementById("city").value;
  var type=document.getElementById("type").value;
  var duration=document.getElementById("duration").value;
  var npersons=document.getElementById("npersons").value;
  
  if (window.XMLHttpRequest)
    xmlhttp=new XMLHttpRequest();
  else
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      document.getElementById("packets_content").innerHTML=xmlhttp.responseText;
      }
    } 
  xmlhttp.open("POST","search.php",true);
  xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  var post_string="continent="+continent+"&"+"city="+city+"&"+"type="+type+"&"+"duration="+duration+"&"+"npersons="+npersons;
  xmlhttp.send(post_string);
}