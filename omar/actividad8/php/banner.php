<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json; charset=utf-8');

    if(!isset($_GET)){
        echo '{"status":500,"description":"Error de paramteros"}';
        exit();
    }

    include "conex.php";
    $mysqli = conexion();

    $sql = "SELECT * FROM banner WHERE status = 1";
    $resultado = $mysqli->query($sql);

    if($resultado->num_rows>0){
        $row = $resultado -> fetch_all(MYSQLI_ASSOC);
        $a=0;
        $json["html"]='';
        foreach($row as $key => $value) {
            if($a==0){
                $json["html"].='<div class="carousel-item active">';
            }else{
                $json["html"].='<div class="carousel-item">';
            }
            $json["html"].='<img src="'.$value['url'].'" class="d-block w-100" alt="'.$value['title'].'">';
            $json["html"].='</div>';
            $a++;
        }	 
        $json["status"]	= 200; 
        echo json_encode($json);
    }else{
        echo '{"status":500}';
    }
        
    /********** Liberar conexión **********/
    $resultado -> free_result();
    $mysqli -> close();
?>
