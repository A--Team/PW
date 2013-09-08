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
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    </head>
  <body>
    <div id="container">
    <div id="header_container">
	<div id="logo">
	  <?php
	    include './php/menu.php';
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
		<div style="margin-top:40px; margin-left:15px;">
		<table>
			<tr><td colspan="2"><h2>Agenzia Viaggi</h2></td></tr>
			<tr><td><h3>Indirizzo: </h3></td><td><h4>Via Branze 38, Brescia, Italia.</h4></td></tr>
			<tr><td><h3>Tel: </h3></td><td><h4>030/3715685</h4></td></tr>
			<tr><td><h3>E-mail: </h3></td><td><a href="mailto:agenzia@agenziaviaggi.it" target="_blank"><h4>agenzia@agenziaviaggi.it</h4></a></td></tr>
		</table>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="float:left; padding-right: 25px;"><a href=#><img src="https://www.facebook.com/images/fb_icon_325x325.png" width="50" height="50"/></a></td>
				<td style="float:left; padding-right: 25px;"><a href=#><img src="http://www.swlondonsystem.org/about-us/images/twitter-icon-png-13.png" width="50" height="50"/></a></td>
				<td style="float:left; padding-right: 25px;"><a href=#><img src="http://www.futuraimmagine.com/images/stories/febb2012/tum/google-Plus-icon.png" width="50" height="50"/></a></td>
			</tr>
		</table>
		</div>
	</div>
	<div id="navigation">
	  
	</div>
      </div> 
      <div id="footer">
		<?php
	    	include './php/footer.php';
	  	?>
      </div>
    </div>
  </body>
</html>
 
