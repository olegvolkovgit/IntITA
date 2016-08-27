<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 28.09.2015
 * Time: 15:50
 */
class CommonHelper
{
    public static function getDollarExchangeRate()
    {
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
        if (curl_error($ch)) die("Connection Error: " . curl_errno($ch) . ' - ' . curl_error($ch));
        curl_close($ch);
        $arr = json_decode($jsondata);

        if ($arr != null)
            return $arr[2]->buy;
        else return 22;
    }

    public static function getYearsTermination($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if ($number > 10 and $number < 15) {
            $term = Yii::t('profile', '0097');
        } else {

            $number = substr($number, -1);

            if ($number == 0) {
                $term = Yii::t('profile', '0097');
            }
            if ($number == 1) {
                $term = Yii::t('profile', '0098');
            }
            if ($number > 1) {
                $term = Yii::t('profile', '0099');
            }
            if ($number > 4) {
                $term = Yii::t('profile', '0097');
            }
        }
        return $term;
    }

    static function detectBrowser($userAgent = null)
    {
        is_null($userAgent) && ($userAgent = $_SERVER['HTTP_USER_AGENT']);
        $name = null;
        $version = array(null, null, null, null);

        if (false !== strpos($userAgent, 'MSIE ')) {
            //http://www.useragentstring.com/pages/Internet%20Explorer/
            $name = 'Internet Explorer';
            preg_match('#MSIE (\d{1,2})\.(\d{1,2})#i', $userAgent, $versionMatch);
            isset($versionMatch[1]) && $version[0] = (int)$versionMatch[1];
            isset($versionMatch[2]) && $version[1] = (int)$versionMatch[2];
        }

        return array('name' => $name, 'version' => $version);
    }

    static public function checkForBrowserVersion(array $browser, array $conditions)
    {
        if (!isset($browser['name']) || !isset($conditions[$browser['name']])
            || !isset($browser['version']) || count($browser['version']) < 1
        ) {
            return null;
        }

        $cnd = $conditions[$browser['name']]; // 0=>, 1=>, 2=>
        if (!is_array($cnd)) {
            return null;
        }

        for ($i = 0; $i < count($cnd); $i++) {
            if ($browser['version'][$i] < $cnd[$i]) {
                return -1;
            } else if ($browser['version'][$i] > $cnd[$i]) {
                return 1;
            }
        }

        return 0;
    }

    public static function startsWith($haystack, $needle)
    {
        return substr($haystack, 0, strlen($needle)) === $needle;
    }

    public static function getLanguage()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        return $lang;
    }

    public static function getPriceUah($summa)
    {
        return round($summa * Config::getDollarRate());
    }

    public static function getRating($rat)
    {
        $rating = '';
        for ($i = 0; $i < floor($rat / 2); $i++) {
            $rating = $rating . "<img src=" . StaticFilesHelper::createPath('image', 'common', 'starFull.png') . ">";
        }
        if ($rat / 2 - floor($rat / 2) == 0.5) {
            $rating = $rating . "<img src=" . StaticFilesHelper::createPath('image', 'common', 'star-half.png') . ">";
        }
        for ($i = ceil($rat / 2); $i < 5; $i++) {
            $rating = $rating . "<img src=" . StaticFilesHelper::createPath('image', 'common', 'starEmpty.png') . ">";
        }
        return $rating;
    }

    public static function getHideIp($ip)
    {
        $pos = strripos($ip, '.');
        $arr = str_split($ip);
        for ($i = 0; $i < $pos; $i++) {
            if ($arr[$i] !== '.') $arr[$i] = '*';
        }
        return implode("", $arr);
    }

    public static function formatMessageDate($date)
    {
        $datetime1 = new DateTime("now");
        $datetime2 = new DateTime($date);
        if ($datetime1->format('y') == $datetime2->format('y')) {
            return CLocale::getInstance('uk')->dateFormatter->formatDateTime($date,'medium','medium');
        } else {
            return date("d.m.Y", strtotime($date));
        }
    }
}