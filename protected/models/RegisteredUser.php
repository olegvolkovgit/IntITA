<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegisteredUser
 *
 * @author alterego4
 */
class RegisteredUser 
{
    //put your code here
    //StudentReg variable
    public $registrationData;
    
    public function __construct(StudentReg $registrationData) 
    {
        $this->registrationData = $registrationData;
    }
    
    public static function userById($id = null)
    {
        if (($id !== null) && (($registrationData = StudentReg::model()->findByPk($id)) !== null))
        {
            return new RegisteredUser($registrationData);
        }
        //TODO:
        throw new CDbException('500', "No such user");
    }
      
    
    //Model Methods
    public function __call($name, $arguments) 
    {
        return call_user_func_array(array($this->registrationData,$name), $arguments);
    }
    
    public function __get($name) 
    {
        return $this->registrationData->$name;
    }
}
