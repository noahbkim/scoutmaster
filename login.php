<?php

include_once "core/session.php";
start();

if (authenticate()) {
    header("Location: index.php");
}

?>

<html>
    <body>
        <form action="core/login.php" method="post" name="login">
            <input type="text" name="username"/>
            <input type="password" name="password"/>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

