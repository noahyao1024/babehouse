<?php

class Storage_Db {
    private static $_dbMap = null;

    /*
     * 
     $dbConfig = array(
         "host:port",
         "root"
         "passwd",
         "db",
     );
     */


    private static function _getDb($dbconfig) {
        $key = implode("|", $dbconfig);
        if(!isset(self::$_dbMap[$key])) {
            $db = new mysqli($dbconfig[0], $dbconfig[1], $dbconfig[2], $dbconfig[3]);
            if(false === $db) {
                throw new Exception(sprintf("fail to init db!"));
            }
            self::$_dbMap[$key] = $db;
        }
        return self::$_dbMap[$key];
    }

    public static function query($sql, $dbconfig, $is_throw_exception = false, $is_debug = false) {
        $db = self::_getDb($dbconfig);
        $ret_handler = $db->query($sql);
        if(0 === $db->errno) {
        } else {
            //throw new Exception(sprintf("fail to execute sql[%s], errmsg[%s]", $sql, $db->error));
            if($is_throw_exception) {
                return sprintf("fail to execute sql[%s], errmsg[%s]", $sql, $db->error);
            }
        }
        if(is_bool($ret_handler)) {
            return $ret_handler;
        } else {
            return $ret_handler->fetch_all(MYSQLI_ASSOC);
        }
    }

    public static function getError($dbconfig) {
        $db = self::_getDb($dbconfig);
        return array($db->errno, $db->error);
    }

}
