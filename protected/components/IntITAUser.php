<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IntITAUser
 *
 * @author alterego4
 */
class IntITAUser extends CWebUser {
    // Store model to not repeat query.
    private $_model;
    
    
    
    // Load user model.
    protected function loadUser($id=null) {
        if($this->_model===null)
        {
            if($id!==null)
            $this->_model=StudentReg::model()->findByPk($id);
        }
        return $this->_model;
    }
    
    function getModel()
    {
        return $this->loadUser($this->id);
    }
    

}