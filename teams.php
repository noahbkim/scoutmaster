<html>
    <head>
        <title>Scoutmaster</title>
        <?php include "template/head.php"; ?>
    </head>
    <body>
        <form>
            <b>Team ID: </b> <input type="number" name="team_number" size="5" maxlength="5"><br>
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
            If other, enter here: <input type="text" name="driver_system_other"><br><br>
            
            <b>Drive wheel diameter</b> (if applicable): <input type="text" name="drive_diameter"><br>
            <b>Other info:</b><input type="text" name="drive_info"><br><br>

            <b>Can it score high/low goals? </b> <input type="checkbox" name="can_high_goal"> High <input type="checkbox" name="can_low_goal"> Low <br>
            How well? How fast (timewise/how many times per game)? Does it have automatic aiming? How does it do these things?<br>
            <input type="text" name="scoring_system" style="height: 200px; width: 100%;"><br><br>

            <b>Can it pick up boulders?</b> <input type="radio" name="can_boulder" value="yes"> Yes <input type="radio" name="can_boulder", value="no"> No <br>
            Where does it get the boulders from? What is the ball intake/release strategy?<br>
            <input type="text" name="boulder_system" style="height: 200px; width: 100%;"><br><br>
            
            
            <b>Ball intake release strategy</b><br>
            How does it drop them off? How long does it take? Are they kicked, launched, punched, or simply dropped?<br><input type="text" name="boulderdesc" style="height: 200px; width: 100%;"><br><br>

            <b>What defenses can the robot pass? How well can it pass them?</b><br>
            Category A:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_portcullis" value="yes">Portcullis<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_cheval" value="yes">Cheval de Frise<br>
            Category B:<br> 
            &nbsp;&nbsp;<input type="checkbox" name="can_moat" value="yes">Moat<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_ramparts" value="yes">Ramparts<br>
            Category C:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_drawbridge" value="yes">Drawbridge<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_sally" value="yes">Sally Port<br>
            Category D:<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_rock" value="yes">Rock Wall<br>
            &nbsp;&nbsp;<input type="checkbox" name="can_rough" value="yes">Rough Terrain<br>
            <br>
            
            <b>Can climb the tower: </b> <input type="radio" name="can_climb" value="yes"> Yes <input type="radio" name="can_climb" value="no"> No<br><br>

            <b>What is the autonomous strategy</b><br>
            Where does the robot start? Does it move forward? Can it pass a defense? Does it have a ball?<br>
            <input type="text" name="autonomous_strategy" style="height: 200px; width: 100%;"><br><br>
            
            <b>What is the teleop strategy?</b><br>
            <input type="text" name="teleopdesc" style="height: 200px; width: 100%;"><br><br>

            <b>Average points per match: </b> <input type="number" name="points"><br><br>

            <b>Their ideal team (desired robots in alliance)</b><br>
            <input type="text" name="idealteam" style="height: 200px; width: 100%;"><br><br>

            <b>Overall evaluation</b><br>
            Would we want to be in an alliance with them? Are they good? Are they confident?
            <input type="text" name="evaluation" style="height: 200px; width: 100%;"><br><br>
        </form>
    </body>
</html>
