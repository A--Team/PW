<?php
  include_once 'database.php';

  if(strlen($_FILES["file_mod"]["name"])>0 && ($_FILES["file_mod"]["type"]=="image/jpg" || $_FILES["file_mod"]["type"]=="image/jpeg") && ($_FILES["file_mod"]["size"]/1024)<=1536){
    $destinazione=mysql_real_escape_string(strtolower(trim($_POST["destinazione"])));
    $citta=mysql_real_escape_string(strtolower(trim($_POST["citta_mod"])));
    $tipologia=mysql_real_escape_string(trim($_POST["tipologia_mod"]));
    $descrizione=mysql_real_escape_string(trim($_POST["descrizione_mod"]));
    $file=$_FILES["file_mod"];
    $nome_file=mysql_real_escape_string($file["name"]);
    $conn = database::dbConnect();
    $sql="UPDATE destinazione SET citta='".$citta."',tipo='".$tipologia."',descrizione='".$descrizione."',foto='".$nome_file."' WHERE id='".$destinazione."'";;
    database::qUpdate($conn,$sql);
    mysql_close($conn);
    move_uploaded_file($file["tmp_name"],"./style/images/dest/".$nome_file);
  }
  else
    echo "Errore. File non valido.";
?>  
