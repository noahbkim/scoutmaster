<?php

// Include and start session
include_once "config.php";
start_session();

// Check if the credentials are set
if ($_POST["secret"])) {

    // Grab the credentials
    $secret = $_POST["secret"];
    $secret_hash = hash("sha512", $secret);
    
    // Try to log in
    if (hash_equals($secret_hash, SECRET_HASH)) {
        
        // Set the session secret
        $_SESSION["secret"] = $secret_hash;
    
    } else {
    
        // Send back to the login page with error
        header("Location: /scout/login.php?error=" . urlencode("secret"));
    
    }

}

?>
