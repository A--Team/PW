<?php
	//carico script contenente i parametri di configurazione
	include_once 'config.php';
	//carico script di interfaccia al database
    include_once 'database.php';
	
	//recupero username e password inseriti nella form
	$username = nl2br(htmlentities($_POST['username']));
    $password = nl2br(htmlentities($_POST['password']));
	//calcolo hash SHA256 della password inserita
    $hashPsw = hash('sha256', $password);
	
	//creo una connessione al database
    $conn = database::dbConnect();
    //recupero la password
    $sql = "SELECT `PASSWORD` FROM `utente` WHERE `user`=\"$username\"";
    $result = database::qSelect($conn, $sql);
    $record = mysql_fetch_array($result);
    mysql_close();
    $dbPsw = $record['PASSWORD'];
    //verifico matching tra la password inserita e quella salvata nel database
    //e se è giusta attivo la sessione, altrimenti scrivo che il login è fallito
    if(strcasecmp($hashPsw, $dbPsw) == 0){
    	session_start();
        //inserisco username e password come variabili di sessione
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        //attivo la sessione
        $_SESSION[$session_name] = true;		
        header("Refresh: 0;url=index.php");                      
    }
    else{
        header("Refresh: 0;url=index.php?bad_cred=1");        
    }
?>