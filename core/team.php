<?php

include_once "config.php";
include_once "session.php";

start();

$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if ($connection->connect_error) {
    header("Location: /scout/?database_error=1");
}

$keys = [
	"team_number" => "int(10) unsigned", 
	"team_name" => "varchar(32)", 
	"primary_mechanism" => "varchar(32)", 
	"drive_system" => "varchar(32)", 
	"drive_diameter" => "varchar(32)", 
	"drive_info" => "varchar(128)", 
	"can_high_goal" => "tinyint(1)", 
	"can_low_goal" => "tinyint(1)", 
	"scoring_system" => "varchar(256)", 
	"can_boulder" => "tinyint(1)", 
	"boulder_system" => "varchar(256)", 
	"can_portcullis" => "tinyint(1)", 
	"can_cheval" => "tinyint(1)", 
	"can_moat" => "tinyint(1)", 
	"can_ramparts" => "tinyint(1)", 
	"can_drawbridge" => "tinyint(1)", 
	"can_sally" => "tinyint(1)", 
	"can_rock" => "tinyint(1)", 
	"can_rough" => "tinyint(1)", 
	"can_low" => "tinyint(1)", 
	"can_climb" => "tinyint(1)", 
	"autonomous_strategy" => "varchar(512)", 
	"teleop_strategy" => "varchar(512)", 
	"average_points" => "int(11)", 
	"ideal_teams" => "varchar(256)", 
	"overall_evaluation" => "varchar(512)"
];

$values = [];
foreach ($keys as $key => $value) {
    &values[$key] = $_POST[&key];
}

$sql = "INSERT INTO teams (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";

if ($connection->query($sql) === TRUE) {
    echo "Submitted successfully";
} else {
    echo "Something messed up";
}

$connection->close();

?>