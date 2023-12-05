<?php
    /* JWT */
    require_once('/var/www/html/german/api/libraries/jwt/vendor/autoload.php');
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    /* Encabezados */
    header('Vary: Origin');
    header('Access-Control-Allow-Origin: https://acadserv.upaep.mx');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json; charset=utf-8');
    /* Respuesta **/
    if($_SERVER["HTTP_SEC_FETCH_SITE"]=="same-origin"){
        session_start();
        if(!isset($_SESSION["jwt"])){
            echo '{"status":500,"error":"Error sesión"}'; 
            die();
        }else{
            $secret_Key  	= 'TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc';
            try{
                $decoded 	= 	JWT::decode($_SESSION["jwt"], new Key($secret_Key, 'HS256'));	
            }catch (Exception $e){
                $secret_Key  	= 'TS)gHM][7)kf@cHQ,qv(cJUq#Gl.W=HeS1h2zA3c}.hc';
                $date   		= new DateTimeImmutable();
                $expire_at     	= $date->modify('+6 minutes')->getTimestamp();  
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
                    
                }	
            } 
            if(!isset($_SESSION["isLoggedIn"])){
                echo '{"status":500,"error":"Error sesión"}'; 
            }else{
                echo '{"status":200,"error":"Sesión iniciada"}'; 
            }         
        }
    }
?>