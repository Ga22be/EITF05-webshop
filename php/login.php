<?php
session_start();

require_once('database.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['ispurchase'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = $_POST['password'];

	if ($_POST['ispurchase'] == 'true') {
		$username = $_SESSION['username'];
	}

	$isLogin = false;
	$isLocked = false;

	$database = new Database();

	$query = 'SELECT password, fails, locked, address FROM users WHERE username = ?';
	$result = $database->executeQuery($query, array($username));

	$lockTime = strtotime($result[0]['locked']);
	$currentTime = strtotime(date('Y-m-d H:i:s'));

	$diffTime = $currentTime - $lockTime;

	$lockoutTime = 300; // time in seconds to lock user account

	$response = [];

	if ($diffTime > $lockoutTime) {
		if (!empty($result)) {
			if (password_verify($password, $result[0]['password']))  {
				session_regenerate_id();

				$response['error'] = false;
				$isLogin = true;
				$_SESSION['username'] = $username;
				$_SESSION['address'] = $result[0]['address'];


				$time = "1970-01-01 23:59:59"; // If this looks stupid, blame mysql, DEFAULT keyword for TIMESTAMP differs on mysql servers.
				$clearFails = 'UPDATE users SET fails = ?, locked = ? WHERE username = ?';
				$database->executeUpdate($clearFails, array(0, $time, $username));

				if ($_POST['ispurchase'] == 'true') {
					$_SESSION['madepurchase'] = true;
				}
			}
		}

		if (empty($username) || empty($password)) {
			$response = [
				'error' => true,
				'msg' => 'One or more blank fields.'
			];
		} else if ($isLogin == false) {
			if (!empty($result)) {
				if ($result[0]['fails'] >= 3) {
					$lockUpdate  = 'UPDATE users SET fails = ?, locked = now() WHERE username = ?';
					$database->executeUpdate($lockUpdate, array(0, $username));

					$response = [
						'error' => true,
						'msg' => 'Account has been locked for 5 minutes.'
					];
				} else {
					$time = "1970-01-01 23:59:59"; // If this looks stupid, blame mysql, DEFAULT keyword for TIMESTAMP differs on mysql servers.
					$failsUpdate = 'UPDATE users SET fails = ?, locked = ? WHERE username = ?';
					$database->executeUpdate($failsUpdate,
						array($result[0]['fails']+1, $time, $username));

					$response = [
						'error' => true,
						'msg' => 'Fail #'.($result[0]['fails']+1)
					];
				}
			} else {
				$response = [
					'error' => true,
					'msg' => 'Invalid credentials.'
				];
			}
		}
	} else {
		$response = [
			'error' => true,
			'msg' => 'Account is locked for '.($lockoutTime-$diffTime).' more seconds.'
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
