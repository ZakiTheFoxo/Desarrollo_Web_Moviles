<?php
    /* JWT */
    declare(strict_types=1);
    require_once('/var/www/html/librerias/jwt/vendor/autoload.php');
    use Firebase\JWT\JWT;

    /* Encabezados */

    header('Vary: Origin');
    header('Access-Control-Allow-Origin: https://acadserv.upaep.mx');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Content-Type: application/json; charset=utf-8');

    /* Respuesta **/
    if($_SERVER["HTTP_SEC_FETCH_SITE"]=="same-origin"){
        if($_POST["jwt"]=='true'){
            session_start();
            if(!isset($_SESSION["jwt"])){
                $secret_Key  	= 'TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc';
                $date   		= new DateTimeImmutable();
                $expire_at     	= $date->modify('+1 minutes')->getTimestamp();  
                $domainName 	= "acadserv.upaep.mx";			
                $key		   	= "omar";                                          
                $request_data = [
                    'iat'  		=> $date->getTimestamp(),        
                    'iss'  		=> $domainName,                  
                    'nbf'  		=> $date->getTimestamp(),        
                    'exp'  		=> $expire_at,                      
                    'key' 		=> $key                
                ];
                if($auth=JWT::encode($request_data,$secret_Key,'HS256')){
                    $_SESSION["jwt"]=$auth;
                    echo '{"status":200,"jwt":"'.$auth.'"}';
                }else{
                    echo '{"status":500}';
                }
            }else{
                echo '{"status":200,"jwt":"'.$_SESSION["jwt"].'"}';
            }
        }
    }
?>