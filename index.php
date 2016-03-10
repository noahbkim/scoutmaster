<?php

require("include/session.php");
start();

?>

<html>
    <body>
        <?php

            if (authenticate()) {
                include("html/index.html");
            } else {
                header("Location: /scout/login.php");
            }

        ?>
    </body>
</html>
