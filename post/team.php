<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/config.php";
include_once ROOT."/core/session.php";

// Start the session
start();

// All the keys for the form
$keys = [
    "team_number",
    "team_name",
    "primary_mechanism",
    "primary_mechanism_other",
    "drive_system",
    "drive_system_other",
    "drive_diameter",
    "drive_info",
    "can_high_goal",
    "can_low_goal",
    "scoring_system",
    "can_boulder",
    "boulder_system",
    "can_portcullis",
    "can_cheval",
    "can_moat",
    "can_ramparts",
    "can_drawbridge",
    "can_sally",
    "can_rock",
    "can_rough",
    "can_low",
    "can_climb",
    "autonomous_strategy",
    "teleop_strategy",
    "average_points",
    "ideal_teams",
    "overall_evaluation"
];

?>

<html>
    <head>
        <title>Team Submit</title>
        <?php include ROOT."/template/head.php"; ?>
    </head>
    <body>

<?php

// Connect to the database
$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    echo "<p class=\"error\">Database error</p>";
}

// Collect the values from POST
$values = [];
foreach ($keys as $key) {
    $values[$key] = "\"" . (isset($_POST[$key]) ? $_POST[$key] : "0") . "\"";
}

// Assemble the SQL
$sql = "REPLACE INTO teams (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ");";

// Query the database
if ($connection->query($sql) === TRUE) {
    echo "<p class=\"info\">Submitted successfully</p>";
    header("Refresh: 2; URL=https://robot.mbhs.edu/scout/teams/");
} else {
    echo $connection->error;
}

$connection->close();

?>

    </body>
</html>

