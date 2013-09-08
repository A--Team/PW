<?php	
	header('Content-Type: text/xml');
	
	//Imposto localizzazione italiana per la visualizzazione delle date
	setlocale(LC_TIME, 'ita', 'it_IT.utf8');
	
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
	$sql = "SELECT MAX(`id`) AS `id` FROM `commento`";
	$result = database::qSelect($conn, $sql);
	$record = mysql_fetch_array($result);
	extract($record);
	database::dbClose();
		
	$output = "<div style='display: none'><br>";
	$output .= "<span class='tit_commento' id='tit_commento'>$user - ".strftime("%d %B %Y",strtotime($data))."</span>";					
	$output .= "<div class='rateit' id='comment_$id' data-rateit-value=$voto data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
	
	$output .= "<br>";
	
	$output .= "<div class='corpo_commento'>$corpo</div>";
	$output .= "<input class='btn_elimina' type='button' value='Elimina' onclick='sendDelete(this,$id)'><br><br></div></div>";		
	
	echo "$output";	
?>