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
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="./js/ajax.js"></script>
    <script type="text/javascript" src="./js/jquery.form.min.js"></script>
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
	  <button type="button" onclick="location.href='aggiungipacchetto.php'">Aggiungi pacchetto</button>
	  <button type="button" class="bottone_sottomenu" onclick="location.href='gestionedestinazione.php'">Gestione destinazioni</button>
	  <button type="button" onclick="location.href='gestionetrasporto.php'">Gestione trasporti</button>
	  <button type="button" onclick="location.href='gestionepernottamento.php'">Gestione pernottamenti</button>
	  <button type="button" onclick="location.href='gestioneattrazione.php'">Gestione attrazioni</button>
	</div>
	<h2>Gestione destinazione</h2>
	<h3>Seleziona continente</h3>
	<select id="continente" class="input" name="continente" onchange="aggiorna_destinazioni()">
	  <option value="" disabled selected>Seleziona continente</option>
	  <option value="africa">Africa</option>
	  <option value="america">America</option>
	  <option value="asia">Asia</option>
	  <option value="europa">Europa</option>
	  <option value="oceania">Oceania</option>
	</select>
	<br>
	<br>
	<form id="mod_form" method="post" enctype="multipart/form-data" action='modifica_destinazione.php'>
    	<h3 style="height:5px;">Modifica/Elimina</h3>
	  <table>
	  <tr>
	    <td><h4>Seleziona</h4></td>
        <td style="padding-left: 50px;"><h4>Opzioni</h4></td>
	</tr>
	  <tr>
	    <td><select class="packet_options_select" id="lista_destinazioni" name="destinazione" onchange="aggiorna_opzioni_destinazione()" size="14">
	    </select></td>
	    <td style="padding-left: 50px;">
        	<table>
           	<tr><td>Nome citt&agrave:</td><td><input type="text" class="input" id="citta_mod" name="citta_mod"></td></tr>
		<tr><td>Tipologia:</td><td><input type="text" class="input" id="tipologia_mod" name="tipologia_mod"></td></tr>
		<tr><td>Foto(jpg,max 1.5MB):</td><td><img src="./style/images/noimage.png" alt="" id="immagine_mod" style="width:100px;height:100px;"><br><input type="file" id="file_mod" name="file_mod"></td></tr>
		<tr><td>Descrizione:</td><td><textarea id="descrizione_mod" class="input" name="descrizione_mod"></textarea></td></tr>
       		</table>
	    </td>
	  </tr>
	  <tr>
	   	<td><button type="button" id="btn_modifica" class="btn_commenta" onclick="elimina_destinazione()">Elimina destinazione</button></td>
		<td style="padding-left: 50px;"><button type="button" id="btn_modifica" class="btn_commenta" onclick="mod_destinazione()">Modifica destinazione</button></td>
	  </tr>
	  </table>
	</form>
	<table>
	<tr>
	<form id="agg_form" method="post" enctype="multipart/form-data" action='aggiungi_destinazione.php'>
	<td><h3>Aggiungi</h3></td>
	</tr>
	<tr>
	  <td>Nome citt&agrave:<td>
	</tr>
	<tr>
	    <td><input type="hidden" name="continente" id="cont_copia"><input type="text" class="input" id="citta" name="citta"></td>
	</tr>
	<tr>
	  <td>Tipologia:</td>
	</tr>
	<tr>
	  <td><input type="text" class="input" id="tipologia" name="tipologia"></td>
	</tr>
	<tr>
	  <td>Carica foto(jpg,max 1.5MB):</td>
	</tr>
	<tr>
	  <td><input type="file" id="file" name="file"></td>
	</tr>
	<tr>
	  <td>Descrizione:</td>
	</tr>
	<tr>
	  <td><textarea id="descrizione" class="input" name="descrizione"></textarea></td>
	</tr>
	<tr>
	<td><button type="button" class="btn_commenta" onclick="agg_destinazione()">Salva destinazione</button></td>
	</tr>
	</table>
	</form>
	<br>
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
 

