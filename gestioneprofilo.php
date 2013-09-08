<?php
	session_start();
	include_once '/php/config.php';
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
	  <?php
	    include '/php/menu.php';
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
			include_once '/php/database.php';
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
						<table cellpadding=0 cellspacing=0>
						<tr><td><h4>Nome:</h4></td><td><input type='text' size=30 class='input' name='nome' value='".$utente['nome']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Cognome:</h4></td><td><input type='text' size=30 class='input' name='cognome'value='".$utente['cognome']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Codice Fiscale:</h4></td><td><input type='text' size=30 class='input' name='cf' value='".$utente['cf']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>E-Mail:</h4></td><td><input type='text' size=30 class='input' name='mail' value='".$utente['mail']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Indirizzo:</h4></td><td><input type='text' size=30 class='input' name='indirizzo' value='".$utente['indirizzo']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Telefono:</h4></td><td><input type='text' size=30 class='input' name='tel' value='".$utente['tel']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Username:</h4></td><td><input type='text' size=30 class='input' name='username' value='".$utente['user']."'></td><td style='color:red;font-weight:bold'>*</td></tr>
						<tr><td><h4>Nuova password:</h4></td><td><input type='password' size=30 class='input' name='password'></td></tr>
						<tr><td><h4>Reinserici password:&nbsp;</h4></td><td><input type='password' size=30 class='input' name='conf_password'></td></tr>
						</table>
						<br><input class='btn_commenta' type='button' value='modifica' onclick='check_reg(\"m\")'>
					</form>
					<br>
					</div>";
				echo $html;
	
		?>
	</div>
	<div id="navigation">
    	<br>
		<div id='vert_menu'>
			   <a href='homepersonale.php'><span>La mia home</span></a>			
			   <a href='ordini.php'><span>Le mie prenotazioni</span></a>
			   <a href='wish_list.php'><span>I miei desideri</span></a>
			   <a href='storico.php'><span>I miei viaggi</span></a>
			   <a href='gestioneprofilo.php' id="selected"><span>Il mio profilo</span></a>			
		</div>	  
  	</div>
      </div> 
      <div id="footer">
		<?php
	    	include '/php/footer.php';
	  	?>
      </div>
    </div>
  </body>
</html>
 