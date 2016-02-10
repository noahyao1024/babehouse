<?php

class Storage_Db {
    private static $_db = null;

    private static function _init($db_name) {
        if (is_null(self::$_db)) {
            throw new Exception('connect db failed!');
        }
    }

    public static function query($sql, $db_name) {
        if (0 >= strlen($db_name)) {
            throw new Exception("invalid db_name");
        }
        if (is_null(self::$_db)) {
            self::_init($db_name);
        }
        $res = self::$_db->query();
        // todo
        // exception
        return $res;
    }

}
