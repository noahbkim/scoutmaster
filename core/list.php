<?php

include_once "session.php";
include_once "auth.php";

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
		$username = "www-data";
		$password = ";lkjfdsa";
		$dbname = "teamdb";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) { echo "DB connection failed"; }
		
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