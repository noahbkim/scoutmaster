<?php

include_once "session.php";
include_once "config.php";
include_once "legacy.php";

start();

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

?>
