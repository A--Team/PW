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
	  <button type="button" class="bottone_sottomenu" onclick="location.href='aggiungidestinazione.php'">Aggiungi destinazione</button>
	  <button type="button" onclick="location.href='aggiungitrasporto.php'">Aggiungi trasporto</button>
	  <button type="button" onclick="location.href='aggiungipernottamento.php'">Aggiungi pernottamento</button>
	  <button type="button" onclick="location.href='aggiungiattrazione.php'">Aggiungi attrazione</button>
	</div>
	<h2 class="title_space">Aggiungi destinazione</h2>
	<br>
	<br>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="title_space">
	<table cellspacing="10px">
	<tr>
	  <td>Continente:</td>
	  <td>
	  <select id="continente" name="continente">
	    <option value="" disabled selected>Seleziona continente</option>
	    <option value="africa">Africa</option>
	    <option value="america">America</option>
	    <option value="asia">Asia</option>
	    <option value="europa">Europa</option>
	    <option value="oceania">Oceania</option>
	  </select>
	  </td>
	</tr>
	<tr>
	  <td>Nome citt&agrave:</td>
	  <td><input type="text" id="citta" name="citta"></td>
	</tr>
	<tr>
	  <td>Tipologia:</td>
	  <td>
	    <input type="text" id="tipologia" name="tipologia">
	  </td>
	</tr>
	<tr>
	  <td>Carica foto(jpg,max 1.5MB):</td>
	  <td><input type="file" id="file" name="file"></td>
	</tr>
	<tr>
	  <td>Descrizione:</td>
	  <td><textarea id="descrizione" name="descrizione"></textarea></td>
	</tr>
	</table>
	<br>
	  <button type="submit">Salva destinazione</button>
	</form>
	<?php
	  include_once 'database.php';
	  if($_SERVER["REQUEST_METHOD"]=="POST"){
	    if(isset($_POST["continente"]) && isset($_POST["citta"]) && isset($_POST["tipologia"]) && strlen($_FILES["file"]["name"])>0 &&
	    ($_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/jpeg") && ($_FILES["file"]["size"]/1024)<=1536){
	      $continente=$_POST["continente"];
	      $citta=strtolower(trim($_POST["citta"]));
	      $tipologia=mysql_real_escape_string(trim($_POST["tipologia"]));
	      $descrizione=trim($_POST["descrizione"]);
	      $file=$_FILES["file"];
	      $citta=mysql_real_escape_string($citta);
	      $descrizione=mysql_real_escape_string($descrizione);
	      $nome_file=mysql_real_escape_string($file["name"]);
	      $conn = database::dbConnect();
	      $sql="INSERT INTO destinazione (continente,citta,tipo,foto,descrizione) VALUES('".$continente."','".$citta."','".$tipologia.
	      "','".$nome_file."','".$descrizione."')";
	      database::qInsertInto($conn,$sql);
	      move_uploaded_file($file["tmp_name"],"./style/images/dest/".$nome_file);
	      echo "Destinazione ".$citta."-".$tipologia." inserita.";
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
 

