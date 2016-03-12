<?php

session_start();
$_SESSION["secret"] = "";
session_destroy();

?>
