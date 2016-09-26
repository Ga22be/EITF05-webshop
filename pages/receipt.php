<?php
session_start();

if (!isset($_SESSION['madepurchase']) || $_SESSION['madepurchase'] != true) {
	die(header('location: ../pages/home.php'));
}

require_once('../php/database.php');

$db = new Database();
$items = $db->getItems();

$itemNames = [];
foreach($items as $key) {
	$itemNames[$key['_id']] = [$key['name'], $key['price']];
}


?>
<table <?php if(count($_SESSION['cart']) == 0) {echo "class=\"hide\"";} ?>>
	<tr id='tHeader'>
		<th id='product'>Product</th>
		<th>Amount</th>
		<th>Price/Item</th>
		<th>Price</th>
	</tr>

<?php
$total = 0;
foreach ($_SESSION['cart'] as $key => $value) {
	echo "<tr>";
	echo "<td id='product'>" . $itemNames[$key][0] . "	</td>";
	echo "<td id='amount'>" . $value . "</td>";
	echo "<td id='price/item'>" . '$' . $itemNames[$key][1] . "</td>";
	echo "<td id='price'>" . '$' . $itemNames[$key][1]*$value . "</td>";
	echo "</tr>";

	$total += $itemNames[$key][1]*$value;
}
echo "<tr><td id='total'>Total:</td><td></td><td></td><td>" . '$' . $total . "</td></tr>";
?>
</table>
<br>

<?php
echo 'Thank you for your purchase, ' . $_SESSION['username'] . '.<br>';
echo 'Arrival date: 2020-01-03 <br>';
echo 'Address for delivery: ' . $_SESSION['address'] . '<br>';

$_SESSION['madepurchase'] = false;
unset($_SESSION['cart']);
unset($_SESSION['cartItems']);

?>
