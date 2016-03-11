<?php

include_once "core/session.php";
start();

if (!authenticate()) {
    header("Location: login.php");
}

?>

<html>
    <body>
        <h1>Scoutmaster</h1>
        <p>Scoutmaster is a comprehensive FRC scouting tool. It also happens to be the first iteration of the scoutmaster software family to ever be functionally completed and deployed! The current models are set up for the 2016 FRC game, Stronghold.</p>
        <a href="core/logout.php">Logout</a>
    </body>
</html>

