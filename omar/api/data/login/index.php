<?php
function login($data,$mysqli){
	$sql = "SELECT * FROM user WHERE email = '".$data['email']."' AND password = '".$data['password']."'";
	$result = $mysqli -> query($sql);
	if($result->num_rows>0){
		return true;
	}else{
		return false;
	}
}
