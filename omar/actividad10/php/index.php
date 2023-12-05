<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json; charset=utf-8');

    if(!isset($_POST['email']) || !isset($_POST['password'])){
        echo '{"status": 500}';
        exit();
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '{"status": 400}';
        exit();
    }
    
    include "conex.php";
    $mysqli = conexion();
    
    $sql = "SELECT * FROM users WHERE email = '$_POST[email]' AND password = '$_POST[password]'";
    $resultado = $mysqli->query($sql);

    if($resultado->num_rows>0){
        $row = $resultado -> fetch_array(MYSQLI_ASSOC);
        $row["status"]	= 200; 
        echo json_encode($row);
    }else{
        echo '{"status":500}';
    }

    $resultado->free_result();
    $mysqli->close();