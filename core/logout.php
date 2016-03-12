<?php

include_once "session.php";
start();

$_SESSION["secret"] = "";

header("Location: /scout/");

?>
