<?php
namespace application\components\Exceptions;
use UAParser\Exception\FileNotFoundException;

/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.10.2015
 * Time: 14:56
 */

class IntItaException extends \CException {

    /**
     * @var integer HTTP status code, such as 403, 404, 500, etc.
     */
    public $statusCode;

    /**
     * Constructor.
     * @param integer $status HTTP status code, such as 404, 500, etc.
     * @param string $message error message
     * @param integer $code error code
     */
    public function __construct($status,$message=null,$code=0)
    {
        $this->statusCode=$status;
        parent::__construct($message,$status);
    }



}