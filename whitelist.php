<?php

function checkDomainWhitelist($domain) {
    $whitelist       = array( 'icloud.com', 'me.com' );
    if( ! in_array( $domain, $whitelist ) ) { 
        echo "your domain is not allowed to access this api";
        die();
    }
}