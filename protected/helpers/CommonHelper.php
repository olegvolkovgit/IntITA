<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 28.09.2015
 * Time: 15:50
 */

class CommonHelper {

    public static function getDollarExchangeRate(){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $jsondata = curl_exec($ch);
        if (curl_error($ch)) die("Connection Error: ".curl_errno($ch).' - '.curl_error($ch));
        curl_close($ch);
        $arr = json_decode($jsondata);

        var_dump($arr);//die();
        return 22;//$arr[2]->buy;
    }
}