<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	
	$id = $_POST['id'];
	$domain = $_POST['domain'];

	$sql = "update virtual_domains set name='$domain' where id=$id";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>