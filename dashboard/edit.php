<?php

// Global include
include_once "scout/global.php";

// Include files
include_once ROOT."/core/session.php";
include_once ROOT."/core/auth.php";

// Start the session
start();

?>

<?php

// File to edit
$file = "/var/www/scout/dashboard/matches.txt";

// Check the post for the submitted text
if (isset($_POST['text']))
{
    // Save the text contents
    file_put_contents($file, $_POST['text']);

    // Redirect to form again
    header("Location: https://robot.mbhs.edu/scout/dashboard/edit.php");
    exit();
}

// Read the textfile
$text = file_get_contents($file);

?>

<html>
    <head>
        <title>Dashboard editor</title>
    </head>
    <body>
        <div id="contents">
            <form action="" method="post">
                <textarea name="text" style="width: 100%; height: 90%; font-family: consolas;"><?php echo htmlspecialchars($text) ?></textarea>
                <br><br>
                <input type="submit"/>
                <input type="reset"/>
            </form>
        </div>
    </body>
</html>
