<?php
session_start();
require_once('../php/database.php');

if(!isset($_SESSION['username'])) { // Make sure to use a good variable
	die(header('location: ../index.php'));
}

$db = new Database();
$items = $db->getItems();

$itemNames = [];
foreach($items as $key) {
	$itemNames[$key['_id']] = [htmlspecialchars($key['name']), htmlspecialchars($key['price'])];
}
?>

<!DOCTYPE html> <html lang="en">
<head>
	<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' ajax.googleapis.com fonts.googleapis.com *.code.jquery.com fonts.gstatic.com;">
	<meta charset="UTF-8">
	<title>Sidenvägen</title>
	<link href="/favicon.ico" rel="icon" type="image/x-icon" />
	<style type="text/css">
		@import 'https://fonts.googleapis.com/css?family=Roboto';
		@import '../css/input.css';
		@import '../css/cart.css';
		@import '../css/global.css';
	</style>
</head>
<body>
	<div id="topBar">
		<div id="header">
			<a href='home.php'>Sidenvägen</a>
		</div>
		<div id="user">
			<?php echo '<span id="userName">' . $_SESSION['username'] . '</span>' ?>
		</div>
		<div id="cartContent">
			<img id="cartImg" src="../pictures/cart.png"></img>
			<div id="cartAmount">
<?php
//isset is needed for WAMP, otherwise an error is produced
if (isset($_SESSION['cartItems']) && count($_SESSION['cartItems']) > 0) {
	echo $_SESSION['cartItems'];
} else {
	echo 0;
}
?>
			</div>
		</div>
		<div id='topButtons'>
			<button id="btn-logout" class="btn-top waves-effect" onclick="location.href = '../php/logout.php';">Logout</button>
		</div>
	</div>
	<div id="cartContainer">
		<table <?php if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {echo "class=\"hide\"";} ?>>
			<tr id='tHeader'>
				<th id='product'>Product</th><th>Amount</th><th>Price/Item</th><th>Price</th>
			</tr>
<?php
$total = 0;
if (isset($_SESSION['cart'])) {
	foreach ($_SESSION['cart'] as $key => $value) {
		echo "<tr>";
		echo "<td id='product'>" . $itemNames[$key][0] . "	</td>";
		echo "<td id='amount'>" . $value . "</td>";
		echo "<td id='price/item'>" . '$' . $itemNames[$key][1] . "</td>";
		echo "<td id='price'>" . '$' . $itemNames[$key][1]*$value . "</td>";
		echo "</tr>";
		$total += $itemNames[$key][1]*$value;
	}
}
echo "<tr><td></td><td></td><td></td><td id='sum'>" . '$' . $total . "</td></tr>";
?>
		</table>
	</div>
	<div id="purchaseContainer">
		<div id="resp"></div>

		<br>

		<!-- login form-->
		<form method="post" id="form-login">
			<input type="hidden" placeholder="Username" name="username">
			<input type="password" placeholder="Password" name="password">
			<input type="hidden" name="ispurchase" value="true">
			<button id="btn-login">Purchase</button>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src='../js/cart.js'></script>
</body>
</html>
