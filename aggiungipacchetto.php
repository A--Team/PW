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
    <script type="text/javascript" src="ajax.js"></script>
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
				echo "<br><br><h2>Benvenuto " . $_SESSION['username'] . "!</h2><br>";
		?>
        <form method='POST' action='logout.php'>
					<input type='submit' value='logout'>
	</form>
	</div>
    </div>
      <div id="content_container">
	<div id="content">
	<div class="sottomenu_modifica">
	  <button type="button" class="bottone_sottomenu" onclick="location.href='aggiungipacchetto.php'">Aggiungi pacchetto</button>
	  <button type="button" onclick="location.href='aggiungidestinazione.php'">Aggiungi destinazione</button>
	  <button type="button" onclick="location.href='aggiungitrasporto.php'">Aggiungi trasporto</button>
	  <button type="button" onclick="location.href='aggiungipernottamento.php'">Aggiungi pernottamento</button>
	  <button type="button" onclick="location.href='aggiungiattrazione.php'">Aggiungi attrazione</button>
	</div>
	<h2 class="title_space">Aggiungi pacchetto</h2>
	<br>
	<br>
	<form action="" class="title_space">
	Continente:	
	<select id="continent" onchange='aggiorna_citta_pacchetto()'>
	  <option value="" disabled selected>Seleziona continente</option>
	  <option value="africa">Africa</option>
	  <option value="america">America</option>
	  <option value="asia">Asia</option>
	  <option value="europa">Europa</option>
	  <option value="oceania">Oceania</option>
	</select>
	<br>
	<br>
	Città:
	<select id="city" name="citta" onchange='update_packet_options()' disabled>
	</select>
	<br>
	<br>
	N. Persone:
	<select id="npersons" name="npersone">
	  <option value="1">1</option>
	  <option value="2">2</option>
	  <option value="3">3</option>
	  <option value="4">4</option>
	  <option value="6">6</option>
	</select>
	<br>
	<br>
	Durata:
	<button type="button" onclick="minus()">-</button><input type="text" id="duration" name="durata" value="1" class="duration_field" readonly><button type="button" onclick="plus()">+</button>
	<br>
	<br>
	Data di partenza:
	<input type="text" id="datepicker" name="data_partenza" class="date_input" readonly>
	<br>
	<br>
	Sconto:
	<input type="text" class="duration_field" id="sconto" name="sconto">%
	<div id="err_sconto"></div>
	<br>
	<br>
	Seleziona pernottamento:
	<br>
	<br>
	<select id="pernottamento" name="pernottamento" class="packet_options_select" size="6">
	</select>
	<br>
	<br>
	Seleziona trasporto:
	<br>
	<br>
	<select id="trasporto" name="trasporto" class="packet_options_select" size="6">
	</select>
	<br>
	<br>
	Seleziona attrazioni:
	<br>
	<br>
	<table>
	<tr>
	  <td>
	    Disponibili:<br>
	    <select id="attrazioni" class="packet_options_select" size="6">
	    </select>
	  </td>
	  <td>
	    <button type="button" onclick="aggiungi_attrazione()">Aggiungi</button>
	    <br>
	    <button type="button" onclick="rimuovi_attrazione()">Rimuovi</button>
	  </td>
	  <td>
	    Pacchetto:<br>
	    <select id="attrazioni_pacchetto" name="attrazioni" class="packet_options_select" size="6">
	    </select>
	  </td>
	</tr>
	</table>
	<br>
	<br>
	<button type="button" onclick="controlla_form()">Crea pacchetto</button>
	<div id="err_content"></div>
	<div id="confirm_content"></div>
	</form>
	</div>
	<div id="navigation">
    			<br>
				<div class="btn_navigation"><a href="aggiungipacchetto.php">Aggiungi</a></div>
				<div class="btn_navigation"><a href="gestioneprofilo.php">Profilo</a></div>		
  	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
