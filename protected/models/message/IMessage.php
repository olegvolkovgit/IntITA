<?php

interface IMessage {

    public function create();
    public function send(IMailSender $sender);
    public function read(StudentReg $receiver);
    public function deleteMessage(StudentReg $receiver);
    public function reply(StudentReg $receiver);
    public function forward(StudentReg $receiver);
}