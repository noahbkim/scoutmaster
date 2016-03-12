<?php

include_once "config.php";
include_once "session.php";

start();

function overview() {

        $connection = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
        if ($connection->connect_error) {
                echo "<p class=\"error\">Database error</p>";
        }

        $sql = "SELECT * FROM teams;";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        echo $row["team_number"] . "/ " . $row["team_name"];
                }
        }

        $connection->close();
}

?>
