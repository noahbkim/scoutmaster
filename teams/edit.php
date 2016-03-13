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

?>

<html>
    <head>
        <title>Scoutmaster</title>
        <?php include ROOT."/template/head.php"; ?>
        <script>
            function assign(form, name, value) {
                
                // Probably a checkbox or radio button
                if (form[name].hasOwnProperty("length")) {
                    if (form[name].type == "checkbox") {
                        form[name].checked = value == "1" ? 1 : 0;
                    } else if (form[name][0].type == "radio") {
                        form[name].value == "1" ? 0 : 1].checked = 1;
                    }
                }
                
                // Otherwise
                form[name].value = value;
                
            }

            function load() {}
        </script>
    
        <?php   

        // Check if a team ID is specified  
        if (isset($_GET["id"])) {
    
            // If so, get the team
            $team = get_team($_GET["id"]);
        
            // Check if the team exists
            if ($team != null) {
        
                // Start a script that fills in the inputs
                echo "<script type=\"text/javascript\">\n";
                echo "function load() { ";
                echo "var form = document.getElementById(\"form\");";
            
                // Echo all the hardcoded updates
                foreach($team as $name => $value) {
                    echo "assign(form, \"" . $name . "\", \"" . $value . "\"); ";
                }
            
                // End the script
                echo "} </script>\n";
    
            }
    
        }
    
        ?>
    </head>
    <body onload="load()">
        <form method="post" action="/scout/post/team.php" id="form">
            <b>Team number: </b> <input type="number" name="team_number" size="5" maxlength="5"><br>
            <b>Team name: </b> <input type="text" name="team_name"><br><br>
            
            <b>Primary scoring mechanism:</b>
            <select name="primary_mechanism">
                <option value="shoot">Shooting</option>
                <option value="breach">Breaching</option>
                <option value="other">Other</option>
            </select><br>
            If other, enter here: <input type="text" name="primary_mechanism_other"><br><br>

            <b>Drive type:</b>
            <select name="drive_system">
                <option value="omni">Omni</option>
                <option value="mechanum">Mechanum</option>
                <option value="pneumatic">Pneumatic</option>
                <option value="trends">Trends</option>
                <option value="other">Other</option>
            </select><br>
            If other, enter here: <input type="text" name="drive_system_other"><br><br>
            
            <b>Drive wheel diameter</b> (if applicable): <input type="text" name="drive_diameter"><br>
            <b>Other info:</b><input type="text" name="drive_info"><br><br>

            <b>Can it score high/low goals? </b> <input type="checkbox" name="can_high_goal" value="1"> High <input type="checkbox" name="can_low_goal" value="1"> Low <br>
            How well? How fast (timewise/how many times per game)? Does it have automatic aiming? How does it do these things?<br>
            <textarea name="scoring_system"></textarea><br><br>

            <b>Can it pick up boulders?</b> <input type="radio" name="can_boulder" value="1"> Yes <input type="radio" name="can_boulder" value="0" checked="checked"> No <br>
            Where does it get the boulders from? What is the ball intake/release strategy?<br>
            <textarea name="boulder_system"></textarea><br><br>
            
            <b>What defenses can the robot pass? How well can it pass them?</b><br>
            Category A:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_portcullis" value="1">Portcullis<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_cheval" value="1">Cheval de Frise<br>
            Category B:<br> 
            &nbsp;&nbsp;<input type="checkbox" name="can_moat" value="1">Moat<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_ramparts" value="1">Ramparts<br>
            Category C:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_drawbridge" value="1">Drawbridge<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_sally" value="1">Sally Port<br>
            Category D:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_rock" value="1">Rock Wall<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_rough" value="1">Rough Terrain<br>
            <br>
            
            <b>Can go under the low bar: </b> <input type="radio" name="can_low" value="1"> Yes <input type="radio" name="can_low" value="0" checked="checked"> No<br><br>
            <b>Can climb the tower: </b> <input type="radio" name="can_climb" value="1"> Yes <input type="radio" name="can_climb" value="0" checked="checked"> No<br><br>

            <b>What is the autonomous strategy</b><br>
            Where does the robot start? Does it move forward? Can it pass a defense? Does it have a ball?<br>
            <textarea name="autonomous_strategy"></textarea><br><br>
            
            <b>What is the teleop strategy?</b><br>
            <textarea name="teleop_strategy"></textarea><br><br>

            <b>Average points per match: </b> <input type="number" name="average_points"><br><br>

            <b>Their ideal team (desired robots in alliance)</b><br>
            <textarea name="ideal_teams"></textarea><br><br>

            <b>Overall evaluation</b><br>
            Would we want to be in an alliance with them? Are they good? Are they confident?
            <textarea name="overall_evaluation"></textarea><br><br>
            
            <input type="submit" value="Finish">
            <input type="button" onclick="javascript: window.location.href = 'https://robot.mbhs.edu/scout/teams/delete.php?id=' + document.getElementById('form').team_number.value" value="Delete">
            <input type="button" onclick="javascript: window.location.href = 'https://robot.mbhs.edu/scout/teams/';" value="Back">
        </form>
    </body>
</html>
