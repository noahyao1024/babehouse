<?php

class index {
    const TPL = "admin/setting";
    const DB_NAME = "pagedata";

    public function execute() {
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $res = $db->textcode->findOne();
        if (is_null($res)) {
            $res = array();
        }
        Page::assign('pagedata', $res);
        Page::setTpl(self::TPL);
    }
}
