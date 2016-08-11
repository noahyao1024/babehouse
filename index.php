<?php

/*
 *
 * url example
 * http:///host:8080/bhf/hello/say
 */
function init() {
    $request_uri = $_SERVER['REQUEST_URI'];
    $arr_tmp = explode("/", $request_uri);
    $app_name = $arr_tmp[2];
    define(APP_NAME, $app_name);
}

try {
    init();
    define('DEBUG', false);
    define("APP_PATH", "../app/".APP_NAME);
    require_once('lib/BabeFrame.php');
} catch(Exception $e) {
    $errmsg = $e->getMessage();
    echo sprintf("<center><h2>%s :( </h2>\n</center>", $errmsg);
}

?>
