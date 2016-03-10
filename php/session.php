<?php

// Requirements
require("/php/config.php");

// Database
$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// Session methods
function start() {

    // Some custom cookie parameters
    $name = "scoutmaster_secure_session";
    $secure = true;
    $httponly = true;
    $base = session_get_cookie_params();
    session_set_cookie_params($base["lifetime"], $base["path"], $base["domain"], $secure, $httponly);
    session_name($name);

    // Start the session
    session_start();
    session_regerate_id(true);

}

function user($username) {

    // Prepare and execute the statement
    $statement = $connection->prepare("SELECT id, password FROM login WHERE username = ? LIMIT 1");
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->store_result();

    // Get the information
    $statement->bind_result($id, $hashed_password);
    $statement->fetch();

    // Return
    return array("statement" => statement, "id" => $id, "hashed_password" => $hashed_password);

}

// Log in with a username and password
function login($username, $password) {

    // Assert there's only one user
    if ($statement->num_rows == 1) {

        // If the credentials are correct
        if (password_verify($password, $hashed_password)) {

            // Set session information
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["authentication"] = password_hash($hashed_password);

            // Return
            return true;

        }

        // If the credentials are incorrect
        return "bad credentials";

    }

    // If there are too many entries
    return "no such user";

}

// Check if the user is correctly logged in
function authenticate() {

    // Check if the session variables are set
    if (isset($_SESSION["id"], $_SESSION["username"], $_SESSION["authentication"]) {

    

    }

}



?>
