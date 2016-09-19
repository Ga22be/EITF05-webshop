<?php
	session_start();
	require_once('../php/database.php');

	if(!isset($_SESSION['username'])) { // Make sure to use a good variable
		die(header('location: ../index.php'));
	}

//if (isset($_SESSION['cart'])) {
	$db = new Database();
	$items = $db->getItems();

	/*
	foreach($items as $key) {
		print $key['_id'];
		print $key['name'];
		print '<br>';
	}
	 */

	//$cart = [];
	$itemNames = [];

	foreach($items as $key) {
		//$cart[$key['_id']] = 3;
		$itemNames[$key['_id']] = $key['name'];
	}

	//$_SESSION['cart'] = $cart;

/*
	foreach ($_SESSION['cart'] as $key => $value) {
		print $itemNames[$key] . ' ' . $value . '<br>';
	}
*/
//} else {
	//echo '<b>Cart is empty.</b>';
//}
?>

<!DOCTYPE html> <html lang="en"> <head> <meta charset="UTF-8">
	<title>Sidenvägen</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Roboto';
		@import '../css/cart.css';
		@import '../css/global.css';
	</style>
</head>
<body>
	<div id="header">
    <h1>Here Goes The Title</h1>
  </div>
	<div id="container">
    <p>This is your current cart <?php echo $_SESSION['username'] ?></p>
	</div>
	<div id="cartContainer">
		<?php
			foreach ($_SESSION['cart'] as $key => $value) {
				echo "<div id=cartItem>";
				echo "<p id=iHeader>" . $itemNames[$key] . "</p>";
			}
		?>
	</div>
</body>
</html>
