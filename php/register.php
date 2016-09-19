<?php
session_start();

require_once('database.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rep_password']) && isset($_POST['address'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
 	$rep_password = $_POST['rep_password'];
	$address = $_POST['address'];

	$database = new Database();
	$query = 'SELECT * FROM users WHERE username = ?';
	$result = $database->executeQuery($query, array($username));

	$response = [];

	if (empty($username) || empty($password) || empty($rep_password) || empty($address)) {
		$response = [
			'error' => true,
			'msg' => 'One or more fields blank.'
		];
	} else if (empty($result)) {
		if ($password == $rep_password) {
			$query = 'INSERT INTO users VALUES(0, ?, ?, ?, DEFAULT, DEFAULT)';

			$pwhash = password_hash($password, PASSWORD_DEFAULT);
			
			$database->executeUpdate($query, array($username, $pwhash, $address));
			$response = [
				'error' => false,
				'msg' => 'Account created.'
			];
		} else {
			$response = [
				'error' => true,
				'msg' => 'Passwords must be equal.'
			];
		}
	} else {
		$response = [
			'error' => true,
			'msg' => 'Username already exists.'
		];
	}

	header('Content-Type: application/json');
	echo json_encode($response);
} else {
	$response = [
		'error' => true,
		'msg' => 'Fatal error, contact administration.'
	];

	header('Content-Type: application/json');
	echo json_encode($response);
}

?>
