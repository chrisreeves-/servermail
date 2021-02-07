<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$domain = $_POST['domain'];

	$sql = "INSERT INTO virtual_domains(name) VALUES ('$domain')";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>