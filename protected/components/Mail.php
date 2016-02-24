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
        //XOR email hash
        $key='ababagalamaga';
        $mailHash = base64_encode(Mail::strcode($modelReset->email, $key));

        $subject = Yii::t('recovery', '0282');
        $text = Yii::t('recovery', '0283') .
            " " . Config::getBaseUrl() . "/index.php?r=site/veremail/view&token=" . $model->token . "&email=" . urlencode($mailHash);
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

    public static function sendAssignedConsultantLetter($consult,$idPlainTaskAnswer)
    {
        $consultant = Teacher::model()->findByPk($consult);
        $plainTaskAnswer = PlainTaskAnswer::model()->findByPk($idPlainTaskAnswer);
        $model = new Letters();

        $model->addressee_id = $consultant->teacher_id;
        $model->sender_id = Yii::app()->user->id;
        $model->text_letter = "Вітаємо!"."<br>".
            "У Вас з'явилася нова задача для перевірки : " . $plainTaskAnswer->answer.".".
            "Щоб продивитися нову задачу, перейди за посиланням:
            <a href =".Config::getBaseUrl().'_teacher/teacher/checkPlainTaskAnswer'.$plainTaskAnswer->id.">"
            .'Задача до перевірки'." </a>
            ​З повагою, INTITA​";
        $model->date = date("Y-m-d H:i:s");
        $model->theme = "Нова задача";
        if($model->validate()) {
            $model->save();

        }
    }

    public static function sendVerificationEmailMail($model)
    {
        $mail = new Mail();
        $lang = Mail::setLang();
        $subject = Yii::t('activeemail', '0298');
        $text = Yii::t('activeemail', '0299') .
            " " . Config::getBaseUrl() . "/index.php?r=site/successVerification/view&token=" . $model->token . "&email=" . $model->email . "&lang=" . $lang;
        if( mail($model->email, $subject, $text, $mail->headers))
            return true;

        else return false;
    }
    public static function sendLinkingEmailMail($model)
    {
        $mail = new Mail();
        //hash email
        $key='codename41';
        $mailHash = base64_encode(Mail::strcode($model->email, $key));

        $lang = Mail::setLang();
        $subject = 'Приєднання соціальної мережі до електронної адреси';
        $text = 'Щоб приєднати дану електрону адресу до соціальної мережі ('.$model->identity.'), будь ласка перейди за посиланням: ' .
            " " . Config::getBaseUrl() . "/index.php?r=site/linkingEmailToNetwork/view&network=".$model->identity."&token=" . $model->token . "&email=" . urlencode($mailHash) . "&lang=" . $lang;
        if( mail($model->email, $subject, $text, $mail->headers))
            return true;

        else return false;
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