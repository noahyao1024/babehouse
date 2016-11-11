<?php

class Http_Curl {
    public static function call($url, $ret_data_type = "json") {
        $curl_handler = curl_init();
        curl_setopt($curl_handler, CURLOPT_URL, $url);
        curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handler, CURLOPT_HEADER, 0);
        $res = curl_exec($curl_handler);

        //check status
        $http_code = curl_getinfo($curl_handler,CURLINFO_HTTP_CODE);
        if(200 === $http_code) {
        } else {
            return false;
        }

        $data = trim($res);
        if("json" === $ret_data_type) {
            $data = json_decode($data, true);
        }
        return $data;
    }
}
