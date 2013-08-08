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
    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/wish_list.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="style/style.css">
  </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
			<span class="ribbon">
				<a href="index.php"><span>Home</span></a>
				<a href="#"><span>Catalogo</span></a>
				<a href="#"><span>Pippo</span></a>
				<a href="#"><span>Pluto</span></a>
			</span>				
	</div>
	<div id="login">
		<?php
			//carico script contenente i parametri di configurazione
			include_once 'config.php';
			//controllo esistenza della sessione
			if(isset($_SESSION[$session_name])){
				//attivo la sessione
				//$_SESSION[$session_name] = true;
				echo "<br><br><h2>Benvenuto<a href='homepersonale.php'> " . $_SESSION['username'] . "!</a></h2><br>";
				echo "<form method='POST' action='logout.php'>
						<input type='submit' value='logout' class='btn_login'>
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
				include 'pacchetto.php';
				$pacchetti=new pacchetto('wish',[]);
				$pacchetti->stampa("elimina");
			?>
		</div>
		<div id="navigation">
		  	<br>
			<div class="btn_navigation"><a href="ordini.php">Le mie prenotazioni</a></div>
			<div class="btn_navigation"><a href="wish_list.php">I miei desideri</a></div>
            <div class="btn_navigation"><a href="storico.php">I miei viaggi</a></div>
            <div class="btn_navigation"><a href="gestioneprofilo.php">Profilo</a></div>	
		</div>
  	</div> 
	  <div id="footer">
		<div>footer</div>
	  </div>
  </div>
  </body>
</html>
 
