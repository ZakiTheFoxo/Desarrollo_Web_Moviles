<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"UcV^+]XcWB%1-VyIjzL56ECWz.fBlI5rU2Rq7.DMLC.%";
	$key		=	"userlist";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/userlist/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
        
	}
	if($method=='GET'){
        $result = getUserList($mysqli);
		if($result != false){
			$result["status"]	= 200; 
			echo json_encode($result);
			die();
		}else{
			echo '{"status":502,"description":"No se encontraron resultados"}';
			die();
		}
	}	
	if($method=='PUT'){
	
	}	
	if($method=='DELETE'){
	
	}
?>