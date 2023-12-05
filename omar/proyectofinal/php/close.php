<?php
    /* Encabezados */
    header('Vary: Origin');
    header('Access-Control-Allow-Origin: https://acadserv.upaep.mx');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json; charset=utf-8');
    /* Respuesta **/
    if($_SERVER["HTTP_SEC_FETCH_SITE"]=="same-origin"){
        if($_POST["salir"]=='true'){
            session_start();
            $_SESSION["jwt"]=null;
            $_SESSION["isLoggedIn"]=null;
            $_SESSION["id"]=null;
            unset($_SESSION["jwt"]);
            unset($_SESSION["isLoggedIn"]);
            unset($_SESSION["id"]);
            session_destroy();
            echo '{"status":200,"descripcion":"Log Out Successful"}';
            die();
        }
    }
?>