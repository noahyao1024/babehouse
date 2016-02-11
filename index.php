<?php

try {
    define("APP_NAME", 'textcode');
    define('DEBUG', true);

    require_once('lib/BabeFrame.php');
} catch(Exception $e) {
    $errmsg = $e->getMessage();
    echo sprintf("<center><h1>%s :( </h2>\n</center>", $errmsg);
}

?>
