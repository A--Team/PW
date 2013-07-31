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
			include 'pacchetto.php';
			$conn=database::dbConnect();
			
			$user=$_SESSION['username'];
			
			$query="SELECT pacchetto.*,pernottamento.prezzo AS prezzo_pernottamento,trasporto.prezzo AS prezzo_trasporto,
						pernottamento.tipo AS tipo_pernottamento,trasporto.tipo AS tipo_trasporto, destinazione.citta,
						destinazione.foto
						 FROM pacchetto,pernottamento,trasporto,destinazione WHERE pacchetto.id_utente='agenzia' AND 
								pernottamento.id=pacchetto.id_pernottamento AND trasporto.id=pacchetto.id_trasporto
								AND destinazione.id=pacchetto.id_destinazione";
			$result=database::qSelect($conn,$query);
			while($record = mysql_fetch_array($result))
			{
    			$query="SELECT prezzo FROM attrazioni WHERE id IN (SELECT id_attrazione FROM rel_attrazioni 
						WHERE id_pacchetto='".$record['id']."')";
				$attrazioni=database::qSelect($conn,$query);
				$elemento=new pacchetto($record,$attrazioni);
				$elemento->stampa();
    		}			
			database::dbClose();
						
		?>

	</div>

	<div id="navigation">
    			<br>
				<div class="btn_navigation"><a href="#">Aggiungi</a></div>
				<div class="btn_navigation"><a href="gestioneprofilo.php">Profilo</a></div>		
  	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
