<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.10.2015
 * Time: 14:56
 */

class IntItaExeption extends Exception {

    public function __construct($value) {

        if($value == 5)
        {
            $this->message = 'Not found';
            $this->code = 300;
            throw new Exception('5',3);
        }

    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


    public function checkData()
    {
       throw new Exception($this->__toString(),300);
    }



}