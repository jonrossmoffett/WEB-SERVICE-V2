  
<?php 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


if (isset($_SERVER["HTTP_ORIGIN"])) {
    header("Access-Control-Allow-Origin: {$_SERVER["HTTP_ORIGIN"]}");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Max-Age: 0");
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With,Referer,User-Agent,Access-Control-Allow-Origin');
    http_response_code(200);
  }

  $validator = new Validator;
  $validator->validateRequestType('GET');

  $validator->response(401,'You may not access the index page');


?>