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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
	  $(function() {
    		$( "#datepicker" ).datepicker({dateFormat:'yy-mm-dd'}).val;
  		});
  </script>
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
				echo "<br><br><h2>Benvenuto<a href='agenzia.php'> " . $_SESSION['username'] . "!</a></h2><br>";
		?>
        <form method='POST' action='logout.php'>
					<input type='submit' value='logout' class='btn_login'>
		 </form>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			include 'database.php';
			$conn=database::dbConnect();
			if(isset($_POST['id_pacchetto']))
			{
				extract($_POST);
				$query="UPDATE pacchetto SET persone='".$persone."',durata='".$durata."',
				data_partenza= '".$data."',id_trasporto='".$trasporto."',id_pernottamento='".$pernottamento."'
				WHERE id='".$id_pacchetto."'";
				database::qUpdate($conn,$query);
				$query="DELETE FROM rel_attrazioni	WHERE id_pacchetto='".$id_pacchetto."'";
				database::qDelete($conn,$query);
				if(isset($attrazioni))
				{
					foreach($attrazioni as $idattr)
					{
						$query="INSERT INTO rel_attrazioni (id_attrazione,id_pacchetto) VALUE ('".$idattr."','".$id_pacchetto."')";
						database::qInsertInto($conn,$query); 
					}
				}
				echo "<h3>Modifiche apportate con successo</h3>";
				
		}
		
		
		
		
			if(isset($_GET['id_pacchetto']))
				$id_pacchetto=$_GET['id_pacchetto'];
			
			$query="SELECT * FROM pacchetto WHERE id='".$id_pacchetto."'";
			
			$result=database::qSelect($conn,$query);
			$pacchetto=mysql_fetch_array($result);
			$query="SELECT * FROM pernottamento WHERE id_destinazione='".$pacchetto['id_destinazione']."'";
			$pernottamenti=database::qSelect($conn,$query);
			$id_pernottamento_pacchetto=$pacchetto['id_pernottamento'];
			$query="SELECT * FROM trasporto WHERE id_destinazione='".$pacchetto['id_destinazione']."'";
			$trasporti=database::qSelect($conn,$query);
			$id_trasporto_pacchetto=$pacchetto['id_trasporto'];
			$query="SELECT * FROM attrazioni WHERE id_destinazione='".$pacchetto['id_destinazione']."'";
			$attrazioni=database::qSelect($conn,$query);
			$query="SELECT id_attrazione FROM rel_attrazioni WHERE id_pacchetto='".$id_pacchetto."'";
			$attrazioni_pacchetto=database::qSelect($conn,$query);
			$id_attrazioni_pacchetto= array();
			while($id=mysql_fetch_array($attrazioni_pacchetto))
			{
				$id_attrazioni_pacchetto[]=$id['id_attrazione'];
			}
			$html="
				<form method='post' action='modifica.php'>
					<table>	
						<tr><td>Numero persone</td><td><input type='text' name='persone' value='".$pacchetto['persone']."'></td></tr>
						<tr><td>Durata viaggio</td><td><input type='text' name='durata' value='".$pacchetto['durata']."'></td></tr>
						<tr><td>Data partenza</td><td><input type='text' id='datepicker' name='data' value='".$pacchetto['data_partenza']."'></td></tr>";
			$html=$html."<tr><td colspan='2'>Pernottamenti possibili</td></tr>";			
			while($pernottamento=mysql_fetch_array($pernottamenti))
			{
				$radio="<tr><td><input type='radio' name='pernottamento' value='".$pernottamento['id']."'";
				if($pernottamento['id']==$id_pernottamento_pacchetto)
					$radio=$radio."checked";
				$radio=$radio."></td><td>".$pernottamento['tipo']." a ".$pernottamento['prezzo']." euro</td></tr>";
				$html=$html.$radio;
			}
			$html=$html."<tr><td colspan='2'>Trasporti possibili</td></tr>";			
			while($trasporto=mysql_fetch_array($trasporti))
			{
				$radio="<tr><td><input type='radio' name='trasporto' value='".$trasporto['id']."'";
				if($trasporto['id']==$id_trasporto_pacchetto)
					$radio=$radio."checked";
				$radio=$radio."></td><td>".$trasporto['tipo']." a ".$trasporto['prezzo']." euro</td></tr>";
				$html=$html.$radio;
			}
			$html=$html."<tr><td colspan='2'>Attrazioni possibili</td></tr>";			
			while($attrazione=mysql_fetch_array($attrazioni))
			{
				$checkbox="<tr><td><input type='checkbox' name='attrazioni[]' value='".$attrazione['id']."'";
				if(in_array($attrazione['id'],$id_attrazioni_pacchetto))
					$checkbox=$checkbox."checked";
				$checkbox=$checkbox."></td><td>".$attrazione['tipo']." a ".$attrazione['prezzo']." euro</td></tr>";
				$html=$html.$checkbox;
			}
			
			$html=$html."</table><input type='hidden' name='id_pacchetto' value='".$id_pacchetto."'><input class='btn_commenta' type='submit' value='modifica'> </form>";
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
