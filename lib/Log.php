<?php
/***************************************************************************
 * 
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/

/**
 * @file Log.php
 * @author yaokun(com@baidu.com)
 * @date 2016/08/12 16:37:12
 * @brief 
 *  
 **/

class Log {
    // log type
    const LOG_TYPE_FILE = 1;

    private static $_strLogfile = "";

    public static function warning($strMsg, $intType = 0) {
        $message = sprintf("Time : [%s] Errmsg : [%s]\n", date("Y-m-d H:i:s", time()), $strMsg);
        file_put_contents(self::$_strLogfile.".log.wf", $message, FILE_APPEND);
    }

    public static function notice($strMsg, $intType = 0) {
        $message = sprintf("Time : [%s] Errmsg : [%s]\n", date("Y-m-d H:i:s", time()), $strMsg);
        file_put_contents(self::$_strLogfile.".log", $message, FILE_APPEND);
    }

    public static function init($strFilename) {
        self::$_strLogfile = $strFilename;
    }
}
