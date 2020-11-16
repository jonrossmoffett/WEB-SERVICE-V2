<?php
include_once('../database.php');
include_once('../jwt.php');
include_once('../constants.php');
include_once('../validator.php');
include_once('../vendor/autoload.php');
include_once('../rate.php');
include_once('../whitelist.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

    checkDomainWhitelist($_SERVER["REMOTE_ADDR"]);

    date_default_timezone_set('Australia/Brisbane');
	session_start();
	
	//rate limit 1000 calls per 24 hours
	$rateLimiter = new RateLimiter($_SERVER["REMOTE_ADDR"]);
	$limit = 1000;				    //connection per minutes
	$minutes = 1 * 1440;			//1 day
	$seconds = floor($minutes * 1);	//retry after 1 day
	try {
		$rateLimiter->limitRequestsInMinutes($limit, $minutes);
	} catch (RateExceededException $e) {
		header("HTTP/1.1 429 Too Many Requests");
		header(sprintf("Retry-After: %d", $seconds));
		$data = 'Rate Limit Exceeded ';
		die (json_encode($data));
	}

	//rate limit 1 call per second
	if (isset($_SESSION['LAST_CALL'])) {
		$last = strtotime($_SESSION['LAST_CALL']);
		$curr = strtotime(date("Y-m-d h:i:s"));
		$sec =  abs($last - $curr);
		if ($sec <= 1) {
		  $data = 'Rate Limit Exceeded';  // rate limit
		  header('Content-Type: application/json');
		  die (json_encode($data));        
		}
	}
	$_SESSION['LAST_CALL'] = date("Y-m-d h:i:s");


if (isset($_SERVER["HTTP_ORIGIN"])) {
    header("Access-Control-Allow-Origin: {$_SERVER["HTTP_ORIGIN"]}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 0");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With,Referer,User-Agent,Access-Control-Allow-Origin');
  }
  if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"])) header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    //if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"])) header("Access-Control-Allow-Headers: {" . $_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"] ."}");
    $request = Request::createFromGlobals();
    $response = new Response();
    $response->setStatusCode(200);
    $response->prepare($request);
    $response->send();
  }
  header("Content-Type: application/json; charset=UTF-8");


        $db = new database;
        $dbConn = $db->connect();
        $validator = new Validator;

        $validator->validateRequestType('POST','login');

        $data = json_decode(file_get_contents("php://input"));
        
        $email = $data->email;
        $password = $data->password;

        
        $validator->validateParameter('Email',$email, EMAIL ,50,5,TRUE);
        $validator->validateParameter('Password',$password,PASSWORD,20,8,TRUE);


        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $dbConn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if(password_verify($password,$user['password'])){

            $payload = [
                'iat' => time(),
                'iss' => 'localhost',
                'exp' => time() + (60 * 60 * 24),
                'userId' => $user['id']
            ];
            $token = JWT::encode($payload,SECRETE_KEY);
          
            $request = Request::createFromGlobals();
            $response = new Response();
            $response->setContent(json_encode($token));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(200);
            $response->prepare($request);
            $response->send();

        }
        else
        {   
            $errors = [];
            array_push($errors,'Incorrect Login Detials');
            $request = Request::createFromGlobals();
            $response = new Response();
            $response->setContent(json_encode(['errors' => $errors]));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(400);
            $response->prepare($request);
            $response->send();
        }   



    





    ?>