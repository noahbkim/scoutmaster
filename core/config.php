<?php

// Database authentication
define("HOSTNAME", "localhost");
define("USERNAME", "www-data");
define("PASSWORD", ";lkjfdsa");
define("DATABASE", "scout");
define("REGISTRATION", "yes");

// The site passphrase
define("SECRET", "over9000");
define("SECRET_HASH", hash("sha512", SECRET));

?>
