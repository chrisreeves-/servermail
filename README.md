# servermail
Manage Dovecot mail server credentials in MySQL (written in PHP)

<h2> Overview: </h2>

PHP driven web console for managing the MySQL database credentials for Dovecot mail servers.

<h2> Config: </h2>

Modify the following in config.php

	$servername = "localhost"; 	<---- servername 
	$username = "dbusername";	<---- database username
	$password = "dbpassword";	<---- database password
	$dbname = "servermail";		<---- database name


	$loginusername = 'username';	<---- web console username
	$loginpassword = 'password';	<---- web console password
