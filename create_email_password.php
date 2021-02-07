<?php
	include "./config.php";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$email = $_POST['email'];
	$password = $_POST['password'];
	$domainid = $_POST['domainid'];

	// $sql = "INSERT INTO virtual_users(domain_id, password, email) VALUES ($domainid, '".md5($password)."', '$email')";
	

	$sql = "INSERT INTO `servermail`.`virtual_users`(`domain_id`, `password` , `email`)VALUES($domainid, ENCRYPT('$password', CONCAT('$6$', SUBSTRING(SHA(RAND()), -16))), '$email')";
	mysqli_query($conn, $sql);

	echo json_encode(array("success" => 1,"msg"=> $sql));
?>