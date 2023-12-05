<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"D93OSy2142tnZZ3Me86GOBnNuB3mlwZAmdwN2VYc3xji";
	$key		=	"iconlist";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/iconlist/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
        
	}
	if($method=='GET'){
        $result = getIconList($mysqli);
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