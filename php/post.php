<?php
session_start();

require_once('database.php');

if (isset($_POST['comment']) && !empty($_POST['comment'])) {
	$database = new Database();

	$username = $_SESSION['username'];
	$comment = htmlspecialchars($_POST['comment']);
	// Enables XSS
	//$comment = $_POST['comment'];

	$query = "INSERT INTO posts(username, usercomment) VALUES(?, ?)";
	$result = $database->executeUpdate($query, array($username, $comment));

	if ($result) {
		$response = [
			'error' => false,
			'msg' => 'Successfully post of comment.'
		];
	} else {
		$response = [
			'error' => true,
			'msg' => 'Unsuccessful post of comment.'
		];
	}


	header('Content-Type: application/json');
	echo json_encode($response);
} else {
	$response = [
		'error' => true,
		'msg' => 'Not set or empty.'
	];

	header('Content-Type: application/json');
	echo json_encode($response);
}

?>
