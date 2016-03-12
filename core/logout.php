<?php

// Include files
$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path."/core/session.php";

// Start the session
start();

// Remove cookies
$_SESSION["secret"] = "";

// Enforce authentication
enforce();

?>
