<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json; charset=utf-8');

    if(!isset($_POST['email']) || !isset($_POST['password'])){
        echo '{"status":500,"description":"Error de paramteros"}';
        exit();
    }
    
    $mysqli = new mysqli("localhost", "user1", "user1", "user1");
    
    if($mysqli->connect_errno){
        echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
        exit();
    }

    $user = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$user' AND password = '$password'";
    $resultado = $mysqli->query($sql);
    if($resultado->num_rows>0){
        $row = $resultado -> fetch_array(MYSQLI_ASSOC);
        $row["status"] = 200; 
        echo json_encode($row);
    }else{
        echo '{"status":500,"description":"Error de consulta"}';
    }

    $resultado->free_result();
    $mysqli->close();