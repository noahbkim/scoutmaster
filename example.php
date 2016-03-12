<?php

include_once "core/session.php";
include_once "core/auth.php";

start();

if (!auth()) {
    header("Location: /scout/");
}

?>

<html>
    <body>
        Hello, world!
    </body>
</html>
