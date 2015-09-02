<?php

class Utils {

    public static function getIP() {
        static $realip;
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
    
    public static function ipDes($ip){
        $ipArr = explode('.', $ip);
        $ipArr[2] = 1;
        $ipArr[3] = 1;
        $ip = implode('.', $ipArr);
        return $ip;
    }
    
    public static function corrdDes($corrd){
        $corrdArr = explode(',', $corrd);
        $corrdArr[0] = number_format($corrdArr[0], 2);
        $corrdArr[1] = number_format($corrdArr[1], 2);
        return implode(',', $corrdArr);
    }
    
    public static function _postDataCurl($url, $data = array(), $timeout = 10) {
        header("Content-type: text/html; charset=utf-8");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); //服务地址URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //发送的数据
        $rtn = curl_exec($ch); //获得返回值
        curl_close($ch);
        return $rtn;
    }

}
