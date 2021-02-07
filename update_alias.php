<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$source = $_POST['source'];
	$destination = $_POST['destination'];
	$id = $_POST['id'];
	$domian_id = $_POST['domainid'];

	$sql = "update virtual_aliases set source='$source', destination= '$destination', domain_id= $domian_id where id=$id";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>