<?php

class MailTransport implements IMailSender{

    public function send($mailto, $nameFrom, $subject, $text){
        $mail = new Mail();

        $mail->headers = "Content-type: text/plain; charset=utf-8 \r\n" . "From: ".$nameFrom . Config::getBaseUrlWithoutSchema();

        if(mail($mailto, $subject, $text, $mail->headers))
            return true;
        else return false;
    }

}