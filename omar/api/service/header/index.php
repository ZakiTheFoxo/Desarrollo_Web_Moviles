<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"y+vDz5Xdr}ge=i6gIG*OD-iV14.52X.k-F=3L,BZ{*wx";
	$key		=	"header";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/header/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
	
	}
	if($method=='GET'){
		$result = getHeader($mysqli);
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