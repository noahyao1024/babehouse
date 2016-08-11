<?php

class Storage_Db {
    private static $_dbMap = null;

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

    public static function query($sql, $dbconfig) {
        $db = self::_getDb($dbconfig);
        $ret_handler = $db->query($sql);
        if(0 === $db->errno) {
        } else {
            throw new Exception(sprintf("fail to execute sql[%s]", $sql));
        }
        if(is_bool($ret_handler)) {
            return $ret_handler;
        } else {
            return $ret_handler->fetch_all(MYSQLI_ASSOC);
        }
    }

}
