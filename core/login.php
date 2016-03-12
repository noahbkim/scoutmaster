<?php

// Include and start session
include_once "session.php";
start();

// Check if the credentials are set
if (isset($_POST["username"], $_POST["password"])) {

    // Grab the credentials
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Try to log in
    if (login($username, $password) == true) {
        header("Location: /scout/");
        error_log("aaaaaaaaaaaaaaaaa");
    } else {
        header("Location: /scout/login.php?error=1");
    }

}

?>
