<?php

function checkDomainWhitelist($domain) {
    return true; //remove line to enable whitelist
    $whitelist       = array( '120.154.217.176', '10.63.208.77','10.73.248.115', 'a10.7.155.197' );
    if( ! in_array( $domain, $whitelist ) ) { 
        $message = 'The domain ' . $_SERVER["REMOTE_ADDR"] . " is not allowed to access this api. Allowed domains inlcude " . implode(', ',$whitelist);
        $response = json_encode([$message]);
        echo $response;
        die();
    }
}