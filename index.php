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

        <ul id="navigation">
            <li style="float: left;"><a href="/scout/">Scoutmaster</a></li>
            <li><a href="/scout/teams/">Teams</a></li>
        </ul>
        <p>Scoutmaster is a comprehensive FRC scouting tool. It also happens to be the first iteration of the scoutmaster software family to ever be functionally completed and deployed! The current models are set up for the 2016 FRC game, Stronghold.</p>
        <a href="core/logout.php">Logout</a>

    <?php } else { ?>

        <div id="login">
            <p>Please enter the super secret passcode.<br></p>
            <form action="core/login.php" method="post" name="login">
                <input type="password" name="secret"/>
                <input type="submit" value="Submit">
            </form>
            <?php if (isset($_GET["error"]) && $_GET["error"] == 1) {
                echo "<p class=\"error\">Try again.</p>";
            } ?>
        </div>

    <?php }

    ?>

    </body>
</html>

