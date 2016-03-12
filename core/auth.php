<?php

// Global include
include_once "scout/global.php";

// Include files
include_once $root."/core/session.php";
include_once $root."/core/config.php";
include_once $root."/core/legacy.php";

// Start the session
start();

// Check if the user is validly logged in
function auth() {

    // Check if the credentials exist
    if (!isset($_SESSION["secret"])) {
        return false;
    }

    // Grab the credentials
    $secret_hash = $_SESSION["secret"];

    // Try to log in
    return hash_equals($secret_hash, SECRET_HASH);

}

// Enforce authentication
function enforce() {

    // Send the user to login
    if (!auth()) {
        header("Location: /");
    }

}

?>
