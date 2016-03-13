<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/session.php";
include_once ROOT."/core/auth.php";
include_once ROOT."/core/team.php";

// Start the session
start();

// Enforce authentication
enforce();

// Get the list of teams
$teams = get_teams();

?>

<html>
    <head>
        <title>Scoutmaster Teams</title>
        <?php include ROOT."/template/head.php"; ?>
    </head>
    <body>
        <?php include ROOT."/template/navigation.php"; ?>

	<p><a href="https://robot.mbhs.edu/scout/teams/report.php">Team data report &rarr;</a></p>

        <table border="1">
            <tr>
                <td><b>Team ID</b></td>
                <td><b>Team name</b></td>
            </tr>
        
            <?php
            
            // Generate the list of teams
            foreach ($teams as $team_id => $team) {
                echo "<tr onclick=\"javascript: window.location.href = 'https://robot.mbhs.edu/scout/teams/edit.php?id=" . $team_id . "';\">";
                echo "<td>" . $team_id . "</td>";
                echo "<td style=\"width: 60%;\">" . $team["team_name"] . "</td>";
                echo "</tr>";
            }
            
            ?>
        
        </table>
        <p style="float: left;">Click to edit or delete</p>
	<p style="float: right;"><a href="https://robot.mbhs.edu/scout/teams/edit.php">Add new</a></p><br><br>
    </body>
</html>
