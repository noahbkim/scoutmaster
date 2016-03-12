<?php

include_once "core/session.php";
include_once "core/auth.php";

start();

?>

<html>
    <head>
        <title>Scoutmaster Home</title>
        <?php include "template/head.php" ?>
    </head>
    <body>

    <?php

    if (auth()) { ?>

        <h1>Scoutmaster</h1>
        <p>Scoutmaster is a comprehensive FRC scouting tool. It also happens to be the first iteration of the scoutmaster software family to ever be functionally completed and deployed! The current models are set up for the 2016 FRC game, Stronghold.</p>
        <a href="core/logout.php">Logout</a>

    <?php } else { ?>

        <form action="core/login.php" method="post" name="login">
            <input type="password" name="secret"/>
            <input type="submit" value="Submit">
        </form>

    <?php }

    ?>

    </body>
</html>

