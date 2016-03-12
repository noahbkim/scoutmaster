<?php

include_once "core/session.php";
include_once "core/auth.php";

start();

if (auth()) { header("Location: index.php"); }

?>

<html>
    <body>
        <form action="core/login.php" method="post" name="login">
            <input type="password" name="secret"/>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

