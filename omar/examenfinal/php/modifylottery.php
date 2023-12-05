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

    if(!isset($_POST['num'])){ echo '{"status":501,"description":"Data missing: num"}'; exit(); }
    if(!isset($_POST['name'])){ echo '{"status":501,"description":"Data missing: name"}'; exit(); }
    if(!isset($_POST['id'])){ echo '{"status":501,"description":"Data missing: id"}'; exit(); }
    
    if(is_uploaded_file($_FILES['img']['tmp_name'])) {
        $_POST['img'] = basename($_FILES['img']['name']);
        // unlink("../img/".$_POST['hidden_img']);
    
        $target_dir = "../img/";
        $target_file = $target_dir.basename($_FILES["img"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo '{"status":501,"description":"Not allowed image type"}';
            exit();
        }
    
        if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            echo '{"status":501,"description":"Error uploading file"}';
            exit();
        }
    } else {
        $_POST['img'] = $_POST['hidden_img'];
    }

    /***************** JWT **************/
    $secret_Key  	= 'COenw0cZiojdecuEbrPOTdZ39NjysWkNJT7X0TPlaAsB';
    $date   		= new DateTimeImmutable();
    $expire_at     	= $date->modify('+1 minutes')->getTimestamp();      
    $domainName 	= "acadserv.upaep.mx";
    $key		   	= "lottery";                                          
    $request_data = [
        'iat'  		=> $date->getTimestamp(),        
        'iss'  		=> $domainName,                  
        'nbf'  		=> $date->getTimestamp(),        
        'exp'  		=> $expire_at,                      
        'key' 		=> $key                
    ];
    $auth	=	JWT::encode($request_data,$secret_Key,'HS256');
    $url	=	'https://acadserv.upaep.mx/omar/api/service/loteria/';
    $post	=	$_POST;
    $metodo	=	"PUT";
    $response = json_decode(curl($url,$post,$auth,$metodo));
    echo json_encode($response);
?>
