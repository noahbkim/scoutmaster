<?php

// Global include
include_once "scout/global.php";

// Include files
include_once $root."/core/session.php";

// Start the session
start();

// Remove cookies
$_SESSION["secret"] = "";

// Enforce authentication
enforce();

?>
