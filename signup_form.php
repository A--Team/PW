<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="./js/check_form.js"></script>
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
			session_start();
			//carico script contenente i parametri di configurazione
			include_once 'config.php';
			//controllo esistenza della sessione
			if(isset($_SESSION[$session_name])){
				//attivo la sessione
				//$_SESSION[$session_name] = true;
				echo "<br><br><h2>Benvenuto " . $_SESSION['username'] . "!</h2><br>";
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
			if(isset($_GET['registered'])){
				echo "<p><h2>Registrazione effettuata con successo!</h2></p>
					  <a href='index.php'>Torna alla Home</a>";
			}
			else
			{
				if(isset($_GET['errore']))
				{
					echo "<h4>Il nome utente inserito esiste già</h4>";
				}
		?>
		<form method="POST" name="reg_form" action="signup.php">
			<table>
				<tr>
					<td colspan='2'><h3>Compilare il seguente modulo con i propri dati:</h3></td>
				</tr>
				<tr>
					<td class="td_left">Codice Fiscale:</td><td><input type="text" name="cf" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Nome:</td><td><input type="text" name="nome" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Cognome:</td><td><input type="text" name="cognome" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">E-Mail:</td><td><input type="text" name="mail" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Indirizzo:</td><td><input type="text" name="indirizzo" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Telefono:</td><td><input type="text" name="tel" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Username:</td><td><input type="text" name="username" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Password:</td><td><input type="password" name="password" size="50"></td>
				</tr>
				<tr>
					<td class="td_left">Conferma Password:</td><td><input type="password" name="conf_password" size="50"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="button" value="Registrati" onclick="check_reg('r')"></td>
				</tr>
			</table>
		</form>
	<?php } ?> 
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
 
