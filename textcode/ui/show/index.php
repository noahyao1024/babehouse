<?php
/***************************************************************************
 * 
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/

/**
 * @file index.php
 * @author yaokun(com@baidu.com)
 * @date 2016/02/10 15:05:34
 * @brief 
 *  
 **/

class index {
    const TPL = "index";
    const DB_NAME = "test";

    public function execute() {
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $res = $db->textcode->findOne();
        $arrOutput = array(
            'title' => $res['title'],
            'nav1' => $res['nav1'],
            'nav2' => $res['nav2'],
            'nav3' => $res['nav3'],
            'center' => $res['center'],
            'intro' => $res['intro'],
        );
        Page::assign("pagedata", $arrOutput);
        Page::setTpl(self::TPL);

    }
}
