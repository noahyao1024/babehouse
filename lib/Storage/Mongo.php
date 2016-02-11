<?php

class Storage_Mongo {
    private static $_db = array();

    private static function _init($db_name) {
        $m = new MongoClient();
        self::$_db[$db_name] = $m->selectDB($db_name);
        // exception
        // todo
    }

    public static function getDb($db_name) {
        if(!isset(self::$_db[$db_name])) {
            self::_init($db_name);
        }
        return self::$_db[$db_name];
    }

}
