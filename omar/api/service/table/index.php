<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"9c9usr2GB=H8&Yk0[J_Qa-t^OI5Fy7YgTBIfXD[C3Ocy";
	$key		=	"table";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/table/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
	
	}
	if($method=='GET'){
		$result = getTable($mysqli);
		if($result != false){
			$result["status"]	= 200; 
			echo json_encode($result);
			die();
		}else{
			echo '{"status":502,"description":"Error de elementos"}';
			die();
		}
	}	
	if($method=='PUT'){
	
	}	
	if($method=='DELETE'){
	
	}
?>