<?php

include_once "core/session.php";
start();

if (!authenticate()) {
    header("Location: login.php");
}

?>

<html>
    <body>
        Hello, world!
    </body>
</html>

