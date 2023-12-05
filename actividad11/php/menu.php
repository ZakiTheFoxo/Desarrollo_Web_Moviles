<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json; charset=utf-8');
    
    include "conex.php";
    $mysqli = conexion();
    
    $sql = "SELECT * FROM menu WHERE publicado = 1";
    $resultado = $mysqli->query($sql);

    if($resultado->num_rows>0){
        $row = $resultado -> fetch_all(MYSQLI_ASSOC);
        $row["status"]	= 200; 
        echo json_encode($row);
    }else{
        echo '{"status":500}';
    }

    $resultado->free_result();
    $mysqli->close();