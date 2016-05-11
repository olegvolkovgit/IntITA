<?php
use application\components\Exceptions\IntItaException;

class RevisionException extends IntItaException {

    protected $view = '/site/error';
    public $statusCode;

    public function __construct($message, $status=500,$code=0)
    {
        $this->statusCode=$status;

        parent::__construct($status, $message);
    }

}