<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 03.11.2015
 * Time: 17:15
 */

namespace application\components\Exceptions;


class ForumException  extends \Exception{

    protected $view = '/site/error';
    protected $message;
    protected $code;

}