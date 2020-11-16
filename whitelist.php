<?php

function checkDomainWhitelist($domain) {
    $whitelist       = array( '120.154.217.176', '10.63.208.77','10.73.248.115' );
    if( ! in_array( $domain, $whitelist ) ) { 
        echo "your domain is not allowed to access this api";
        die();
    }
}