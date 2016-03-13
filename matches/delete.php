<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/config.php";
include_once ROOT."/core/session.php";

// Start the session
start();

?>

<html>
    <head>
        <title>Team Delete</title>
        <?php include ROOT."/template/head.php"; ?>
    </head>
    <body>

<?php

// Connect to the database
$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    echo "<p class=\"error\">Database error</p>";
}

// Assemble the SQL
$sql = "DELETE FROM teams WHERE team_number = " . $_GET["id"] . ";";

// Query the database
if ($connection->query($sql) === TRUE) {
    echo "<p class=\"info\">Deleted successfully</p>";
    header("Refresh: 2; URL=https://robot.mbhs.edu/scout/teams/");
} else {
    echo $connection->error;
}

$connection->close();

?>

    </body>
</html>

