<?php
session_start();

require_once('database.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$isLogin = false;

	$database = new Database();

	$query = 'SELECT password, salt FROM users WHERE username = ?';
	$result = $database->executeQuery($query, array($username));

	$response = [];
	if (!empty($result)) {
		$pwhash = $database->passwordHash($password, $result[0]['salt']);
		if ($pwhash == $result[0]['password'])  {
			$response['error'] = false;
			$isLogin = true;
			$_SESSION['username'] = $username;
		}
	}

	if (empty($username) || empty($password)) {
		$response = [
			'error' => true,
			'msg' => 'One or more blank fields.'

		];
	} else if ($isLogin == false) {
		$response = [
			'error' => true,
			'msg' => 'Invalid credentials.'

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
