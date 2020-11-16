<?php
include_once('../database.php');
include_once('../jwt.php');
include_once('../authToken.php');
include_once('../post.php');
include_once('../validator.php');
include_once('../vendor/autoload.php');
include_once('../rateLimiterConfig.php');
include_once('../whitelist.php');
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

checkDomainWhitelist($_SERVER["REMOTE_ADDR"]);
runRateLimiter();

if (isset($_SERVER["HTTP_ORIGIN"])) {
    header("Access-Control-Allow-Origin: {$_SERVER["HTTP_ORIGIN"]}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 0");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With,Referer,User-Agent,Access-Control-Allow-Origin');
    http_response_code(200);
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

$validator = new Validator;
$validator->validateRequestType('POST','updatePost');

$db = new database;
$dbConn = $db->connect();

$data = json_decode(file_get_contents("php://input"));


$title = $data->title;
$description = $data->description;
$postId = $data->postId;


$validator->validateParameter('Title',$title,STRING,'200','5');
$validator->validateParameter('Description',$description,STRING,'200','5');
$validator->validateParameter('PostId',$postId,INTEGER);

$authCheck = new AuthTokenChecker;
$token = $authCheck->getBearerToken();

$uid = $authCheck->validateToken($token);

try 
{
    $post = new Post;
    $post->setId($postId);
    $post->setTitle($title);
    $post->setDescription($description);
    $post->setStatus(0);
    $post->setCreatedBy($uid);
    $post->setCreatedAt(date('Y-m-d'));
    $post->setUpdatedAt(date('Y-m-d'));
    $post->updatePost();
    
}
catch(Exception $e)
{
  $validator->response(400,"could not update post");
}

$validator->responseSuccess(200,"Updated Post");