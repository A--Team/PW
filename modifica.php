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
				echo "<br><br><h2>Benvenuto<a href='agenzia.php'> " . $_SESSION['username'] . "!</a></h2><br>";
		?>
        <form method='POST' action='logout.php'>
					<input type='submit' value='logout'>
		 </form>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			include 'database.php';
			$conn=database::dbConnect();
			$id_pacchetto=$_GET['id_pacchetto'];
			$query="SELECT * FROM pacchetto WHERE id='$id_pacchetto'";
			
			$result=database::qSelect($conn,$query);
			$pacchetto=mysql_fetch_array($result);
			$query="SELECT * FROM pernottamento WHERE id_destinazione='".$pacchetto['id_destinazione']."'";
			$pernottamenti=database::qSelect($conn,$query);
			$html="
				<form>
					<table>	
						<tr><td>Numero persone</td><td><input type='text' name='persone' value='".$pacchetto['persone']."'></td></tr>
						<tr><td>Durata viaggio</td><td><input type='text' name='durata' value='".$pacchetto['durata']."'></td></tr>
						<tr><td>Data partenza</td><td><input type='text' name='data' value='".$pacchetto['data_partenza']."'></td></tr>
					</table>
				</form>
			";
			echo $html;
			
			 
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
