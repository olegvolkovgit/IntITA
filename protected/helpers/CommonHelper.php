<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 28.09.2015
 * Time: 15:50
 */

class CommonHelper {

    public static function getDollarExchangeRate(){
        $header = array("Accept: application/json");
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        $jsondata = curl_exec($ch);
        if (curl_error($ch)) die("Connection Error: ".curl_errno($ch).' - '.curl_error($ch));
        curl_close($ch);
        $arr = json_decode($jsondata);

        if ($arr != null)
            return $arr[2]->buy;
        else return 22;
    }

    public static function translateLevelUa($level){
        switch ($level){
            case 'intern':
                $level = 'стажер';
                break;
            case 'junior':
                $level = 'початківець';
                break;
            case 'strong junior':
                $level = 'сильний початківець';
                break;
            case 'middle':
                $level = 'середній';
                break;
            case 'senior':
                $level = 'високий';
                break;
        }
        return $level;
    }

    public static function getYearsTermination ($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if($number > 10 and $number < 15)
        {
            $term = Yii::t('profile', '0097');
        }
        else
        {

            $number = substr($number, -1);

            if($number == 0) {$term = Yii::t('profile', '0097');}
            if($number == 1 ) {$term = Yii::t('profile', '0098');}
            if($number > 1 ) {$term = Yii::t('profile', '0099');}
            if($number > 4 ) {$term = Yii::t('profile', '0097');}
        }
        return  $term;
    }

    public static function getDaysTermination ($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание
        if($number > 10 and $number < 15)
        {
            $term = Yii::t('module', '0653');
        }
        else
        {

            $number = substr($number, -1);

            if($number == 0) {$term = Yii::t('module', '0653');}
            if($number == 1 ) {$term = Yii::t('module', '0654');}
            if($number > 1 ) {$term = Yii::t('module', '0655');}
            if($number > 4 ) {$term = Yii::t('module', '0653');}
        }
        return  $term;
    }
}