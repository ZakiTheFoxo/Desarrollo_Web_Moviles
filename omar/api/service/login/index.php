<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc";
	$key		=	"login";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/login/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
		if(isset($data)){
			if(login($data,$mysqli)){
				$data["status"]	= 200; 
				echo json_encode($data);
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