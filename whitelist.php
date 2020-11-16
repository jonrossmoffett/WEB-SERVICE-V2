<?php

function checkDomainWhitelist($domain) {
    $whitelist       = array( '120.154.217.176', 'me.com' );
    if( ! in_array( $domain, $whitelist ) ) { 
        echo "your domain is not allowed to access this api";
        die();
    }
}