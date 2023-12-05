<?php
    /********** Mostrar errores ************/
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    /********** Librerías *****************/
    require_once('/var/www/html/librerias/jwt/vendor/autoload.php');
    use Firebase\JWT\JWT;
    include 'functions.php';

    /********** Configuración *************/
    session_start();
    header('Content-Type: application/json; charset=utf-8');

    /********** Validación de datos *******/
    if(!isset($_POST['email']) || !isset($_POST['password'])){
        echo '{"status":501,"description":"Error de usuario o contraseña"}';
        exit();
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo '{"status":501,"description":"Error de correo electrónico"}';
        exit();
    }
    if(!isset($_POST['jwt']) or $_POST['jwt']!=$_SESSION['jwt']){
        echo '{"status":501,"description":"Error de sesiones"}';
        exit();		
    }

    /***************** JWT **************/
    $secret_Key  	= 'TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc';
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "acadserv.upaep.mx";
    $key		   	= "login";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $auth	=	JWT::encode($request_data,$secret_Key,'HS256');
    $url	=	'https://acadserv.upaep.mx/omar/api/service/login/';
    $post	=	$_POST;
    $metodo	=	"POST";
    curl($url,$post,$auth,$metodo);
?>
