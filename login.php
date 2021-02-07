
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ServerMail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--   <script src="config/config.js"></script>
  <script src="vmmain.js"></script> -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <style type="text/css">
    .header-bar {}
  </style>



</head>
<body>
  <div class="container">
    <div class="page-header">
    <h1><span class="text-success">ServerMail</span></h1>

    </div>
  <div class="content">
  <div class="row header-bar">
    <div class="col-sm-6"></div>
    <div class="col-sm-2">
<?php
session_start();
/* DECLARE VARIABLES */

include "config.php";

$random1 = 'secret_key1';
$random2 = 'secret_key2';
$hash = md5($random1 . $loginpassword . $random2);
$self = $_SERVER['REQUEST_URI'];
/* USER LOGOUT */
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
}
/* USER IS LOGGED IN */
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash)
{
	logged_in_msg($loginusername);
}
/* FORM HAS BEEN SUBMITTED */
else if (isset($_POST['submit']))
{
	if ($_POST['username'] == $loginusername && $_POST['password'] == $loginpassword)
	{
		//IF USERNAME AND PASSWORD ARE CORRECT SET THE LOGIN SESSION
		$_SESSION["login"] = $hash;
		header("Location: $_SERVER[PHP_SELF]");
	}
	else
	{
		// DISPLAY FORM WITH ERROR
		display_login_form();
		display_error_msg();
	}
}
/* SHOW THE LOGIN FORM */
else
{
	display_login_form();
}
/* TEMPLATES */
function display_login_form()
{
	echo '<form action="' . isset($self) . '" method="post">' .
			 '<label for="username">username</label>' .
			 '<input type="text" name="username" id="username">' .
			 '<label for="password">password</label>' .
			 '<input type="password" name="password" id="password">' .
			 '<input type="submit" name="submit" value="submit">' .
		 '</form>';
}
function logged_in_msg($username)
{
	header('Location: index.php');
	echo '<p>Hello ' . $loginusername . ', you have successfully logged in!</p>' .
		 '<a href="?logout=true">Logout?</a>';
}
function display_error_msg()
{
	echo '<p>Username or password is invalid</p>';
}
?>

		</div>
    <div class="col-sm-1"></div>
  </div>