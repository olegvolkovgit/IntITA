<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 07.02.16
 * Time: 20:57
 */

namespace application\components\Exceptions;

class ModuleDelitingException extends IntItaException
{
    public function __construct()
    {
        parent::__construct(403, "Nothing to delete. No changes made.");
    }
}