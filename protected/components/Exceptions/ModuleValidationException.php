<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 07.02.16
 * Time: 20:57
 */

namespace application\components\Exceptions;

class ModuleValidationException extends IntItaException
{
    public function __construct($msg)
    {
        parent::__construct(400, "New module validation error. Details: $msg");
    }
}