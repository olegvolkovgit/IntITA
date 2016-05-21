<?php

interface IRequest
{
    public function approve(StudentReg $userApprove);
    public function setDeleted();
    public function isRequestOpen($params);
    public function isApproved();
    public function isDeleted();
    public function getMessageId();
    public function sender();
    public function title();
    public function module();
    public function type();
}