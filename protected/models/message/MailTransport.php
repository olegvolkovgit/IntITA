<?php

class MailTransport implements IMailSender{

    public $viewPath = 'application.views.mail';
    private $template = '';

    public function send($mailto, $nameFrom, $subject, $text)
    {
        if(isset(Yii::app()->controller)) {
            if (!$nameFrom)
                $nameFrom = Config::getBaseUrlWithoutSchema();
            $headers = "From: " . Yii::app()->name . "@" . $nameFrom . "\n"
                . "MIME-Version: 1.0\n"
                . "Content-Type: text/html;charset=\"utf-8\"" . "\n";
            if ($this->template != '') {
                $text = $this->template;
            }
            $this->viewPath = ($dir = Yii::getPathOfAlias($this->viewPath)) ? $dir : Yii::app()->viewPath . DIRECTORY_SEPARATOR . 'mail';
            $message = Yii::app()->controller->renderFile($this->viewPath . DIRECTORY_SEPARATOR . 'mailLayout.php', array(
                'content' => $text,
                'userEmail' => $mailto
            ), true);

            $message = $message . "\n";

            return mail($mailto, $subject, $message, $headers);
        }
    }

    public function renderBodyTemplate($template, $params){
        if(isset(Yii::app()->controller)) {
            $this->viewPath = ($dir = Yii::getPathOfAlias($this->viewPath)) ? $dir : Yii::app()->viewPath . DIRECTORY_SEPARATOR . 'mail';
            $this->template = Yii::app()->controller->renderFile($this->viewPath . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.php', array(
                'params' => $params,
            ), true);
        }
    }

    public function template(){
        return $this->template;
    }
}