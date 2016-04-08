<?php

interface IRequest
{
    public function approve(StudentReg $userApprove);
    public function setDeleted();
    public function isRequestOpen($module, $user);
    public function getMessageId();
    public function sender();
    public function title();
    public function module();
    public function type();
}