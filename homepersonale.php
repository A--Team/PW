<?php
	session_start();
	include_once 'config.php';
	if(!isset($_SESSION[$session_name]))
		header("Refresh: 0;url=badlogin.php");  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
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
				echo "<br><br><h2>Benvenuto " . $_SESSION['username'] . "!</h2><br>";
		?>
        <form method='POST' action='logout.php'>
					<input type='submit' value='logout'>
		 </form>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			include_once 'database.php';
			$conn=database::dbConnect();
			
			$user=$_SESSION['username'];
			/*
				Recupero gli id di tutte le destinazioni di ogni pacchetto appartenente al cliente. Identifico quale è
				il tipo di vacenza scelto più volte
			*/
			$query="SELECT tipo,count(tipo) AS quantita FROM destinazione WHERE id IN 
						(SELECT id_destinazione FROM pacchetto WHERE id_utente='".$user."') 
						GROUP BY tipo ORDER BY quantita DESC";
			$result=database::qSelect($conn,$query);
			$record=mysql_fetch_array($result);
			$tipo_mirato=$record["tipo"];
			//Scelgo i pacchetti prefatti dall'agenzia che abbiano come tipo il tipo più usato dal cliente
			$query="SELECT * FROM pacchetto WHERE id_utente='agenzia' AND id_destinazione IN 
						(SELECT id FROM destinazione WHERE tipo='".$tipo_mirato."')";
			$result=database::qSelect($conn,$query);
			
			while($record = mysql_fetch_array($result)){
    			$id_pacchetto = $record['id'];
    			$num_persone = $record['persone'];
				$num_notti = $record['durata'];
				$data_partenza = $record['data_partenza'];
				$id_pernottamento = $record['id_pernottamento'];
				$id_trasporto = $record['id_trasporto'];
				$id_destinazione = $record['id_destinazione'];
				
				//Recupero i dettagli del pernottamento
				$sql = "SELECT * FROM pernottamento WHERE id = '".$id_pernottamento."'";
				$result_per = database::qSelect($conn, $sql);
    			$record_per = mysql_fetch_array($result_per);
				$tipo_pernottamento = $record_per['tipo'];
				$prezzo_pernottamento = $record_per['prezzo'];
				//Recupero i dettagli del trasporto
				$sql = "SELECT * FROM trasporto WHERE id = '".$id_trasporto."'";
				$result_tras = database::qSelect($conn, $sql);
    			$record_tras = mysql_fetch_array($result_tras);
				$tipo_trasporto = $record_tras['tipo'];
				$prezzo_trasporto = $record_tras['prezzo'];
				//Recupero i dettagli della destinazione
				$sql = "SELECT * FROM destinazione WHERE id = '".$id_destinazione."'";
				$result_dest = database::qSelect($conn, $sql);
    			$record_dest = mysql_fetch_array($result_dest);
				$continente = $record_dest['continente'];
				$citta = $record_dest['citta'];
				$tipo_destinazione = $record_dest['tipo'];
				$foto = $record_dest['foto'];
				//Recupero i dettagli delle attrazioni
				$sql = "SELECT * FROM rel_attrazioni WHERE id_pacchetto = '".$id_pacchetto."'";
				$result_list_attr = database::qSelect($conn, $sql);
				$tipo_attr = array();
				$prezzo_attr = array();
				while($record_list_attr = mysql_fetch_array($result_list_attr)){
					$id_attr = $record_list_attr['id_attrazione'];
					$sql_attr = "SELECT * FROM attrazioni WHERE id = '".$id_attr."'";
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
			database::dbClose();
						
		?>

	</div>
	<div id="navigation">
    			<br>
				<div class="btn_navigation"><a href="#">Le mie prenotazioni</a></div>
				<div class="btn_navigation"><a href="#">I miei desideri</a></div>
                <div class="btn_navigation"><a href="#">I miei viaggi</a></div>
                <div class="btn_navigation"><a href="#">Profilo</a></div>		
  	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
 