<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 04.11.2015
 * Time: 15:39
 */

namespace application\components\Exceptions;


class KeyValidationException extends IntItaException {

    public function __construct($code = 400) {
        parent::__construct($code, 'Invalid secure key');
    }
}