<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/session.php";
include_once ROOT."/core/auth.php";

// Start the session
start();

?>

<html>
    <head>
        <title>Scoutmaster Home</title>
        <?php include ROOT."/template/head.php" ?>
    </head>
    <body>

    <?php

    // If the user is authorized, show the homepage
    if (auth()) { ?>
    
        <?php include ROOT."/template/navigation.php"; ?>
        <p>Scoutmaster is a comprehensive FRC scouting tool. It also happens to be the first iteration of the scoutmaster software family to ever be functionally completed and deployed! The current models are set up for the 2016 FRC game, Stronghold.</p>
        <a href="/scout/core/logout.php">Logout</a>

    <?php } else { // Otherwise show the login ?>

        <div id="login">
            <p>Please enter the super secret passcode.<br></p>
            <form action="core/login.php" method="post" name="login">
                <input type="password" name="secret"/>
                <input type="submit" value="Submit">
            </form>
            
            <?php 
            
            // Show any errors
            if (isset($_GET["error"]) && $_GET["error"] == 1) { 
                echo "<p class=\"error\">Try again.</p>";
            } 
            
            ?>
            
        </div>

    <?php }

    ?>

    </body>
</html>

