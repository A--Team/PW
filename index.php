<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
    $(function(){
      $("#datepicker1").datepicker({ dateFormat: 'yy-mm-dd' }).val();
      $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' }).val();
    });
    </script>
    <script>
    function minus(){
      if($('#duration').val()>1)
	$('#duration').val(parseInt($('#duration').val())-1);
    }
    function plus(){
      if($('#duration').val()<20)
	$('#duration').val(parseInt($('#duration').val())+1);
    }
    </script>
  </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
			<span class="ribbon">
				<a href="index.php"><span>Home</span></a>
				<a href="catologo.php"><span>Catalogo</span></a>
				<a href="dovesiamo.php"><span>Dove siamo</span></a>
				<a href="contatti.php"><span>Contatti</span></a>
			</span>			
	</div>
	<div id="login">
		<?php
			session_start();
			//carico script contenente i parametri di configurazione
			include_once 'config.php';
			//controllo esistenza della sessione
			if(isset($_SESSION[$session_name])){
				echo "<br><br><h2>Benvenuto<a href='homepersonale.php'> " . $_SESSION['username'] . "!</a></h2><br>";
				echo "<form method='POST' action='logout.php'>
						<input type='submit' value='logout' class='btn_login'>
					  </form>";
			}
			else{
				include 'login_form.php';
			}
		?>
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<?php
			include 'pacchetto.php';
			$pacchetti=new pacchetto('home');
			$pacchetti->stampa();
		?>
	</div>
	<div id="navigation">
	  <br>
	  <div class="search_space">
	  <h3>Cerca il tuo viaggio:</h3>
	  <br>
	  <table>
	  <tr>
	  <td>Continente:</td>
	  <td>
	    <select id="continent" onchange='aggiorna_citta()'>
	      <option value="" disabled selected>Seleziona</option>
	      <option value="africa">Africa</option>
	      <option value="america">America</option>
	      <option value="asia">Asia</option>
	      <option value="europa">Europa</option>
	      <option value="oceania">Oceania</option>
	    </select>
	  </td>
	  </tr>
	  <tr>
	  <td>Città:</td>
	  <td>
	    <select id="city" disabled>
	    </select>
	  </td>
	  </tr>
	  <tr>
	  <td>Tipologia:</td>
	  <td>
	    <select id="type">
	      <option value="culturale">Culturale</option>
	      <option value="relax">Relax</option>
	      <option value="divertimento">Divertimento</option>
	    </select>
	  </td>
	  </tr>
	  <tr>
	  <td>Durata max:</td>
	  <td>
	  <button type="button" onclick="minus()">-</button><input type="text" id="duration" value="1" class="duration_field" readonly><button type="button" onclick="plus()">+</button>
	  </td>
	  </tr>
	  <tr>
	  <td>N. persone:</td>
	  <td>
	    <select id="npersons">
	    <option value="1">1</option>
	    <option value="2">2</option>
	    <option value="3">3</option>
	    <option value="4">4</option>
	    <option value="6">6</option>
	  </select>
	  </td>
	  </tr>
	  </table>
	  <h5>Quando vuoi viaggiare?</h5>
	  <table>
	  <tr>
	    <td>
	      Dal:
	    </td>
	    <td>
	      <input type="text" id="datepicker1" name="data_partenza1" class="date_input"/>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Al:
	    </td>
	    <td>
	      <input type="text" id="datepicker2" name="data_partenza2" class="date_input"/>
	    </td>
	  </tr>
	  </table>
	  <button type="button" onclick='search()'>Cerca</button>
	  <div id="err_content"></div></div>
	</div>
      </div> 
      <div id="footer">
	<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
