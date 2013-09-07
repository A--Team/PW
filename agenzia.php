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
		<?php

			include 'pacchetto.php';
			$pacchetti=new pacchetto('tutti',array());
			$pacchetti->stampa();
						
		?>

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
		<?php
	    	include 'footer.php';
	  	?>
      </div>
    </div>
  </body>
</html>
