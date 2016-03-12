<?php

// Requirements
include_once "config.php";

// Database
function connect() {

    return new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

}

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
    //session_regerate_id(true);

}

function user($username) {

    $connection = connect();

    // Prepare and execute the statement
    $statement = $connection->prepare("SELECT id, password FROM login WHERE username = ? LIMIT 1");
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->store_result();

    // Get the information
    $statement->bind_result($id, $hashed_password);
    $statement->fetch();

    // Return
    return array("exists" => ($statement->num_rows == 1), "id" => $id, "hashed_password" => $hashed_password);

}

// Log in with a username and password
function login($username, $password) {

    // Query the database for the user
    $data = user($username);

    //error_log(implode(", ", $data));

    $exists = $data["exists"];
    $id = $data["id"];
    $hashed_password = $data["hashed_password"];

    // Assert there's only one user
    if ($exists) {

        // If the credentials are correct
        if (password_verify($password, $hashed_password)) {

            // Set session information
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["authentication"] = hash("sha512", $hashed_password);

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
    if (isset($_SESSION["id"], $_SESSION["username"], $_SESSION["authentication"])) {

        // Retreive existing login information
        $id = $_SESSION["id"];
        $username = $_SESSION["username"];
        $authentication = $_SESSION["authentication"];

        // Get database user information
        $data = user($username);
        $check = hash("sha512", $data["hashed_password"]);

        // Check if the hashes are equal
        if (hash_equals($authentication, $check)) {
            return true;
        }

    }

    // If you've gotten this far, you're not logged in
    return false;

}

// Log out the user and close the session
function logout() {

    // Clear the session and cookies
    $_SESSION = array();
    $base = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $base["path"], $base["domain"], $base["secure"], $base["httponly"]);

    // Destroy the session
    session_destroy();
    header("Location: /scout/");

}

// LEGACY
if (!function_exists('hash_equals')) {
    function hash_equals($str1, $str2) {
        if(strlen($str1) != strlen($str2)) {
            return false;
        } else {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
            return !$ret;
        }
    }
}

?>
