<?php
 	session_start();
 	include_once 'config.php';
 	if(!isset($_SESSION[$session_name])|| $_SESSION['username']!='agenzia')
 	header("Refresh: 0;url=badlogin.php");  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="./js/ajax.js"></script>
    <script>
      $(function(){
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' }).val();
      });
      function minus(){
	if($('#duration').val()>1)
	  $('#duration').val(parseInt($('#duration').val())-1);
      };
      function plus(){
	if($('#duration').val()<20)
	  $('#duration').val(parseInt($('#duration').val())+1);
      };
    </script>
  </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
	  <?php
	    include 'menu.php';
	  ?>	
	</div>
	<div id="login">
				<?php
			include 'login_form.php';
		?>
        </div>
    </div>
      <div id="content_container">
	<div id="content">
	<div class="sottomenu_modifica">
	  <button type="button" class="bottone_sottomenu" onclick="location.href='aggiungipacchetto.php'">Aggiungi pacchetto</button>
	  <button type="button" onclick="location.href='gestionedestinazione.php'">Gestione destinazione</button>
	  <button type="button" onclick="location.href='gestionetrasporto.php'">Gestione trasporto</button>
	  <button type="button" onclick="location.href='gestionepernottamento.php'">Gestione pernottamento</button>
	  <button type="button" onclick="location.href='gestioneattrazione.php'">Gestione attrazione</button>
	</div>
	<h2 class="title_space">Aggiungi pacchetto</h2>
	<form action="" class="title_space">
	<table cellspacing="15px">
	<tr>
	<td>Continente:</td>
	<td><select id="continent" class="input" onchange='aggiorna_citta_pacchetto()'>
	  <option value="" disabled selected>Seleziona continente</option>
	  <option value="africa">Africa</option>
	  <option value="america">America</option>
	  <option value="asia">Asia</option>
	  <option value="europa">Europa</option>
	  <option value="oceania">Oceania</option>
	</select></td>
	</tr>
	<tr>
	<td>Città:</td>
	<td><select id="city" name="citta" class="input" onchange='update_packet_options()' disabled>
	</select></td>
	</tr>
	<tr>
	<!--DA SISTEMARE:controlli sul numero di persone, vedi come è fatto in ajax.js, funzione  search-->
	<td>N. Persone:</td>
	<td><input type="text" id="npersons" class="input" style="width:25px; text-align:center;"></td>
	</tr>
	<tr>
	<td>Durata:</td>
	<td><button type="button" class="input" style="width:20px; text-align:center;" onclick="minus()">-</button><input type="text" id="duration" class="input" name="durata" style="width:30px; text-align:center;" value="1" readonly><button type="button" class="input" style="width:20px; text-align:center;" onclick="plus()">+</button></td>
	</tr>
	<tr>
	<td>Data di partenza:</td>
	<td><input type="text" id="datepicker" name="data_partenza" class="date_input input" readonly></td>
	</tr>
	<tr>
	<td>Sconto:</td>
	<td><input type="text" id="sconto" name="sconto" class="input" style="width:30px; text-align:center;" >%<br>
	<div id="err_sconto"></div></td>
	</tr>
	<tr>
	<td>Pernottamento:
	<br>
	<br>
	<select id="pernottamento" name="pernottamento" class="packet_options_select input" size="6">
	</select></td>
	<td>
	Trasporto:
	<br>
	<br>
	<select id="trasporto" name="trasporto" class="packet_options_select input" size="6">
	</select></td>
	</tr>
	</table>
	<table cellspacing="15px">
	<tr>
	<td>Seleziona attrazioni:</td>
	</tr>
	<tr>
	  <td>
	    Disponibili:<br>
	    <select id="attrazioni" class="packet_options_select input" size="6">
	    </select>
	  </td>
	  <td>
	    <button type="button" class="btn_commenta" style="width:90px;" onclick="aggiungi_attrazione()">Aggiungi &gt&gt</button>
	    <br>
	    <button type="button" class="btn_commenta" style="width:90px;" onclick="rimuovi_attrazione()">&lt&lt Rimuovi</button>
	  </td>
	  <td> 
	    Pacchetto:<br>
	    <select id="attrazioni_pacchetto" name="attrazioni" class="packet_options_select input" size="6">
	    </select>
	  </td>
	</tr>
	</table>
	<table cellspacing="15px">
	<tr><td>
	  <button type="button" class="btn_commenta" onclick="controlla_form()">Crea pacchetto</button>
	  <button type="button" class="btn_commenta" onclick="">Rimuovi pacchetto</button>
	  <div id="err_content"></div>
	  <div id="confirm_content"></div></td>
	</tr>
	</table>
	</form>
	</div>
	<div id="navigation">
    	<br>
		<div id='vert_menu'>
			<a href='aggiungipacchetto.php'><span>Aggiungi pacchetti</span></a>			
			<a href='gestioneprofilo.php'><span>Il mio profilo</span></a>			
		</div>	
  	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
