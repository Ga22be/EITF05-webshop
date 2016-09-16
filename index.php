<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8">
	<title>Sidenvägen</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Roboto';
		@import 'css/index.css';
		@import 'css/global.css';
	</style>
</head>
<body>
	<div id="container">
		<h1>Welcome to Sidenvägen</h1>

		<div id="resp"></div>
		<br>
		<form method="post" id="form-logreg">
			<input type="text" placeholder="Username" name="username"></input>
			<input type="password" placeholder="Password" name="password"></input>
			
			<button id="btn-login">Login</button>
			<button id="btn-register">Register</button>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>
