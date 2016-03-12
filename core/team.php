<?php

include_once "config.php";
include_once "session.php";

start();

function get_teams() {

    $connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($connection->connect_error) {
        echo "<p class=\"error\">Database error</p>";
    }

    $sql = "SELECT * FROM teams;";
    $result = $connection->query($sql);

    $teams = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teams[$row["team_number"]] = $row["team_name"];
        }
    }

    $connection->close();

    return $teams;

}

function get_team($team_number) {
	
	$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($connection->connect_error) {
        echo "<p class=\"error\">Database error</p>";
    }

    $sql = "SELECT * FROM teams WHERE team_number=" . $team_number . ";";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    $connection->close();
    return null;

}

?>
