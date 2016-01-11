<?php

interface IMailSender {

    public function send($mailto, $nameFrom, $subject, $text);

}