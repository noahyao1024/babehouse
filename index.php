<?php

function init() {
    if(!defined(APP_NAME)) {
        $request_uri = $_SERVER['REQUEST_URI'];
        $arr_tmp = explode("/", $request_uri);
        $app_name = $arr_tmp[2];
        define(APP_NAME, $app_name);
    }
}

try {
    //define("APP_NAME", 'textcode');

    init();
    define('DEBUG', false);
    require_once('lib/BabeFrame.php');
} catch(Exception $e) {
    $errmsg = $e->getMessage();
    echo sprintf("<center><h1>%s :( </h2>\n</center>", $errmsg);
}

?>
