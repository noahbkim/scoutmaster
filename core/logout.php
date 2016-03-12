<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/session.php";
include_once ROOT."/core/auth.php";

// Start the session
start();

// Remove cookies
$_SESSION["secret"] = "";

// Enforce authentication
enforce();

?>
