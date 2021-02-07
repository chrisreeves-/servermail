<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$email = $_POST['email'];
	$password = $_POST['password'];
	$id = $_POST['id'];
	$domian_id = $_POST['domainid'];

	$sql = "update virtual_users set email='$email', password= ENCRYPT('$password', CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))), domain_id= $domian_id where id=$id";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>