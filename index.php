<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sidenvägen</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Roboto';
		@import 'css/input.css';
		@import 'css/index.css';
		@import 'css/global.css';
	</style>
</head>
<body>
	<div id="container">
		<h1>Welcome to Sidenvägen</h1>

<?php 
		print array_values($_COOKIE)[0] . '<br>';
		foreach ($_COOKIE as $item) {
			print $item . '<br>';
		}
?>

		<div id="resp"></div>
		<br>

		<!-- login form-->
		<form method="post" id="form-login">
			<input type="text" placeholder="Username" name="username"></input>
			<input type="password" placeholder="Password" name="password"></input>
			
			<button id="btn-login">Login</button>
			<button id="btn-toRegister">Register</button>
		</form>

		<!-- registration form -->
		<form method="post" id="form-register" class="hide">
			<input type="text" placeholder="Username" name="username"></input>
			<input type="password" placeholder="Password" name="password"></input>
			<input type="password" placeholder="Repeat password" name="rep_password"></input>
			<input type="text" placeholder="Address" name="address"></input>
			
			<button id="btn-toLogin">Go back</button>
			<button id="btn-register">Register</button>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>
