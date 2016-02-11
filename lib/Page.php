<?php
/***************************************************************************
 * 
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/

/**
 * @file Page.php
 * @author yaokun(com@baidu.com)
 * @date 2016/02/10 20:49:33
 * @brief 
 *  
 **/

class Page {
    private static $_value = array();

    public static function setTpl($tpl) {
        $tpl_file = sprintf("%s/tpl/%s.tpl", APP_PATH, $tpl);
        if (!file_exists($tpl_file)) {
            throw new Exception(sprintf("fail to find tpl[%s]", $tpl_file));
        }
        echo "<script type='text/javascript'>";
        foreach(self::$_value as $k => $v) {
            if(is_array($v)) {
                echo sprintf("var %s = %s", $k, json_encode($v));
            } else {
                echo sprintf("var %s = %s", $k, $v);
            }
        }
        echo "</script>\n";
        require_once($tpl_file);
    }

    public static function assign($key, $value) {
        self::$_value[$key] = $value;
    }

    public static function get($key) {
        if(!isset(self::$_value[$key])) {
            return null;
        } else {
            return self::$_value[$key];
        }
    }

    public static function jsonRet($errno = 0, $errmsg = "success", $data = null) {
        $arrRet = array(
            'errno' => $errno,
            'errmsg' => $errmsg,
        );
        if (!is_null($data)) {
            $arrRet['data'] = $data;
        }
        echo json_encode($arrRet);
    }
}
