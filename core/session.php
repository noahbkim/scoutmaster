<?php

// Start a new session
function start() {
    if (session_id() == "") {
        session_start();
    }
}

// End the session
function stop() {
    if (session_id() != "") {
        session_destroy();
    }
}

?>