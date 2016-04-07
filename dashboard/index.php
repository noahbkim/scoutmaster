<html>
	<head>
		<style>
                        h1 { margin-bottom: 0; }
			body { margin: 3em 5em; font-family: Arial; }
			table { width: 100%; font-size: 24px; margin-top: 1em; border-collapse: collapse; }
			canvas { margin-top: 1em; }
                        .columns { display: flex; display: -webkit-flex; flex-wrap: wrap; justify-content: center; margin-top: 0; }
			.column { float: left; font-size: 24px; min-width: 320px; max-width: 450px; flex-grow: 1; margin: 0.8em 1em 0 1em; }
			.column-left { }
                        .column-middle { }
			.column-right { }
			.clear { clear: both; }
			.left { }
			.right { float: right; }
			#table { min-height: 15em; }

                        @media only screen and (max-device-width : 640px) {
                            body { font-size: inherit; }
                        }
		</style>
		<script type="text/javascript">
			
			// Some constants
			var DELIMITER = "|";
			
			// Matches and other date
			var delay = 0;
			var rank = 0;
			var matches = [];
						
			// Strip
			var strip = function(string) { return string.trim(); }
			var int = function(string) { return parseInt(string, 10); }
			var digital = function(date) { return date.toLocaleTimeString().split(" ").slice(0, 2).join(" "); }
			var justify = function(digit) { return ("0" + digit).substr(-2); }
			var lap = function(date) { return date.getUTCHours() + ":" + justify(date.getUTCMinutes()); }
			
			// Load the file
			function load(index) {
				
				// Split the lines
				var lines = index.trim().split("\n");
				
				for (var i = 0; i < lines.length; i++) {						
					
					// Split into line and command
					var line = lines[i].trim();					
					var commands = line.split(DELIMITER).map(strip);
					
					// Delay set
					if (commands[0].startsWith("DELAY")) {
						delay = parseInt(commands[0].split(" ")[1]);
						
					// Rank set
					} else if (commands[0].startsWith("RANK")) {
						rank = parseInt(commands[0].split(" ")[1]);
					
					// Create a new match
					} else {
						var number = parseInt(commands[0]);
						var date = new Date(Date.parse(commands[1]));
						var red = commands[2].split(" ").slice(1).map(int);
						var blue = commands[3].split(" ").slice(1).map(int);
						var result = commands[4].replace("?", "-");
						var points = commands[5].replace("?", "-");
						matches.push(new Match(number, date, red, blue, result, points));
					}
					
				}
				
				// Sort the matches by time
				matches.sort(function(a, b) { return a.time == b.time ? 0 : (a.time > b.time ? 1 : -1); });
			
			}
			
			// A basic match container
			function Match(number, date, red, blue, result, points) {
				
				// The core fields of the match
				this.number = number;
				this.date = date;
				this.red = red;
				this.blue = blue;
				this.result = result;
				this.points = points;
				
				// Converting to HTML table row
				this.toRow = function() {
					
					var out = "";
					out += "<td>" + this.number + "</td>";
					out += "<td>" + digital(this.date) + "</td>";
					out += "<td>" + this.red.join(", ") + "</td>";
					out += "<td>" + this.blue.join(", ") + "</td>";
					out += "<td>" + this.result + "</td>";
					out += "<td>" + this.points + "</td>";
					return out;
					
				}
				
			}
			
			function update() {
				
				// Get a date and display it
				var date = new Date();
				clock.innerHTML = digital(date);
				
				// Iterate through the matches
				for (var i = 0; i < matches.length; i++) {
					var match = matches[i];

					// Get the first date ahead of the current time
					if (match.date > date) {
						
						// Show time until next match
						var difference = new Date(match.date - date);
						countdown.innerHTML = lap(difference);
						
						// Display upcoming alliance
						var red, blue;
						if (match.red.indexOf(449) > -1) {
							red = alliance; blue = opposition;
							color.innerHTML = "Red";
							color.style.color = "red";
						} else {
							red = opposition, blue = alliance;
							color.innerHTML = "Blue";
							color.style.color = "blue";
						}
						
						red.innerHTML = match.red.join(", ");
						red.style.color = "red";
						blue.innerHTML = match.blue.join(", ");
						blue.style.color = "blue";
						
						break;
						
					} else {
						
						document.getElementById(parseInt(match.number)).style.color = "gray";
						
					}
				}
				
				// Get the records
				var r = {"WIN": 0, "LOSE": 0, "TIE": 0, "-": 0}, c = 0;
				for (var i = 0; i < matches.length; i++) {
					var match = matches[i];

					// Count the records
					r[match.result] += 1;
					c += parseInt(match.points.replace("-", 0));
					
				}
				
				record.innerHTML = r["WIN"] + "-" + r["LOSE"] + "-" + r["TIE"];
				points.innerHTML = c;
				
			}
			
			function main(raw) {		
				
				// Load the index
				load(raw);
				
				// Insert the matches into the table
				var table = document.getElementById("matches");
				for (var i = 0; i < matches.length; i++) {
					var match = matches[i];

                                        if (!(match.red.indexOf(449) > -1 || match.blue.indexOf(449) > -1)) continue;

					var row = document.createElement("tr");
					row.id = match.number;
					row.innerHTML = match.toRow();

                                        // If a new day
                                        if (i > 0 && match.date.getDate() != matches[i-1].date.getDate()) {
                                            row.style.borderTop = "1px dashed gray";
                                        }

					table.appendChild(row);
				}
				
				// Set the delay
				document.getElementById("delay").innerHTML = delay + "m";
				document.getElementById("rank").innerHTML = rank;
				
				// Get elements
				var clock = document.getElementById("clock");
				var countdown = document.getElementById("countdown");
				var alliance = document.getElementById("alliance");
				var opposition = document.getElementById("opposition");
				var color = document.getElementById("color");
				var record = document.getElementById("record");
				var points = document.getElementById("points");
				var canvas = document.getElementById("canvas");
				// var height = canvas.height;
				// var width = canvas.width;
				// var context = canvas.getContext("2d");
				
                /*
				// Draw the graphs
				var i = 0;
				var p = [];
				while (matches[i].points != "-") { p.push(parseInt(matches[i].points)); i++; }
				var yk = (height - 10) / p.reduce(function(a, b) { return Math.max(a, b); });
				var xk = (width - 10) / p.length;
				var last = [5, 5];
				for (var i = 0; i < p.length; i++) {
					context.fillRect(i * xk + 2, p[i] * yk + 2, 6, 6);
				}
				*/
				
				// Set the upate
				setInterval(update, 100);
				
			}
            
            function start() {
                
                // Create an XHTTP request
                var request = new XMLHttpRequest();
                
                // Callback for when it loads
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                       var raw = request.responseText;
                       main(raw);
                    }
                };
                
                // Send the request
                request.open("GET", "matches.txt", true);
                request.send();
                
            }
		
		</script>
	</head>
	<body onload="javascript: start();">
		<h1>Matches</h1>
                <div class="columns">
			<div class="column column-left">
				<span class="left">Current time</span> <span id="clock" class="right">00:00:00</span><br>
				<span class="left">Until next match</span> <span id="countdown" class="right">00:00</span><br>
				<span class="left">Competition delay</span> <span id="delay" class="right">0m</span><br>
			</div>
			<div class="column column-middle">
				<span class="left">Upcoming alliance</span> <span id="alliance" class="right">0, 0, 0</span><br>
				<span class="left">Upcoming opposition</span> <span id="opposition" class="right">0, 0, 0</span><br>
				<span class="left">Upcoming color</span> <span id="color" class="right">None</span><br>
			</div>
			<div class="column column-right">
				<span class="left">Match record</span> <span id="record" class="right">0-0-0</span><br>
				<span class="left">Ranking points</span> <span id="points" class="right">0</span><br>
				<span class="left">Competition rank</span> <span id="rank" class="right">0</span><br>
			</div>
			<div class="clear"></div>
		</div>
                <!--canvas id="canvas" width=810 height=100>HTML 5 not available!</canvas-->
		<div id="table">
			<table id="matches">
				<tr>
					<td>#</td>
					<td>Time</td>
					<td>Red alliance</td>
					<td>Blue alliance</td>
					<td>Result</td>
					<td>Points</td>
				</tr>
			</table>
		</div>
	</body>
</html>
