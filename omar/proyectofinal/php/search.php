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

    /***************** JWT **************/
    $secret_Key  	= '&R4_j7H38)67To8Of=]jAmIqp3[l6W.%pted@.^W5=kA';
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "acadserv.upaep.mx";
    $key		   	= "search";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $auth	=	JWT::encode($request_data,$secret_Key,'HS256');
    $url	=	'https://acadserv.upaep.mx/omar/api/service/user/';
    $post	=	$_GET;
    $metodo	=	"GET";
    $response = json_decode(curl($url,$post,$auth,$metodo));
    if(array_key_exists('isLoggedIn', $_SESSION)){
        $response->isLoggedIn = $_SESSION['isLoggedIn'];
    } else {
        $response->isLoggedIn = false;
    }
    echo json_encode($response);
?>
