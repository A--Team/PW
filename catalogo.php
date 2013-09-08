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
			include './php/pacchetto.php';
			$pacchetti=new pacchetto('catalogo',array());
			$pacchetti->stampa();
		?>
	</div>
	<div id="navigation">
		<div id='vert_menu'>
	    	<?php
		  		include_once './php/config.php';
				if(isset($_SESSION[$session_name]))
				{
					if($_SESSION['username']=='agenzia'){
						echo "<a href='gestionepacchetto.php'><span>Gestione pacchetti</span></a>";			
						echo "<a href='gestioneprofilo.php'><span>Il mio profilo</span></a>";
					}
					else {
						echo "<a href='homepersonale.php' id=\"selected\"><span>La mia home</span></a>";
				   		echo "<a href='ordini.php'><span>Le mie prenotazioni</span></a>";
				   		echo "<a href='wish_list.php'><span>I miei desideri</span></a>";
				   		echo "<a href='storico.php'><span>I miei viaggi</span></a>";
				   		echo "<a href='gestioneprofilo.php'><span>Il mio profilo</span></a>";		
					}	
				}
			?>
		</div>
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
 
