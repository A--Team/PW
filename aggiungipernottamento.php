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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
  </head>
  <body onload="recupera_destinazioni()">
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
	<div class="sottomenu_modifica">
	  <button type="button" onclick="location.href='aggiungipacchetto.php'">Aggiungi pacchetto</button>
	  <button type="button" onclick="location.href='aggiungidestinazione.php'">Aggiungi destinazione</button>
	  <button type="button" onclick="location.href='aggiungitrasporto.php'">Aggiungi trasporto</button>
	  <button type="button" class="bottone_sottomenu" onclick="location.href='aggiungipernottamento.php'">Aggiungi pernottamento</button>
	  <button type="button" onclick="location.href='aggiungiattrazione.php'">Aggiungi attrazione</button>
	</div>
	<h2 class="title_space">Aggiungi pernottamento</h2>
	<br>
	<br>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="title_space">
	<table cellspacing="10px">
	<tr>
	  <td>Destinazione:</td>
	  <td>
	  <select id="destinazione" name="destinazione">
	  </select>
	  </td>
	</tr>
	<tr>
	  <td>Tipologia:</td>
	  <td>
	    <input type="text" id="tipologia" name="tipologia">
	  </td>
	</tr>
	<tr>
	  <td>Prezzo:</td>
	  <td><input type="text" class="duration_field" name="prezzo">€</td>
	</tr>
	</table>
	<br>
	  <button type="submit">Salva pernottamento</button>
	</form>
	<?php
	  include_once 'database.php';
	  if($_SERVER["REQUEST_METHOD"]=="POST"){
	    if(isset($_POST["destinazione"]) && isset($_POST["tipologia"]) && isset($_POST["prezzo"]) && is_numeric($_POST["prezzo"])){
	      $destinazione=$_POST["destinazione"];
	      $tipologia=mysql_real_escape_string(trim($_POST["tipologia"]));
	      $prezzo=$_POST["prezzo"];
	      $conn = database::dbConnect();
	      $sql="INSERT INTO pernottamento (prezzo,tipo,id_destinazione) VALUES('".$prezzo."','".$tipologia."','".$destinazione."')";
	      database::qInsertInto($conn,$sql);
	      echo "Pernottamento ".$tipologia." inserito.";
	    }
	    else{
	      echo "Errore. Ricontrollare i campi.";
	    }
	  }
	?>
	</div>
	<div id="navigation">
	  <br>
	  <div class="btn_navigation"><a href="aggiungipacchetto.php">Aggiungi</a></div>
	  <div class="btn_navigation"><a href="gestioneprofilo.php">Profilo</a></div>		
  	</div>
      </div> 
      <div id="footer">
      <div>footer</div>
      </div>
    </div>
  </body>
</html>
 

 
 
