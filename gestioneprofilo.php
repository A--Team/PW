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
	<script type="text/javascript" src="./js/check_form.js"></script>
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
			
			
			if(isset($_POST['nome']))
			{
				extract($_POST);
				//Se lo username è stato cambiato controllo che non esista già
				if($username!=$_SESSION['username'])
				{
					$query="SELECT * FROM utente WHERE user='".$username."'";
					$result=database::qSelect($conn,$query);	
					if($result!=NULL)
					{
						header("Refresh: 0;url=gestioneprofilo.php?errore=1");	 
					}
				}
				else
				{
					$hashpass="";
					if($password==NULL)
					{
						$hashpass=$_SESSION["password"];
					}
					else
					{
						$hashpass=hash('sha256',$password);
					}
					$query="UPDATE utente SET nome='".$nome."',cognome='".$cognome."',cf='".$cf."',mail='".$mail."',
							indirizzo='".$indirizzo."',tel='".$tel."',user='".$username."',password='".$hashpass."'
							WHERE user='".$_SESSION['username']."'";
					database::qUpdate($conn,$query);
					
					echo "<h3> Le modifiche sono state apportate con successo!</h3>";
					/*
					$nome=nl2br(htmlentities($_POST['nome']));
					$cognome=nl2br(htmlentities($_POST['cognome']));
					$cf=nl2br(htmlentities($_POST['cf']));
					$mail=nl2br(htmlentities($_POST['mail']));
					$indirizzo=nl2br(htmlentities($_POST['indirizzo']));
					$tel=nl2br(htmlentities($_POST['tel']));
					*/
				}
			}
				$user=$_SESSION['username'];
				$query="SELECT * FROM utente WHERE user='".$user."'";
				$result=database::qSelect($conn,$query);
				$utente=mysql_fetch_array($result);
				$html="<div>";
				if(isset($_GET['errore']))
				{
					$html=$html."<h3>Il nuovo username esiste già, sceglierne un'altro</h3>";
				}
				$html =$html."
					<form method='post'  name='reg_form' action='gestioneprofilo.php'>
						<table>
						<tr><td>Nome</td><td><input type='text' name='nome' value='".$utente['nome']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Cognome</td><td><input type='text' name='cognome'value='".$utente['cognome']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Codice Fiscale</td><td><input type='text' name='cf' value='".$utente['cf']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>E-Mail</td><td><input type='text' name='mail' value='".$utente['mail']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Indirizzo</td><td><input type='text' name='indirizzo' value='".$utente['indirizzo']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Telefono</td><td><input type='text' name='tel' value='".$utente['tel']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Username</td><td><input type='text' name='username' value='".$utente['user']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td>Nuova password</td><td><input type='password' name='password'></td></tr>
						<tr><td>Reinserici password</td><td><input type='password' name='conf_password'></td></tr>
						</table>
						<input type='button' value='modifica' onclick='check_reg(\"m\")'>
					</form>
					</div>";
				echo $html;
	
		?>
	</div>
	<div id="navigation">
    			<br>
				<div class="btn_navigation"><a href="#">Le mie prenotazioni</a></div>
				<div class="btn_navigation"><a href="#">I miei desideri</a></div>
                <div class="btn_navigation"><a href="#">I miei viaggi</a></div>
                <div class="btn_navigation"><a href="gestioneprofilo.php">Profilo</a></div>		
  	</div>
      </div> 
      <div id="footer">
		<div>footer</div>
      </div>
    </div>
  </body>
</html>
 