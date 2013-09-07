<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="./js/ajax.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
    $(function(){
    	$.datepicker.setDefaults($.datepicker.regional['it']);
    	$("#datepicker1").datepicker({ dateFormat: 'dd/mm/yy' }).val();
    	$("#datepicker2").datepicker({ dateFormat: 'dd/mm/yy' }).val();
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
	  <?php
	    include 'menu.php';
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
			include 'pacchetto.php';
			$pacchetti=new pacchetto('home',[]);
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
	    <select id="continent" class="input" onchange='aggiorna_citta()'>
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
	    <select id="city" class="input" disabled>
	    </select>
	  </td>
	  </tr>
	  <tr>
	  <td>Tipologia:</td>
	  <td>
	    <select id="type" class="input">
	      <option value="culturale">Culturale</option>
	      <option value="relax">Relax</option>
	      <option value="divertimento">Divertimento</option>
	    </select>
	  </td>
	  </tr>
	  <tr>
	  <td>Durata max:</td>
	  <td>
	  <button type="button" class="input" style="width:20px; text-align:center;" onclick="minus()">-</button><input type="text" id="duration" class="input" style="width:30px; text-align:center;" value="1" class="duration_field" readonly><button type="button" class="input" style="width:20px; text-align:center;" onclick="plus()">+</button>
	  </td>
	  </tr>
	  <tr>
	  <td>N. persone:</td>
	  <td>
	    <input type="text" id="npersons" class="input" style="width:25px; text-align:center;"><br>
	  </td>
	  </tr>
	  </table>
	  <h5>Quando vuoi partire?</h5>
	  <table>
	  <tr>
	    <td>
	      Dal:
	    </td>
	    <td>
	      <input type="text" id="datepicker1" name="data_partenza1" class="date_input input"/>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Al:
	    </td>
	    <td>
	      <input type="text" id="datepicker2" name="data_partenza2" class="date_input input"/>
	    </td>
	  </tr>
	  </table>
	  <br>
	  <button type="button" class="btn_commenta" onclick='search()'>Cerca</button>
	  <div id="err_content"></div></div>
	</div>
      </div> 
      <div id="footer">
	<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
