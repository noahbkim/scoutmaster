<?php

include_once "../core/session.php";
include_once "../core/team.php";

start();
$teams = overview();

?>

<html>
    <body>
        <table border="1">
		
		<tr>
		<td>Team ID</td>
		<td>Team name</td>
		</tr>
		
		<?php
		foreach ($teams as $team){
			echo "<tr>";
			echo "<td>" . $team["team_id"] . "</td>";
			echo "<td>" . $row["team_name"] . "</td>";
			echo "</tr>";
		}
		?>
		</table>
    </body>
</html>
