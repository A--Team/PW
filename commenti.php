<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
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
				//$_SESSION[$session_name] = true;
				echo "<br><br><h2>Benvenuto<a href='homepersonale.php'> " . $_SESSION['username'] . "!</a></h2><br>";
				echo "<form method='POST' action='logout.php'>
						<input type='submit' value='logout'>
					  </form>";
			}
			else
			{
					include 'login_form.php';
			}
		?>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			//Imposto localizzazione italiana per la visualizzazione delle date
			setlocale(LC_TIME, 'ita', 'it_IT.utf8');
			include_once "database.php";
			$id_dest = $_GET['id'];
			
			//Carico i dettagli della destinazione
			$conn=database::dbConnect();
			$sql = "SELECT `citta`, `foto`, `descrizione` FROM `destinazione` WHERE `id` = $id_dest";
			$result = database::qSelect($conn, $sql);
			$record = mysql_fetch_array($result);
			extract($record);
			echo "<div id='dest_intestazione'><br><div id='dest_commento'>$citta</div><br>";
			echo "<div id='dest_foto'><img src=style/images/dest/$foto width=200 height=150></div>";
			echo "<div id='dest_descrizione'>$descrizione</div></div>";
			database::dbClose();
			
			//Carico l'elenco dei commenti e lo visualizzo			
			$conn=database::dbConnect();
			$sql = "SELECT `id`,`id_utente`,`data`,`rating`,`testo` FROM `commento` WHERE `id_destinazione` = $id_dest ORDER BY `data` DESC LIMIT 0, 30 ";
			$res_commenti = database::qSelect($conn, $sql);
			while($rec_commenti = mysql_fetch_array($res_commenti)){
				extract($rec_commenti);
				echo "<br><div>";
				echo "<span class='tit_commento'>$id_utente - ".strftime("%d %B %Y",strtotime($data))."</span>";					
				echo "<div class='rateit' data-rateit-value=$rating data-rateit-ispreset='true' data-rateit-readonly='true'></div><br>";					
				echo "<div class='corpo_commento'>$testo</div>";
				//Se sono loggato e il commento è mio, mostro un pulsante per eliminarlo
				if(isset($_SESSION[$session_name])){
					if($id_utente == $_SESSION['username']){
						echo "<input class='btn_elimina' type='button' value='Elimina' onclick='sendDelete(this,"."$id".")'><br></div>";
					}
					else {
						echo "</div>";
					}					
				}	
			}			
						
			//Se sono loggato, mostro il form per l'inserimento di un commento
			if(isset($_SESSION[$session_name])){
				$user=$_SESSION['username'];
				if(!isset($_POST['commento'])){					
					echo "<br><span class='tit_commento'>Inserisci un commento e assegna un rating:</span>";
					echo "<div class='rateit' id='rateit5' data-rateit-step=1></div><br>";					
					$form="<div id='commento'>
						 	<form name='form_commento' method='POST' action='commenti.php?id=".$id_dest."'>
						 		<textarea name='commento' cols=90 rows=5></textarea>
						 		<input type='hidden' name='voto' value=''>
						 		<br>
						 		<input class='btn_commenta' type='button' value='Commenta' onclick=\"check_comment($id_dest)\">
						 	</form>
						  </div><br>";					
					echo $form;					  
				 }
				else{
					//Se nel POST è presente un commento, lo salvo e lo segnalo all'utente
					$corpo = nl2br(htmlentities($_POST['commento']));
					$rating = nl2br(htmlentities($_POST['voto']));					
					$data = date("Y-m-d");
					$sql = "INSERT INTO `commento`(`id_utente`, `id_destinazione`, `data`, `rating`, `testo`) VALUES (\"$user\",\"$id_dest\",\"$data\",\"$rating\",\"$corpo\")";
					database::qInsertInto($conn,$sql);
					header("Refresh: 0;url=commenti.php?id=$id_dest");
					
				}
			}
			else
				echo "Per inserire un commento devi essere loggato.";
			database::dbClose();
		?>
		<script type="text/javascript">
    		$("#rateit5").bind('rated', function (event, value) { document.form_commento.voto.value = value; });    
		</script>
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
 
