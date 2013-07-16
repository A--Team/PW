<?php
	//carico script contenente i parametri di configurazione
	include_once 'config.php';
	
	session_start();
    if(isset($_SESSION[$session_name])){
	    //elimino ogni dato relativo alla sessione
	    $_SESSION = array();
	    if(isset($_COOKIE[session_name()]))
	        setcookie(session_name(), '', time()-42000);
	    session_destroy();
		header("Refresh: 0;url=index.php");  
	}
?>