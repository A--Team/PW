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
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyALJFXOqMUIY1-0Ghc8BFjXSe0vo746jzc&sensor=false"></script>
    <script type="text/javascript" src="js/maps.js"></script>
    <script type="text/javascript">google.maps.event.addDomListener(window, 'load', initialize);</script>    
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
		<div id="googleMap" style="margin-right:30px; margin-top: 40px; width:400px;height:350px; float: right;"></div>
		<script>
		$(window).load(function(){
		   addMarker("Agenzia", 45.56374, 10.23261); 
		});		
		</script>
		<div style="margin-top:40px; margin-left:15px;">
		<h2>Agenzia Viaggi</h2>
		<h3>Via Branze 38, Brescia, Italia.</h3>
		</div>
	</div>
	<div id="navigation">
	  
	</div>
      </div> 
      <div id="footer">
	<div>footer</div>
      </div>
    </div>
  </body>
</html>
 
