<?php

class NotificationMessages implements IMessage
{
    //array of models for all receivers
    private $receivers;
    //UserMessages model
    private $message;

    //todo
    public function build(){

    }
    /**
     *
     */
    public function create(){
        //todo
    }

    /**
     * Send notifications(as user messages) for all receivers.
     * @param IMailSender $sender
     */
    public function send(IMailSender $sender){
        //todo
    }

    /**
     * Not supported.
     * @param StudentReg $receiver
     * @return bool
     */
    public function read(StudentReg $receiver){
        return false;
    }

    /**
     * Not supported.
     * @param StudentReg $receiver
     */
    public function deleteMessage(StudentReg $receiver){
        return false;
    }

    /**
     * Not supported.
     * @param StudentReg $receiver
     */
    public function reply(StudentReg $receiver){
        return null;
    }

    /**
     * Not supported.
     * @param StudentReg $receiver
     */
    public function forward(StudentReg $receiver){
        return null;
    }
}