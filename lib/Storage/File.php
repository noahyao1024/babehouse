<?php
/***************************************************************************
 * 
 * Copyright (c) 2016 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/


/**
 * @file File.php
 * @author yaokun(com@baidu.com)
 * @date 2016/03/08 10:37:51
 * @brief 
 *  
 **/

class Storage_File {
    const TYPE_READ = 0;
    const TYPE_WRITE_APPEND = 1;
    const TYPE_WRITE_OVERWRITE = 2;

    private static $_handler   = array();

    private static function _init($filename, $type = self::TYPE_READ) {
        if (self::TYPE_READ === $type) {
            if(!file_exists($filename)) {
                throw new Exception(sprintf("fail to find file[%s]", $filename));
            }
            self::$_handler[$filename] = fopen($filename, 'r');
        } else if(self::TYPE_WRITE_APPEND === $type) {
            self::$_handler[$filename] = fopen($filename, "a+");
        }
        if(is_null(self::$_handler[$filename])) {
            throw new Exception(sprintf("fail to load file[%s]", $filename));
        }
    }

    /**
     * @brief 
     *
     * @param $arrData
     *
     * @return 
     */
    public static function read2array($filename, &$arrData) {
        if(!isset(self::$_handler[$filename])) {
            self::_init($filename);
        }
        while(!self::isEnd(self::$_handler[$filename])) {
            $data = self::read(self::$_handler[$filename]);
            if (0 >= strlen($data)) {

            } else {
                $arrData [] = $data;
            }
        }
    }

    public static function close($filename) {
        if(isset(self::$_handler[$filename])) {
            fclose(self::$_handler[$filename]);
            unset(self::$_handler[$filename]);
        }
    }

    /**
     * @brief 
     *
     * @return 
     */
    public static function getLineCount() {
        $output = array();
        exec("cat {self::$_filename} | wc -l", $output);
        $line_count = (int)trim($output[0]);
        return $line_count;
    }

    /**
     * @brief 
     *
     * @param $content
     *
     * @return 
     */
    public static function write($filename, $content, $type = self::TYPE_WRITE_APPEND) {
        if(!isset(self::$_handler[$filename])) {
            self::_init($filename, $type);
        }
        fputs(self::$_handler[$filename], $content."\n");
        return true;
    }

    /**
     * @brief 
     *
     * @return 
     */
    public static function read($handler) {
        return trim(fgets($handler));
    }

    /**
     * @brief 
     *
     * @return 
     */
    public static function isEnd($handler) {
        return feof($handler);
    }

}
