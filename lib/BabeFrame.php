<?php

class BabeHouse {
    private static $_include_path = "";
    private static $_request_uri = "";

    public static function main() {
        // init
        self::$_include_path = get_include_path() . ":".LIB_PATH.":".APP_PATH;
        set_include_path(self::$_include_path);

        if (DEBUG) {
            foreach($_SERVER as $k => $v)  {
                echo $k." -> ".(is_array($v) ? serialize($v) : $v). "<br>";
            }
            echo "<br> ROOT_PATH : ".ROOT_PATH;
            echo "<br><br> LIB_PATH : ".LIB_PATH;
            echo "<br><br> APP_PATH : ".APP_PATH;
        }
        self::$_request_uri = Http_Request::getUri();
    }

    public static function autoloadframe($class_name, $path = LIB_PATH) {
        $strClassname = str_replace('_', '/', $class_name);
        $arrClassName = explode("/", $strClassname);
        $strClassPath = implode('/', $arrClassName);
        require_once($path."/".$strClassname.".php");
    }

    public static function autoloadapp($class_name, $path = APP_PATH) {
        $strClassname = str_replace('_', '/', $class_name);
        $arrClassName = explode("/", $strClassname);
        $strClassPath = implode('/', $arrClassName);
        require_once($path."/".$strClassname.".php");
    }

}

define("EXEC_FUNC", 'execute');
define('RUN_START_TIME', microtime());
define('LIB_PATH', __DIR__);
define('ROOT_PATH', __DIR__."/../");
define('APP_PATH', ROOT_PATH.APP_NAME);
spl_autoload_register(array('BabeHouse', "autoloadframe"));
spl_autoload_register(array('BabeHouse', "autoloadapp"));

if (!is_dir(APP_PATH)) {
    throw new Exception('invalid app, can not find the app path, app name : '. APP_NAME);
}

BabeHouse::main();

$arr_ui = Http_Request::getUi();
$str_ui = implode(Def::ACTION_SEP, $arr_ui);
$ui_path = APP_PATH . "/ui/". $str_ui . ".php";
if(!file_exists($ui_path)) {
    throw new Exception(sprintf("Invalid ui class, [%s]", $ui_path));
}

require_once($ui_path);
$class_name = $arr_ui[count($arr_ui)-1];
call_user_func(array($class_name, EXEC_FUNC));

define('RUN_END_TIME', microtime());
if(DEBUG) {
    $execute_time = (RUN_END_TIME - RUN_START_TIME)*1000;
    echo "execute time : $execute_time ms\n";
}
