<?php
	include_once 'database.php';
    $id = $_POST['id'];
	$conn=database::dbConnect();
	$sql = "DELETE FROM `pacchetto` WHERE `id` = $id";
	database::qDelete($conn,$sql);
	database::dbClose();
?>