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
			include 'pacchetto.php';
			$pacchetti=new pacchetto('home');
			$pacchetti->stampa();
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
 
