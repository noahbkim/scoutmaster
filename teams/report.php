<?php 

// Global include
include_once "scout/global.php";

// Include the necessary files
include_once ROOT."/core/session.php";
include_once ROOT."/core/auth.php";
include_once ROOT."/core/team.php";

// Start the session
start();

// Check authentication
enforce();

// Get the list of teams
$teams = get_teams();

?>

<html>
    <head>
        <title>Scoutmaster</title>
        <?php include ROOT."/template/head.php"; ?>

	<script type="text/javascript">
	var teams = [];

        <?php   

        // Check if a team ID is specified  
	foreach ($teams as $team_id => $team) {
        
		// Create a team
		echo "var team" . $team["team_number"] . " = new Object();";

                // Echo all the team attributes
                foreach($team as $name => $value) {
		    if (is_numeric($value)) { echo "team" . $team["team_number"] . "." . $name . " = " . $value . ";"; }
		    else if (is_string($value)) { echo "team" . $team["team_number"] . "." . $name . " = \"" . $value . "\";"; }
                }
            
                // Add to teams array
		echo "teams.push(team" . $team["team_number"] . ");";
        }
    
        ?>

	function load() { alert("Hi"); }
    </script>

    </head>
    <body onload="load()">
    </body>
</html>
