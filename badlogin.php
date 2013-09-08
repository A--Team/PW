<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>Agenzia Viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="style/style.css">
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
	</div>
	</div>
      <div id="content_container">
	<div id="content">
		<h2>Le credenziali non sono esatte</h2>
        <p>Ricontrollare nome utente e password</p>
        <?php
			session_start();
			include 'login_form.php'
		?>
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
 
