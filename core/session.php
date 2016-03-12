<?php

// Start a new session
function start() {
    if (session_id() == "") {
        session_start();
    }
}

function stop() {
    if (session_id() != "") {
        session_destroy();
    }
}

?>