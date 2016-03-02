<?php

class getComment {
    const DB_NAME = "comment";
    const ID = "textcode";

    public function execute() {
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $cursor = $db->textcode_comment->find();
        $arrRet = array();
        foreach($cursor as $doc) {
            $doc['create_time'] = date("Y-m-d H:i:s", (int)$doc['create_time']);
            $arrRet [] = $doc;
        }
        Page::jsonRet(0, 'success', $arrRet);
        return true;
    }
}

