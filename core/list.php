<?php

include_once "core/session.php";
include_once "core/auth.php";

start();

if (!auth()) {
    header("Location: /scout/");
}

?>

<html>
    <body>
        <table border="1">
		
		<tr>
		<td>Team ID</td>
		<td>Team name</td>
		</tr>
		
		<?php
		// Connect to DB
		$servername = "localhost";
		$username = "robot";
		$password = "Teque449";
		$dbname = "teamdb";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
		
		// Query each team's name
		$sql = "SELECT teamname, teamid FROM teams";
		$result = $conn->query($sql);
		
		// Output each table row
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["teamid"] . "</td>";
				echo "<td>" . $row["teamname"] . "</td>";
				echo "</tr>";
			}
		}
		?>
		</table>
    </body>
</html>
