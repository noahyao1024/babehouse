<?php

class comment {
    const DB_NAME = "comment";
    const ID = "textcode";

    public function execute() {
        $email = Http_Request::get('email', '');
        $content = Http_Request::get('content', '');
        if (0 < strlen($email) && 0 < strlen($content)) {
        } else {
            Page::jsonRet(-1, 'param error');
            return false;
        }
        $time = time();
        $doc = array(
            'email' => $email,
            'content' => $content,
            'create_time' => $time,
        );
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $arrRet = $db->textcode_comment->save($doc);
        Page::jsonRet(0, 'success', $arrRet);
        return true;
    }
}

