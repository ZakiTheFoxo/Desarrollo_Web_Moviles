<?php
	function conexion(){
		$mysqli = new mysqli("localhost","user1","user1","user1");
		if ($mysqli -> connect_errno) {
		  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		  exit();
		}
		return $mysqli;
	}