<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.11.2015
 * Time: 15:39
 */

namespace application\components\Exceptions;


class MailException extends \Exception {

    protected $view = '/site/error';
    protected $message;
    protected $code;

}