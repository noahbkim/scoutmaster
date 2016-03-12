<?php

include_once "config.php";
include_once "session.php";

start();

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

function add() {

	$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	if ($connection->connect_error) {
		echo "<p class=\"error\">Database error</p>";
	}

	$values = [];
	foreach ($keys as $key) {
	    $values[$key] = "\"" + $_GET[$key] + "\"";
	}

	$sql = "INSERT INTO teams (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ");";

	if ($connection->query($sql) === TRUE) {
	    echo "<p class=\"info\">Submitted successfully</p>";
	} else {
	    echo $connection->error;
	}

	$connection->close();

}

if (!in_array(basename(__FILE__), get_included_files())) {
	add();
}

function overview() {

	$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
	if ($connection->connect_error) {
		echo "<p class=\"error\">Database error</p>";
	}
	
	$sql = "SELECT * FROM teams;";
	$result = $connection->query($sql));
	
	while ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo $row["team_number"] . ": " . $row["team_name"];
		}
	}
	
	$connection->close();

}

?>
