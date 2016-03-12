<?php

include_once "config.php";
include_once "session.php";

start();

$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    header("Location: /scout/?database_error=1");
}

$keys = [
	"team_number",
	"team_name",
	"primary_mechanism",
	"drive_system",
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

$values = [];
foreach ($keys as $key) {
    $values[$key] = "\"" + $_GET[$key] + "\"";
}

$sql = "INSERT INTO teams (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";

if ($connection->query($sql) === TRUE) {
    echo "Submitted successfully";
} else {
    error_log("******************\n\n");
    echo $connection->error;
}

$connection->close();

?>
