<?php

include_once "include/session.php";
start();

?>

<html>
    <body>
        <form action="include/login.php" method="post" name="login">
            <input type="text" name="username"/>
            <input type="password" name="password"/>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
