<?php
	session_start();

	if (!isset($_SESSION['madepurchase']) || $_SESSION['madepurchase'] != true) {
		die(header('location: ../pages/home.php'));
	}

	$_SESSION['madepurchase'] = false;
	unset($_SESSION['cart']);

	print $_SESSION['username'] + " RECEIPT";
?>
