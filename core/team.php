<?php

// Include files
$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path."/core/config.php";
include_once $path."/core/session.php";

// Start the session
start();

// Get the list of teams numbers => team names 
function get_teams() {

    // Create the database connection
    $connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($connection->connect_error) {
        echo "<p class=\"error\">Database error</p>";
    }

    // Generate SQL
    $sql = "SELECT * FROM teams;";
    $result = $connection->query($sql);

    // Record the results
    $teams = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teams[$row["team_number"]] = $row["team_name"];
        }
    }

    // Close the connection
    $connection->close();

    // Return the map
    return $teams;

}

// Get all information on a team
function get_team($team_number) {
	
	// Create the database connection
	$connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($connection->connect_error) {
        echo "<p class=\"error\">Database error</p>";
    }

    // Select the team
    $sql = "SELECT * FROM teams WHERE team_number=" . $team_number . ";";
    $result = $connection->query($sql);

    // Return the row
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    // Close the connection
    $connection->close();
    
    // Return null if none were found
    return null;

}

?>
