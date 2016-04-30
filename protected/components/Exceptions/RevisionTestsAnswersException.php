<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 10.03.16
 * Time: 11:53
 */
class RevisionTestsAnswersException extends RevisionException {

    protected $view = '/site/error';
    public $statusCode;

    public function __construct($message=null, $status=500, $code=0)
    {
        $this->statusCode=$status;

        parent::__construct($message,$status);
    }

}