<?php
include_once('../vendor/autoload.php');


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




