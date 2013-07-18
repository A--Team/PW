<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
			<span id="menu">
				<a href="index.php"><span class="btn_menu">Home</span></a>
				<a href="#"><span class="btn_menu">Catalogo</span></a>
				<a href="#"><span class="btn_menu">Pippo</span></a>
				<a href="#"><span class="btn_menu">Pluto</span></a>
			</span>			
	</div>
	<div id="login">
		<?php
			session_start();
			//carico script contenente i parametri di configurazione
			include_once 'config.php';
			//controllo esistenza della sessione
			if(isset($_SESSION[$session_name])){
				//attivo la sessione
				$_SESSION[$session_name] = true;
				echo "<br><br><h2>Benvenuto " . $_SESSION['username'] . "!</h2><br>";
				echo "<form method='POST' action='logout.php'>
						<input type='submit' value='logout'>
					  </form>";
			}
			else{
				if(isset($_GET["bad_cred"]))
					include 'login_form.php';
				else
					include 'login_form.php';
			}
		?>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			//carico script contenente i parametri di configurazione
			include_once 'config.php';
			//carico script di interfaccia al database
		    include_once 'database.php';
			//Creo la connessione al database
			$conn = database::dbConnect();
			
			//Recupero l'id dell'utente corrente
			$user = $_SESSION['username'];
			$sql = "SELECT `cf` FROM `utente` WHERE `user` = \"$user\"";
			$result = database::qSelect($conn, $sql);
    		$record = mysql_fetch_array($result);
    		$id_user = $record['cf'];
			
			//Recupero i pacchetti dell'utente corrente non ancora prenotati
			$sql = "SELECT * FROM `pacchetto` WHERE `id_utente` = \"$id_user\" AND `prenotato` = FALSE";
			$result = database::qSelect($conn, $sql);    		
    		while($record = mysql_fetch_array($result)){
    			$id_pacchetto = $record['id'];
    			$num_persone = $record['persone'];
				$num_notti = $record['durata'];
				$data_partenza = $record['data_partenza'];
				$id_pernottamento = $record['id_pernottamento'];
				$id_trasporto = $record['id_trasporto'];
				$id_destinazione = $record['id_destinazione'];
				
				//Recupero i dettagli del pernottamento
				$sql = "SELECT * FROM `pernottamento` WHERE `id` = \"$id_pernottamento\"";
				$result_per = database::qSelect($conn, $sql);
    			$record_per = mysql_fetch_array($result_per);
				$tipo_pernottamento = $record_per['tipo'];
				$prezzo_pernottamento = $record_per['prezzo'];
				//Recupero i dettagli del trasporto
				$sql = "SELECT * FROM `trasporto` WHERE `id` = \"$id_trasporto\"";
				$result_tras = database::qSelect($conn, $sql);
    			$record_tras = mysql_fetch_array($result_tras);
				$tipo_trasporto = $record_tras['tipo'];
				$prezzo_trasporto = $record_tras['prezzo'];
				//Recupero i dettagli della destinazione
				$sql = "SELECT * FROM `destinazione` WHERE `id` = \"$id_destinazione\"";
				$result_dest = database::qSelect($conn, $sql);
    			$record_dest = mysql_fetch_array($result_dest);
				$continente = $record_dest['continente'];
				$citta = $record_dest['citta'];
				$tipo_destinazione = $record_dest['tipo'];
				$foto = $record_dest['foto'];
				//Recupero i dettagli delle attrazioni
				$sql = "SELECT * FROM `rel_attrazioni` WHERE `id_pacchetto` = \"$id_pacchetto\"";
				$result_list_attr = database::qSelect($conn, $sql);
				$tipo_attr = array();
				$prezzo_attr = array();
				while($record_list_attr = mysql_fetch_array($result_list_attr)){
					$id_attr = $record_list_attr['id_attrazione'];
					$sql_attr = "SELECT * FROM `attrazioni` WHERE `id` = \"$id_attr\"";
					$result_attr = database::qSelect($conn, $sql_attr);
					$record_attr = mysql_fetch_array($result_attr);
					$tipo_attr[] = $record_attr['tipo'];
					$prezzo_attr[] = $record_attr['prezzo'];					
				}
				
				//Calcolo il costo totale
				$costo = $prezzo_pernottamento*$num_notti*$num_persone + $prezzo_trasporto*$num_persone;
				foreach($prezzo_attr as $p){
					$costo = $costo + $p;
				}
				
				$html = "
					<div class='div_viaggio'>
						<p class='dest_viaggio'>
							$citta
							<div class='div_foto_viaggio'>
								<img src=./style/images/dest/$foto width=200px height=150px>
							</div> 
						</p>
						<p>
						Viaggio di $num_notti notti per $num_persone persona/e.<br>
						<span class='carat_viaggio'>Partenza il:</span> $data_partenza.<br>
						<span class='carat_viaggio'>Trasporto:</span> $tipo_trasporto<br>
						<span class='carat_viaggio'>Pernottamento:</span> $tipo_pernottamento<br>
						<span class='costo_viaggio'>A soli: $costo €</span>
						</p>
					</div>";
				echo $html;				
    		}			
			mysql_close();
		?>
	</div>
	<div id="navigation">
	  	<div>colonna laterale</div>
	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
