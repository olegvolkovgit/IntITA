<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 07.02.16
 * Time: 20:57
 */

namespace application\components\Exceptions;

class CourseNotFoundException extends IntItaException
{
    public function __construct()
    {
        parent::__construct(404, "Course not found");
    }
}