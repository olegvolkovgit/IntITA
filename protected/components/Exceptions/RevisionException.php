<?php
use application\components\Exceptions\IntItaException;

class RevisionException extends IntItaException {

    protected $view = '/site/error';
    public $statusCode;

    public function __construct($status,$message=null,$code=0)
    {
        $this->statusCode=$status;

        parent::__construct($message,$status);
    }

}