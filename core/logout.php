<?php

include_once "session.php";

$_SESSION["secret"] = "";
stop();

header("Location: /scout/");

?>
