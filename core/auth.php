<?php

session_start();

function auth() {
    
    // Grab the credentials
    $secret_hash = $_SESSION["secret"];
    
    // Try to log in
    return hash_equals($secret_hash, SECRET_HASH);

}

?>