<?php
	$mysqli = new mysqli("localhost","user1","user1","user1");

	if ($mysqli -> connect_errno) {
		echo '{"status":500,"error":"Failed to connect to MySQL: '. $mysqli -> connect_error.'"}';
		exit();
	}