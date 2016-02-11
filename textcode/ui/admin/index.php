<?php

class index {
    const TPL = "setting";
    
    public function execute() {
        $title = Http_Request::get('title', 0);
        $nav1 = Http_Request::get('nav1', '');
        Page::setTpl(self::TPL);
    }
}
