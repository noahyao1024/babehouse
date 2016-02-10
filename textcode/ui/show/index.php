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
    
    public function execute() {
        Page::assign("yaokun", array("foo" => 123, ));
        Page::setTpl(self::TPL);
    
    }
}
