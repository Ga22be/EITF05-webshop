<?php
session_start();

require_once('../php/database.php');

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

	foreach ($_SESSION['cart'] as $key => $value) {
		print $itemNames[$key] . ' ' . $value . '<br>';
	}
//} else {
	//echo '<b>Cart is empty.</b>';
//}
?>


