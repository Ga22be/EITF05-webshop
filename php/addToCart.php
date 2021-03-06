<?php

session_start();

if (isset($_POST['id']) && isset($_POST['amount'])
	&& isset($_POST['sessionId']) && $_POST['sessionId'] == session_id()) {
  $id = $_POST['id'];
  $amount = $_POST['amount'];

  if (!isset($_SESSION['cart'])) {
    $cart = [];
  } else {
    $cart = $_SESSION['cart'];
  }

  if (!empty($id) && $amount > 0) {

		if (isset($cart[$id])) {
			$cart[$id] += $amount;
		} else {
			$cart[$id] = $amount;
		}

    $_SESSION['cart'] = $cart;
    if(!isset($_SESSION['cartItems'])){
      $_SESSION['cartItems'] = 0;
    }
    $_SESSION['cartItems'] += $amount;

    $response = [
      'error' => false,
      'id' => $id,
      'totalAmount' => $cart[$id],
      'msg' => 'Amount was added to cart.'
    ];
  } else {
    $response = [
      'error' => true,
      'msg' => 'Zero and negative amounts forbidden.'
    ];
  }
} else {
  $response = [
    'error' => true,
    'msg' => 'Fatal error'
  ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>
