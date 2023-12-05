<?php
	/* Variables */
	$debug		=	true;
	$secret_Key	=	"&R4_j7H38)67To8Of=]jAmIqp3[l6W.%pted@.^W5=kA";
	$key		=	"search";
	
	/* Archivos base */
	include '../../helper/helper.php';
	include '../../data/user/index.php';

	/* Cuerpo del API */
	if($method=='POST'){
        if(isset($data)){
			$data['id'] = addUser($data, $mysqli);
			if($data['id'] == false) {
				echo '{"status":502,"description":"Error uploading User Data"}';
				die();
			}

			if(!addAbout($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading About Data"}';
				die();
			}

			if(!addObjectives($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading Objectives Data"}';
				die();
			}

			if(!addNeeds($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading Needs Data"}';
				die();
			}

			if(!addFeatures($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading Features Data"}';
				die();
			}

			if(!addCompetency($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading Competency Data"}';
				die();
			}

			if(!addSocial($data, $mysqli)) {
				echo '{"status":502,"description":"Error uploading Social Data"}';
				die();
			}

			$result["status"] = 200; 
			echo json_encode($result);
			die();
		}
	}

	if($method=='GET'){
        $result = getUser($data, $mysqli);
		$id = $result["0"]["id_user"];
		if($result != false){
			$result["status"]	= 200; 

			$about = getAbout($id, $mysqli);
			if($about != false){
				$result["0"]["about"] = $about["0"]["about"];
			} else {
				$result["0"]["about"] = "No futher information given";
			}

			$objectives = getObjectives($id, $mysqli);
			if($objectives != false){
				$result["0"]["objectives"] = $objectives;
			} else {
				$result["0"]["objectives"] = "No futher information given";
			}

			$needs = getNeeds($id, $mysqli);
			if($needs != false){
				$result["0"]["needs"] = $needs;
			} else {
				$result["0"]["needs"] = "No futher information given";
			}

			$features = getFeatures($id, $mysqli);
			if($features != false){
				$result["0"]["features"] = $features["0"];
			} else {
				$result["0"]["features"] = "No futher information given";
			}

			$competency = getCompetency($id, $mysqli);
			if($competency != false){
				$result["0"]["competency"] = $competency["0"];
			} else {
				$result["0"]["competency"] = "No futher information given";
			}

			$social = getSocial($id, $mysqli);
			if($social != false){
				$result["0"]["social"] = $social;
			} else {
				$result["0"]["social"] = "No futher information given";
			}

			echo json_encode($result);
			die();
		}else{
			echo '{"status":502,"description":"No se encontraron resultados"}';
			die();
		}
	}	

	if($method=='PUT'){
		if(isset($data)){
			$data['id'] = $data['hidden_id'];

			if(!modifyUser($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating User Data"}';
				die();
			}

			if(!modifyAbout($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating About Data"}';
				die();
			}

			if(!modifyObjectives($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating Objectives Data"}';
				die();
			}

			if(!modifyNeeds($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating Needs Data"}';
				die();
			}

			if(!modifyFeatures($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating Features Data"}';
				die();
			}

			if(!modifyCompetency($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating Competency Data"}';
				die();
			}

			if(!modifySocial($data, $mysqli)) {
				echo '{"status":502,"description":"Error updating Social Data"}';
				die();
			}

			$result["status"] = 200; 
			echo json_encode($result);
			die();
		}
	}	
	
	if($method=='DELETE'){
		if(isset($data)){
			if(deleteUser($data,$mysqli)){
				$result["status"] = 200; 
				echo json_encode($result);
				die();
			}else{
				echo '{"status":502,"description":"Error de usuario o contraseña"}';
				die();
			}
		}
	}
?>