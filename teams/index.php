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
