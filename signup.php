<?php
	//carico script di interfaccia al database
    include_once 'database.php';
	
    //Recupero i valori inseriti nel form
	 $cf = nl2br(htmlentities($_POST['cf']));
	 $nome = nl2br(htmlentities($_POST['nome']));
	 $cognome = nl2br(htmlentities($_POST['cognome']));
	 $mail = nl2br(htmlentities($_POST['mail']));
	 $indirizzo = nl2br(htmlentities($_POST['indirizzo']));
	 $tel = nl2br(htmlentities($_POST['tel']));
	 $username = nl2br(htmlentities($_POST['username']));
	 $password = nl2br(htmlentities($_POST['password']));
	 
	//Calcolo l'hash della password
	 $hashPsw = hash('sha256', $password);
	//Preparo la query di inserimento al database
	 $sql = "INSERT INTO `tourdb`.`utente` (`cf`, `nome`, `cognome`, `mail`, `indirizzo`, `tel`, `user`, `password`) VALUES 
	 		('$cf', '$nome', '$cognome', '$mail', '$indirizzo', '$tel', '$username', '$hashPsw');";
			
	//Creo una connessione al database
	 $conn = database::dbConnect();
	//Eseguo la query
	 database::qInsertInto($conn,$sql);
	 mysql_close();
	 
	//Ricarico la pagina
	header("Refresh: 0;url=signup_form.php?registered=1");
?>