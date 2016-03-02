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
    const TPL = "show/index";
    const DB_NAME = "pagedata";

    public function execute() {
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $res = $db->textcode->findOne();
        $arrOutput = $res;
        Page::assign("pagedata", $arrOutput);
        Page::setTpl(self::TPL);
    }
}
