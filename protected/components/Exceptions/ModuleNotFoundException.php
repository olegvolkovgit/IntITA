<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 07.02.16
 * Time: 20:57
 */

namespace application\components\Exceptions;

class ModuleNotFoundException extends IntItaException
{
    public function __construct()
    {
        parent::__construct(404, "Module not found");
    }
}