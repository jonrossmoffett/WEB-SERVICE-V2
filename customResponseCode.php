<?php


function CustomResponse($httpStatusCode,$httpStatusMsg){

    $phpSapiName    = substr(php_sapi_name(), 0, 3);
    if ($phpSapiName == 'cgi' || $phpSapiName == 'fpm') {
    header('Status: '.$httpStatusCode.' '.$httpStatusMsg);
    } else {
    $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
     header($protocol.' '.$httpStatusCode.' '.$httpStatusMsg);
    }

    $response = json_encode(['error' => [$httpStatusMsg]]);
    echo $response;exit;

}