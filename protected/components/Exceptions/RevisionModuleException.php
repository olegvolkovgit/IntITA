<?php
class RevisionModuleException extends RevisionException {

    protected $view = '/site/error';
    public $statusCode;

    public function __construct($status=500,$message=null,$code=0)
    {
        $this->statusCode=$status;

        parent::__construct($message,$status);
    }

}