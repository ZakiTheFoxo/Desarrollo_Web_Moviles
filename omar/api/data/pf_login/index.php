<?php
function login($data,$mysqli){
	$sql = "SELECT id_admin FROM pf_admin WHERE id_admin = '".$data['id']."' AND pass = '".$data['password']."'";
	$result = $mysqli -> query($sql);
	if($result->num_rows>0){
		return $result->fetch_all(MYSQLI_ASSOC);
	}else{
		return false;
	}
}
