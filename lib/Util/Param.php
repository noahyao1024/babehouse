<?php

/**
 * @brief 参数校验基础库
 * @author yaokun
 */
class Util_Param {
    // param type const
    const DEFAULT_NOT_NULL  = 1;
    const INT_POSITIVE      = 2;
    const INT_NOT_ZERO      = 3;
    const INT_NEGATIVE      = 4;
    const INT_DEFAULT       = 5; //判断是否是int
    const STRING_DEFAULT    = 6; //判断是否是string
    const STRING_NOT_NULL   = 7; //非空字符串
    const ARRAY_DEFAULT     = 8;
    const ARRAY_NOT_NULL    = 9;

    // other check const
    const PHONE_TYPE_CELEPHONE = 0;
    const PHONE_TYPE_TELEPHONE = 1;
    const PHONE_TYPE_BOTH      = 2;

    // static vars
    static private $_errmsgMap = null;

    // pattern
    const PATTERN_CELEPHONE = "#^(1[0-9]{10})$#";
    const PATTERN_PHONE0 = "#^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$#";
    const PATTERN_PHONE1 = "#^(400|800)(\-)?[0-9]{3}(\-)?[0-9]{4}$#"; //400,800-12345678
    const PATTERN_PHONE2 = "#^[0-9]{5}$#"; //10086
    
    const PATTERN_ID        = ""; //身份证

    private static function _init() {
        // init errmsg map
        self::$_errmsgMap = array(
            self::DEFAULT_NOT_NULL  => 'null',
            self::STRING_NOT_NULL   => 'string is empty',
            self::INT_POSITIVE      => 'int is not positive',
            self::INT_NOT_ZERO      => 'int is zero',
            self::INT_DEFAULT       => 'not int',
            self::STRING_DEFAULT    => 'not string',
        );
    }

    private static function _getErrmsg($type) {
        if (is_null(self::$_errmsgMap)) {
            self::_init();
        }
        return self::$_errmsgMap[$type];
    }

    /**
     * @brief return Error
     *
     * @param $name
     * @param $type
     * @param $is_throw_exception
     *
     * @return string
     */
    private static function _returnError($name, $type, $is_throw_exception) {
        $msg = self::_getErrmsg($type);
        if($is_throw_exception) {
            throw new Exception("input [$name]->[$msg]", Tieba_Errcode::ERR_PARAM_ERROR);
        } else {
            return $msg;
        }
    }

    /**
     * @brief 检查参数校验
     *
     * @param $arrInput 入参
     * @param $arrField 数据域
     * @param $arrOpt 选项
     *
     * @return 
     */
    public static function checkParam($arrInput, $arrField, $arrOpt = array()) {
        $arrRet = array();
        $is_throw_exception = (int)$arrOpt['is_throw_exception'];
        foreach($arrField as $name => $type) {
            $val = $arrInput[$name];
            switch($type) {
                case self::DEFAULT_NOT_NULL:
                    if(is_null($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::STRING_NOT_NULL:
                    if(0 >= strlen($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::STRING_DEFAULT:
                    if (!is_string($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::INT_POSITIVE:
                    if (0 >= (int)$val) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::INT_NOT_ZERO:
                    if (0 === (int)$val) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::INT_NEGATIVE:
                    if (0 <= (int)$val) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::INT_DEFAULT:
                    if (!is_int($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::ARRAY_DEFAULT:
                    if (!is_array($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                case self::ARRAY_NOT_NULL:
                    if (!is_array($val) || empty($val)) {
                        self::_returnError($name, $type, $is_throw_exception);
                        return false;
                    }
                    break;
                default:
                    return false;
                    break;
            }
        }
        return true;
    }

    /**
     * @brief check phone is valid, mobile or tel can be choose
     *
     * @param $phone
     *
     * @return boolean
     */
    public static function checkPhone($phone, $type = self::PHONE_TYPE_BOTH) {
        $ret = 0;
        if (self::PHONE_TYPE_CELEPHONE === $type) {
        } else if (self::PHONE_TYPE_TELEPHONE === $type){
        } else if (self::PHONE_TYPE_BOTH === $type){
            $ret = preg_match(self::PATTERN_CELEPHONE, $phone);
            $ret = 0<$ret ? $ret : preg_match(self::PATTERN_PHONE0, $phone);
            $ret = 0<$ret ? $ret : preg_match(self::PATTERN_PHONE1, $phone);
            $ret = 0<$ret ? $ret : preg_match(self::PATTERN_PHONE2, $phone);
        }
        if (0 < $ret) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief 
     *
     * @param $id
     *
     * @return 
     */
    public static function checkID($id) {
    }
}

/*
while(true) {
    $fp = fopen("php://stdin", "r");
    $phone = trim(fgets($fp, 128));
    if ($phone === 'exit') {
        exit;
    }
    $ret = Tieba_Param::checkPhone($phone);
    if (0 < $ret) {
        var_dump("is phone!");
    } else {
        var_dump("not!");
    }
}
 */

?>
