<html>

<head>
<title>Scoutmaster</title>

<body>

<form>
<b>Scouted by:</b> <input type="text" name="scouter"><br><br>

<b>Team ID: </b> <input type="number" name="teamid" size="5" maxlength="5"><br>
<b>Team name: </b> <input type="text" name="teamname"><br><br>

<b>Primary scoring mechanism: </b>
 <select name="scoring">
  <option value="shoot">Shooting</option>
  <option value="breach">Breaching</option>
  <option value="other">Other</option>
 </select><br>
If other, enter here: <input type="text" name="scoreother"><br><br>

<b>Wheel type: </b>
 <select name="wheeltype">
  <option value="omni">Omni</option>
  <option value="mechanum">Mechanum</option>
  <option value="pneumatic">Pneumatic</option>
  <option value="trends">Trends</option>
  <option value="other">Other</option>
 </select><br>
If other, enter here: <input type="text" name="wheeltypeother"><br>
<b>Number of wheels</b>: <input type="number" name="wheelcount"><br>
<b>Diameter</b> (if applicable): <input type="number" name="wheeldiam"><br>
<b>Other info:</b> <input type="text" name="wheelsother"><br>
</form>

<b>Can score high goals: </b> <input type="radio" name="highgoal" value="yes"> Yes    <input type="radio" name="highgoal" value="no"> No<br>
How well? How fast? What is its method?<br><input type="text" name="highgoaldesc" style="height:200px;width:800px;"><br><br>

<b>Can score low goals: </b> <input type="radio" name="lowgoal" value="yes"> Yes    <input type="radio" name="lowgoal" value="no"> No<br>
How well? How fast? What is its method?<br><input type="text" name="lowgoaldesc" style="height:200px;width:800px;"><br><br>

<b>Can pick up boulders: </b> <input type="radio" name="boulder" value="yes"> Yes    <input type="radio" name="boulder" value="no"> No<br>
How well? How fast? What is its method?<br><input type="text" name="boulderdesc" style="height:200px;width:800px;"><br><br>

<b>Ball intake release strategy</b><br>
How does it drop them off? How long does it take? Are they kicked, launched, punched, or simply dropped?<br><input type="text" name="boulderdesc" style="height:200px;width:800px;"><br><br>

<b>Defenses it can pass</b><br>
Category A: <input type="checkbox" name="portcullis" value="Portcullis">Portcullis <input type="checkbox" name="cheval" value="Cheval de Frise">Cheval de Frise<br>
Category B: <input type="checkbox" name="moat" value="Moat">Moat <input type="checkbox" name="ramparts" value="Ramparts">Ramparts<br>
Category C: <input type="checkbox" name="drawbridge" value="Drawbridge">Drawbridge <input type="checkbox" name="sallyport" value="Sally Port">Sally Port<br>
Category D: <input type="checkbox" name="rockwall" value="Rock Wall">Rock Wall <input type="checkbox" name="roughterrain" value="Rough Terrain">Rough Terrain<br>
Other details: <input type="text" name="defdesc" style="height:150px;width:800px;"><br><br>

<b>Can climb the tower: </b> <input type="radio" name="towerclimb" value="yes"> Yes    <input type="radio" name="towerclimb" value="no"> No<br><br>

<b>Autonomous strategy</b><br>
Where does the robot start? Does it move forward? Can it pass a defense? Does it have a ball?<br><input type="text" name="autodesc" style="height:200px;width:800px;"><br><br>

<b>Teleop strategy</b><br>
<input type="text" name="teleopdesc" style="height:200px;width:800px;"><br><br>

<b>Average points per match: </b> <input type="number" name="points"><br><br>

<b>Their ideal team (desired robots in alliance)</b><br>
<input type="text" name="idealteam" style="height:200px;width:800px;"><br><br>

<b>Overall evaluation</b><br>
Would we want to be in an alliance with them? Are they good? Are they confident?
<input type="text" name="evaluation" style="height:200px;width:800px;"><br><br>
</body>

</html>