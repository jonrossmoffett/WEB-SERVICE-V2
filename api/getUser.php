<?php
include_once('../database.php');
include_once('../jwt.php');
include_once('../authToken.php');
include_once('../post.php');
include_once('../validator.php');
include_once('../vendor/autoload.php');
include_once('../user.php');
include_once('../rateLimiterConfig.php');
include_once('../whitelist.php');
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

checkDomainWhitelist($_SERVER["REMOTE_ADDR"]);
runRateLimiter();

if (isset($_SERVER["HTTP_ORIGIN"])) {
    header("Access-Control-Allow-Origin: *");
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
$validator->validateRequestType('GET','getUser');

$authCheck = new AuthTokenChecker;
$token = $authCheck->getBearerToken();

$getId = $_GET['userId'];

$uid = $authCheck->validateToken($token);

try 
{
    $user = new User;
    $user->setId($uid);
    $user = $user->GetUser($getId);
    $validator->responseSuccess(200,$user);
}
catch(Exception $e)
{
  $validator->response(400,'there was an error processing your request');
}
