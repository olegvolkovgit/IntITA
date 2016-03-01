<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.11.2015
 * Time: 15:00
 */

class Mail {

    public $headers;

    public function __construct()
    {
        $this->headers = "Content-type: text/plain; charset=utf-8 \r\n" . "From: no-reply@" . Config::getBaseUrlWithoutSchema();
    }

    public static function getErrorText()
    {
       return '<br /><h4>Щось пішло не так</h4> Лист не був відправлений <strong>';
    }

    public static function strcode($str, $passw="")
    {
        $salt = "Dn8*#2n!9j";
        $len = strlen($str);
        $gamma = '';
        $n = $len>100 ? 8 : 2;
        while( strlen($gamma)<$len )
        {
            $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
        }
        return $str^$gamma;
    }
}