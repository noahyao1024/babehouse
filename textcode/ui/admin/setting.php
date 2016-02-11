<?php

class setting {

    public static function execute() {
        $title = Http_Request::get('title', 0);
        $nav1 = Http_Request::get('nav1', '');
        $arrRet = array(
            'yaokun' => 123,
        );
        Page::jsonRet(0, 'success', $arrRet);
        return true;
    }
}
