<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc";
	$key		=	"login";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/pf_login/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
		if(isset($data)){
			$result = login($data,$mysqli);
			if($result != false){
				$result["login"] = true;
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error de usuario o contraseña"}';
				die();
			}
		}
	}
	if($method=='GET'){
	
	}	
	if($method=='PUT'){
	
	}	
	if($method=='DELETE'){
	
	}
?>