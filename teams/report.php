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
	// Team data
	var teams = [];

	// Attributes to show
	var attribs = ["team_number", "team_name", "average_points"];

	// Meanings of attributes
	var attribs_eng = {};
	attribs_eng["team_number"] = "Team ID";
	attribs_eng["team_name"] = "Team name";
	attribs_eng["average_points"] = "Average points";

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

	function sort_teams(attrib) {
		teams.sort(function(a,b){
			if (a[attrib] < b[attrib]) {
				return -1;
			}
			if (a[attrib] > b[attrib]) {
				return 1;
			}
			return 0;
		});
	}

	function gen_team_tbl() {
		// Create a table and its body
		var tbl = document.createElement("table");
		tbl.id = "teams_tbl";
		tbl.style.width = "100%";
		tbl.setAttribute("border", "1");
		var tbdy = document.createElement("tbody");

		// Heading of table
		var tr = document.createElement("tr");
		for (var j = 0; j < attribs.length; j++) {
			var td = document.createElement("td");

			var text = document.createElement("b");
			text.innerHTML = attribs_eng[attribs[j]];

			td.onclick = function(){sort_teams(attribs[j]); load();}
			console.log(td);
			console.log(td.onclick);

			td.appendChild(text);
			tr.appendChild(td);
		}
		tbdy.appendChild(tr);

		// Add certain attributes for every team
		for (var i = 0; i < teams.length; i++) {
			var tr = document.createElement("tr");
			for (var j = 0; j < attribs.length; j++) {
				var td = document.createElement("td");
				td.appendChild(document.createTextNode(teams[i][attribs[j]]));
				tr.appendChild(td);
			}
			tbdy.appendChild(tr);
		}

		tbl.appendChild(tbdy);
		return tbl;
	}

	function load() {
		var old_tbl = document.getElementById("teams_tbl");
		if (old_tbl != null) old_tbl.parentElement.removeChild(old_tbl);

		document.getElementsByTagName("body")[0].appendChild(gen_team_tbl());
	}
    </script>

    </head>
    <body onload="load()">
    </body>
</html>
