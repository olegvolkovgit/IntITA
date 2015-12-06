<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.12.2015
 * Time: 15:15
 */

interface IMessage {

    public function create();
    public function send(IMailSender $sender);
    public function read(StudentReg $receiver);
    public function deleteMessage(StudentReg $receiver);
    public function reply(StudentReg $receiver);
    public function sendOn(StudentReg $receiver);

}