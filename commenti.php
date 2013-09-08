<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/rateit.css">
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/jquery.rateit.min.js" type="text/javascript"></script>
    <script src="js/commenti.js" type="text/javascript"></script>
    <script src="js/check_form.js" type="text/javascript"></script>
  </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
		<?php
	    	include './php/menu.php';
	  	?>			
	</div>
	<div id="login">
		<?php
			session_start();
			include 'login_form.php';
		?>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			//Imposto localizzazione italiana per la visualizzazione delle date
			setlocale(LC_TIME, 'ita', 'it_IT.utf8');
			include_once "./php/database.php";
			//Il caricamento della destinazione corretta sfrutta il nome della citta' passato nel GET
			if(!isset($_GET['citta'])){
				//echo "<h2>Seleziona una destinazione.<h2>";				
			}
			else{	
				$citta = urldecode($_GET['citta']);
				
				//Carico i dettagli della destinazione
				$conn=database::dbConnect();
				$sql = "SELECT `id`, `foto`, `descrizione` FROM `destinazione` WHERE `citta` = \"$citta\"";
				$result = database::qSelect($conn, $sql);
				$record = mysql_fetch_array($result);
				extract($record);
				$id_dest = $id;
				echo "<div id='dest_intestazione'><br>";
				echo "<div id='dest_commento'>$citta</div><br>";
				echo "<div id='dest_foto'><img src=style/images/dest/$foto width=200 height=150></div>";
				echo "<div id='dest_descrizione'>$descrizione</div>";
				echo "</div><br>";
							
				//Aggiungo un div vuoto per i commenti inseriti
				echo "<div id='new_comments'></div>";	
				
				//Carico l'elenco dei commenti e lo visualizzo	
				$sql = "SELECT `id`,`id_utente`,`data`,`rating`,`testo` FROM `commento` WHERE `id_destinazione` = $id_dest ORDER BY `data` DESC LIMIT 0, 30 ";
				$res_commenti = database::qSelect($conn, $sql);
				while($rec_commenti = mysql_fetch_array($res_commenti)){
					extract($rec_commenti);
					echo "<div>";
					echo "<span class='tit_commento' id='tit_commento'>$id_utente - ".strftime("%d %B %Y",strtotime($data))."</span>";					
					echo "<div class='rateit' data-rateit-value=$rating data-rateit-ispreset='true' data-rateit-readonly='true'></div><br>";					
					echo "<div class='corpo_commento'>$testo</div>";
					//Se sono loggato e il commento è mio, mostro un pulsante per eliminarlo
					if(isset($_SESSION[$session_name])){
						if($id_utente == $_SESSION['username']){
							echo "<input class='btn_elimina' type='button' value='Elimina' onclick='sendDelete(this,"."$id".")'><br><br></div>";
						}
						else {
							echo "<br></div>";
						}					
					}
					else {
						echo "<br></div>";
					}	
				}			
						
				//Se sono loggato, mostro il form per l'inserimento di un commento
				if(isset($_SESSION[$session_name])){
					$user=$_SESSION['username'];
					if(!isset($_POST['commento'])){		
						echo "<br><span class='tit_commento'>Inserisci un commento e valuta la tua esperienza con la nostra agenzia:</span>";
						echo "<div class='rateit' id='rateit5' data-rateit-step=1></div><br>";					
						$form="<div id='commento'>
							 	<form name='form_commento' method='POST'>
							 		<textarea name='commento' cols=90 rows=5></textarea>
							 		<input type='hidden' name='voto' value=''>
							 		<br>
							 		<input class='btn_commenta' type='button' value='Commenta' onclick=\"check_comment($id_dest,'$user')\">
							 	</form>
							  </div><br>";					
						echo $form;					  
					 }				
				}
				else
					echo "<br><h3>Per inserire un commento devi essere loggato.</h3>";
				database::dbClose();
			}
		?>
		<script type="text/javascript">
    		$("#rateit5").bind('rated', function (event, value) { document.form_commento.voto.value = value; });    
		</script>
	</div>
	<div id="navigation">
	  	
	  		<br>
		<div id='vert_menu'>
			<a href='homepersonale.php'><span>La mia home</span></a>				
			<a href='ordini.php'><span>Le mie prenotazioni</span></a>
			<a href='wish_list.php'><span>I miei desideri</span></a>
			<a href='storico.php' id="selected"><span>I miei viaggi</span></a>
			<a href='gestioneprofilo.php'><span>Il mio profilo</span></a>			
		</div>	  
	  		<!--
	  		<div id="nav_content">
	  		<br><br><br>
	  		<h3>Scegli la destinazione:</h3>
	  		<table>
			  	<tr>
			  		<td>Continente:</td>
					<td>
					  <select id="continent" class="input" onchange='update_cities()'>
					    <option value="" disabled selected>Seleziona</option>
					    <option value="africa">Africa</option>
					    <option value="america">America</option>
					    <option value="asia">Asia</option>
					    <option value="europa">Europa</option>
					    <option value="oceania">Oceania</option>
					  </select>
					</td>
				</tr>
			  	<tr>			  		
			  		<td>Città:</td>
			  		<td><select id="city" class="input" disabled></select>
					</td>
			  	</tr>
		  	</table>
		  	<br>
		  	<input type="button" class="btn_commenta" style="margin: auto" value="Cerca" onclick="show_comments()"/>		  	
		</div>
		-->
	</div>
      </div> 
      <div id="footer">
		<?php
	    	include './php/footer.php';
	  	?>
      </div>
    </div>
  </body>
</html>
 
