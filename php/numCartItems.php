<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['cartItems'])){
  echo json_encode(0);
} else {
  echo json_encode($_SESSION['cartItems']);
}
?>
