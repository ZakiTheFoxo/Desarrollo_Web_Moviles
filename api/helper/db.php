<?php
@$mysqli = new mysqli("localhost","german","german","german");

if ($mysqli -> connect_errno) {
	echo '{"status":500,"error":"Failed to connect to MySQL: '. $mysqli -> connect_error.'"}';
	exit();
}