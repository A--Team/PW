<?php
  include_once 'database.php';
    if(strlen($_FILES["file"]["name"])>0 && ($_FILES["file"]["type"]=="image/jpg" || $_FILES["file"]["type"]=="image/jpeg") && ($_FILES["file"]["size"]/1024)<=1536){
      $continente=$_POST["continente"];
      $citta=mysql_real_escape_string(strtolower(trim($_POST["citta"])));
      $tipologia=mysql_real_escape_string(trim($_POST["tipologia"]));
      $descrizione=mysql_real_escape_string(trim($_POST["descrizione"]));
      $file=$_FILES["file"];
      $nome_file=mysql_real_escape_string($file["name"]);
      $conn = database::dbConnect();
      $sql="INSERT INTO destinazione (continente,citta,tipo,foto,descrizione,visible) VALUES('".$continente."','".$citta."','".$tipologia.
      "','".$nome_file."','".$descrizione."','1')";
      database::qInsertInto($conn,$sql);
      mysql_close($conn);
      move_uploaded_file($file["tmp_name"],"../style/images/dest/".$nome_file);
    }
    else
      echo "Errore. File non valido.";
?> 
