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

    /********** Validaciones **************/
    if(!isset($_SESSION["isLoggedIn"]) || !$_SESSION['isLoggedIn']){ echo '{"status":403,"description":"Not allowed"}'; exit(); }
    if(!isset($_POST['jwt']) or $_POST['jwt']!=$_SESSION['jwt']){   echo '{"status":501,"description":"Error de sesiones"}';    exit(); }

    if(!isset($_POST['name'])){ echo '{"status":501,"description":"Data missing name"}'; exit(); }
    if(!isset($_POST['age'])){ echo '{"status":501,"description":"Data missing age"}'; exit(); }
    if(!isset($_POST['job'])){ echo '{"status":501,"description":"Data missing job"}'; exit(); }
    if(!isset($_POST['status'])){ echo '{"status":501,"description":"Data missing status"}'; exit(); }
    if(!isset($_POST['city'])){ echo '{"status":501,"description":"Data missing city"}'; exit(); }
    if(!isset($_POST['quote'])){ echo '{"status":501,"description":"Data missing quote"}'; exit(); }
    if(!isset($_POST['about'])){ echo '{"status":501,"description":"Data missing about"}'; exit(); }
    if(!isset($_POST['objectives'])){ echo '{"status":501,"description":"Data missing obj"}'; exit(); }
    if(!isset($_POST['needs'])){ echo '{"status":501,"description":"Data missing needs"}'; exit(); }
    if(!isset($_POST['feature1'])){ echo '{"status":501,"description":"Data missing ft1"}'; exit(); }
    if(!isset($_POST['feature2'])){ echo '{"status":501,"description":"Data missing ft2"}'; exit(); }
    if(!isset($_POST['feature3'])){ echo '{"status":501,"description":"Data missing ft3"}'; exit(); }
    if(!isset($_POST['feature4'])){ echo '{"status":501,"description":"Data missing ft4"}'; exit(); }
    if(!isset($_POST['competency1'])){ echo '{"status":501,"description":"Data missing c1"}'; exit(); }
    if(!isset($_POST['competency2'])){ echo '{"status":501,"description":"Data missing c2"}'; exit(); }
    if(!isset($_POST['competency3'])){ echo '{"status":501,"description":"Data missing c3"}'; exit(); }
    if(!isset($_POST['competency4'])){ echo '{"status":501,"description":"Data missing c4"}'; exit(); }
    if(!isset($_POST['social'])){ echo '{"status":501,"description":"Data missing social"}'; exit(); }

    $_POST['created_by'] = $_SESSION['id'];

    if(is_uploaded_file($_FILES['img']['tmp_name'])) {
        $_POST['img'] = basename($_FILES['img']['name']);
    
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

    /***************** JWT ****************/
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
    $post	=	$_POST;
    $metodo	=	"PUT";
    $response = curl($url,$post,$auth,$metodo);
    echo $response;
?>
