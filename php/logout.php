<?php
	session_destroy();
	unset($_COOKIE);
	header('location: ../index.php');
?>
