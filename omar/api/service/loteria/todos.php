<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc";
	$key		=	"table";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/loteria/todos.php';

	/* Cuerpo del API */
	if($method=='POST'){
        
	}

	if($method=='GET'){
        $result = getLottery($mysqli);
		if($result != false){
			$result["status"]	= 200; 
			echo json_encode($result);
			die();
		}else{
			echo '{"status":502,"description":"No se encontraron cartas"}';
			die();
		}
	}	

	if($method=='PUT'){
	
	}	
	
	if($method=='DELETE'){
        
    
	}
?>