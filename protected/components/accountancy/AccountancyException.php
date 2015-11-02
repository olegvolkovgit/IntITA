<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.10.2015
 * Time: 14:57
 */

use Symfony\Component\Config\Definition\Exception\Exception;
class AccountancyException extends Exception{

    public function __construct($value) {

        if($value == 5)
        {
            $this->checkData();
        }

        }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


    public function checkData()
    {
              throw new AccountancyException('Data not found',300);

    }

}