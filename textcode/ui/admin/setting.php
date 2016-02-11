<?php

class setting {
    const DB_NAME = "test";

    public static function execute() {
        $title = Http_Request::get('title', '');
        $nav1 = Http_Request::get('nav1', '');
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $doc = array(
            'title' => $title,
            'nav1' => $nav1,
        );
        $res = $db->textcode->insert($doc);
        $arrRet = array();
        $arrRet = $res;
        Page::jsonRet(0, 'success', $arrRet);
        return true;
    }
}
