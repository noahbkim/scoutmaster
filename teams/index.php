<?php

// Include files
$path = $_SERVER['DOCUMENT_ROOT'];
include_once $path."/core/session.php";
include_once $path."/core/auth.php";
include_once $path."/core/team.php";

// Start the session
start();

// Enforce authentication
enforce();

// Get the list of teams
$teams = get_teams();

?>

<html>
    <body>
        <table border="1">
            <tr>
                <td><b>Team ID</b></td>
                <td><b>Team name</b></td>
            </tr>
        
            <?php
            
            // Generate the list of teams
            foreach ($teams as $team_id => $team_number) {
                echo "<tr>";
                echo "<td>" . $team_id . "</td>";
                echo "<td>" . $team_number . "</td>";
                echo "</tr>";
            }
            
            ?>
        
        </table>
    </body>
</html>
