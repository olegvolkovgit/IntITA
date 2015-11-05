<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.11.2015
 * Time: 15:00
 */

class Mail {

    private $headers;

    public function __construct()
    {
        $this->headers = "Content-type: text/plain; charset=utf-8 \r\n" . "From: no-reply@" . Config::getBaseUrlWithoutSchema();
    }


    public static function sendRecoveryPassMail($model,$time)
    {
        $mail = new Mail();

        $subject = Yii::t('recovery', '0281');
        $text = Yii::t('recovery', '0239') .
            " " . Config::getBaseUrl() . "/index.php?r=site/vertoken/view&token=" . $model->token;
        $model->updateByPk($model->id, array('token' => $model->token, 'activkey_lifetime' => $time));

       if( mail($model->email, $subject, $text, $mail->headers))
        return true;

        else return false;
    }

    public static function sendResetMail($model,$modelReset, $time)
    {
        $mail = new Mail();

        $subject = Yii::t('recovery', '0282');
        $text = Yii::t('recovery', '0283') .
            " " . Config::getBaseUrl() . "/index.php?r=site/veremail/view&token=" . $model->token . "&email=" . $modelReset->email;
        $model->updateByPk($model->id, array('token' => $model->token, 'activkey_lifetime' => $time));

        if (mail($modelReset->email, $subject, $text, $mail->headers))
            return true;

        else return false;
    }

    public static function sendRapidReg($model)
    {
        $mail = new Mail();

        $lang = Mail::setLang();



        $subject = Yii::t('activeemail', '0298');
        $text = Yii::t('activeemail', '0299') .
            " " . Config::getBaseUrl() . "/index.php?r=site/AccActivation/view&token=" . $model->token . "&email=" . $model->email . "&lang=" . $lang;
        if( mail($model->email, $subject, $text, $mail->headers))
            return true;

        else return false;
    }

    public static function sendRegistrationMail($model)
    {
        $mail = new Mail();

        $lang = Mail::setLang();

        $subject = Yii::t('activeemail', '0298');
        $text = Yii::t('activeemail', '0299') .
            " " . Config::getBaseUrl() . "/index.php?r=site/AccActivation/view&token=" . $model->token . "&email=" . $model->email . "&lang=" . $lang;;
        if(mail($model->email, $subject, $text, $mail->headers))
            return true;

        else return false;

    }

    private static function setLang()
    {
        if (Yii::app()->session['lg']) $lang = Yii::app()->session['lg'];
        else $lang = 'ua';

        return $lang;
    }
}