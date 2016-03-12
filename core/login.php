<?php

// Global include
include_once "scout/global.php";

// Include and start session
include_once ROOT."/core/config.php";
include_once ROOT."/core/session.php";
include_once ROOT."/core/legacy.php";

start();

// Check if the credentials are set
if (isset($_POST["secret"])) {

    // Grab the credentials
    $secret = $_POST["secret"];
    $secret_hash = hash("sha512", $secret);

    // Try to log in
    if (hash_equals($secret_hash, SECRET_HASH)) {

        // Set the session secret
        $_SESSION["secret"] = $secret_hash;
        header("Location: /scout/");

    } else {

        // Send back to the login page with error
        header("Location: /scout/?error=1");

    }

}

?>
