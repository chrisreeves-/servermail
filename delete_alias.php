<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$id = $_POST['id'];

	$sql = "delete from virtual_aliases where id=$id";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>