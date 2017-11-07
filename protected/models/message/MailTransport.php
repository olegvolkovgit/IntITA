<?php

class MailTransport implements IMailSender{

    public $viewPath = 'application.views.mail';
    private $template = '';

    public function send($mailto, $nameFrom, $subject, $text)
    {
        $mailPath = Config::getNotifyEmail();
        $headers = "From: IntITA <{$mailPath}>". "\r\n"
            . "MIME-Version: 1.0". "\r\n"
            . "Reply-To: {$mailPath}" . "\r\n"
            . "Return-Path: {$mailPath}". "\r\n"
            . "Content-type: text/html;charset=utf-8" . "\r\n";

        $message = Yii::app()->controller->renderFile($this->viewPath . DIRECTORY_SEPARATOR . 'mailLayout.php', array(
            'content' => $text,
            'userEmail' => $mailto
        ), true);
        $message = $message . "\n";

        return mail($mailto, mb_encode_mimeheader($subject,"UTF-8"), $message, $headers, "-f {$mailPath}");
    }

    public function renderBodyTemplate($template, $params){
        $this->viewPath = ($dir = Yii::getPathOfAlias($this->viewPath)) ? $dir : Yii::app()->viewPath . DIRECTORY_SEPARATOR . 'mail';
        $this->template = Yii::app()->controller->renderFile($this->viewPath . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.php', array(
            'params' => $params,
        ), true);
    }

    public function template(){
        return $this->template;
    }
}