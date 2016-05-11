<?php

class NotificationMessages implements IMessage
{
    const TYPE = MessagesType::NOTIFICATION;
    //UserMessages model
    private $message;

    public function build($subject, $text, $receivers, StudentReg $sender, $chained = null, $original = null){
        $this->message = new UserMessages();
        $this->message->setMailHeader($subject);
        $this->message->build($subject, $text, $receivers, $sender, $chained, $original);

        return $this;
    }

    /**
     * Create a user message model.
     */
    public function create(){
        $this->message->create();
    }

    /**
     * Send notifications(as user messages) for all receivers.
     * @param IMailSender $sender
     */
    public function send(IMailSender $sender){
        $this->message->send($sender);
    }

    /**
     * @param StudentReg $receiver
     * @return bool
     */
    public function read(StudentReg $receiver){
        return $this->message->read($receiver);
    }

    /**
     * @param StudentReg $receiver
     */
    public function deleteMessage(StudentReg $receiver){
        return $this->message->delete($receiver);
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

    /**
     * @return int MessagesType constant code.
     */
    public function type(){
        return self::TYPE;
    }
}