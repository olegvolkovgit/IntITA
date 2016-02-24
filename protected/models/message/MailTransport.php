<?php

class MailTransport implements IMailSender{

    public $layoutPath = 'application.views.layouts';
    public $templatePath = 'application.views.mail';
    private $template = '';

    public function send($mailto, $nameFrom, $subject, $text)
    {
        if(!$nameFrom)
            $nameFrom = Config::getBaseUrlWithoutSchema();
        $headers = "From: no-reply@" . $nameFrom . "\n"
            . "MIME-Version: 1.0\n"
            . "Content-Type: text/html;charset=\"utf-8\"" . "\n";
        if($this->template != ''){
            $text = $this->template;
        }

        $message = Yii::app()->controller->renderFile($this->layoutPath . DIRECTORY_SEPARATOR . 'mailLayout.php', array(
            'content' => $text,
            'userEmail' => $mailto
        ), true);

        $message = $message . "\n";

        return mail($mailto, $subject, $message, $headers);
    }

    public function renderBodyTemplate($template, $params){
        $this->viewPath = ($dir = Yii::getPathOfAlias($this->templatePath)) ? $dir : Yii::app()->viewPath;
        $this->template = Yii::app()->controller->renderFile($this->templatePath. DIRECTORY_SEPARATOR . 'templates'. DIRECTORY_SEPARATOR .$template.'.php', array(
            'params' => $params,
        ), true);
    }
}