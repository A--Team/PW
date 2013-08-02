<?php
	include_once 'database.php';
	//Recupero le variabili dal POST
    $dest = nl2br(htmlentities($_POST['id_dest']));
	$user = nl2br(htmlentities($_POST['id_user']));
	$corpo = nl2br(htmlentities($_POST['commento']));
	$voto = nl2br(htmlentities($_POST['voto']));
	$data = date("Y-m-d");
	//Eseguo la query di inserimento
	$conn=database::dbConnect();
	$sql = "INSERT INTO `commento`(`id_utente`, `id_destinazione`, `data`, `rating`, `testo`) VALUES (\"$user\",\"$dest\",\"$data\",\"$voto\",\"$corpo\")";
	database::qInsertInto($conn,$sql);
	//Recupero l'id del commento inserito
	$sql = "SELECT MAX(`id`) FROM `commento`";
	$result = database::qSelect($conn, $sql);
	$record = mysql_fetch_array($result);
	extract($record);
	database::dbClose();
	
	$output = "<br><div>";
	$output .= "<span class='tit_commento'>$user - ".strftime("%d %B %Y",strtotime($data))."</span>";					
	$output .= "<div class='rateit' data-rateit-value=$rating data-rateit-ispreset='true' data-rateit-readonly='true'></div><br>";					
	$output .= "<div class='corpo_commento'>$corpo</div>";
	$output .= "<input class='btn_elimina' type='button' value='Elimina' onclick='sendDelete(this,"."$id".")'><br></div>";
	
	echo "$output";

	
	//Restituisco i parametri alla funzione di callback
	/*$info = "<root>";
	$info .= "<dest>"+$dest+"</dest>";
	$info .= "<user>"+$user+"</user>";
	$info .= "<corpo>"+$corpo+"</corpo>";
	$info .= "<voto>"+$voto+"</voto>";
	$info .= "<data>"+$data+"</data>";
	$info .= "</root>";
	
	return xmlentities($info);
	*/
?>