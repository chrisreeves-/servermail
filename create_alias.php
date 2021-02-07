<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$source = $_POST['source'];
	$destination = $_POST['destination'];
	$domainid = $_POST['domainid'];

	$sql = "INSERT INTO virtual_aliases(domain_id, source, destination) VALUES ($domainid, '$source', '$destination')";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>