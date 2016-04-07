<?php

interface IRequest
{
    public function approve(StudentReg $userApprove);
    public function setDeleted();
    public function isRequestOpen($module, $user);
}