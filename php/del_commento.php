<?php
  include_once 'database.php';
  $id_comm = $_POST['id_comm'];
  $conn=database::dbConnect();
  $sql = "DELETE FROM `commento` WHERE `id` = $id_comm";
  database::qDelete($conn,$sql);
  database::dbClose();
?>