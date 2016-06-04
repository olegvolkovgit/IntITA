<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserStatusWidget
 *
 * @author alterego4
 */
class UserStatusWidget extends CWidget
{
    //RegisteredUser
    public $registeredUser;
    public $bigView;
    public function run() 
    {
        parent::run();
        $view = $this->bigView? 'UserStatus/index' : 'UserStatus/small';
        $this->render($view,array('post'=>$this->registeredUser));
    }
}
