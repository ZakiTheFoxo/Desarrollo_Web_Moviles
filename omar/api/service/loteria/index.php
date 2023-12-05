<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"COenw0cZiojdecuEbrPOTdZ39NjysWkNJT7X0TPlaAsB";
	$key		=	"lottery";
	
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/loteria/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
        if(isset($data)){
			if(addLottery($data,$mysqli)){
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error al subir carta de loteria"}';
				die();
			}
		}
	}

	if($method=='GET'){
        if(isset($data)){
			$result = searchLottery($data,$mysqli);
			if($result != false){
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error al eliminar carta de loteria"}';
				die();
			}
		}
	}	

	if($method=='PUT'){
		if(isset($data)){
			if(modifyLottery($data,$mysqli)){
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error al actualizar carta de loteria"}';
				die();
			}
		}
	}	
	
	if($method=='DELETE'){
		if(isset($data)){
			if(deleteLottery($data,$mysqli)){
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error al eliminar carta de loteria"}';
				die();
			}
		}
	}
?>