<?php

class setting {
    const DB_NAME = "pagedata";
    const ID = "show";

    public static function execute() {
        $website_data = Http_Request::getAll();

        $doc = array(
            "_id" => self::ID,
        );
        $db = Storage_Mongo::getDb(self::DB_NAME);
        foreach($website_data as $key => $value) {
            $doc[$key] = $value;
        }

        $res = $db->textcode->save($doc);
        $arrRet = array();
        $arrRet = $res;
        Page::jsonRet(0, 'success', $arrRet);
        return true;
    }
}
