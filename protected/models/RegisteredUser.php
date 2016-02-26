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
    //array UserRoles
    private $_roles;
    //Teacher model
    private $_teacher;
    private $_isTeacher = false;
    private $_roleAttributes = array();
    
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

    public function getRoles()
    {
        if ($this->_roles === null) {

                $this->_roles = $this->loadRoles();
        }
        return $this->_roles;
    }
    
    private function loadRoles(){
        $sql = '(select "admin",id_user from user_admin a where a.id_user = '.$this->id.' and end_date IS NULL)
                    union
                (select "accountant", id_user from user_accountant ac where ac.id_user = '.$this->id.' and end_date IS NULL)
                    union
                (select "student", id_user from user_student st where st.id_user = '.$this->id.' and end_date IS NULL)
                     union
                (select "trainer", id_user from user_trainer at where at.id_user = '.$this->id.' and end_date IS NULL)
                     union
                (select "consultant", id_user from user_consultant acs where acs.id_user = '.$this->id.' and end_date IS NULL)';
        $rolesArray = Yii::app()->db->createCommand($sql)->queryAll();

        $result = array_map(function($row){return new UserRoles($row["admin"]);}, $rolesArray);

        return $result;
    }

    public function isTeacher()
    {
        if ($this->getTeacher() === null) {
            return false;
        } else {
            return true;
        }
    }

    public function getTeacher()
    {
        if ($this->_teacher === null) {

            $this->_teacher = $this->loadTeacherModel();
        }
        return $this->_teacher;
    }

    private function loadTeacherModel()
    {
        return Teacher::model()->findByAttributes(array('user_id' => $this->registrationData->id));
    }

    public function getRolesAttributes(UserRoles $role)
    {
        if (in_array($role, $this->getRoles())) {
           return $this->loadRoleAttributes();
        }
        return array();
    }

    private function loadRoleAttributes()
    {
        return array_map(
            function (UserRoles $role)
            {
                $class = new $role($this);
                return $class;
            }
            , $this->_roles);

    }



    public function isAdmin()
    {
        return in_array(new UserRoles('admin'), $this->getRoles());
    }

    public function isAccountant()
    {
        return in_array(new UserRoles('accountant'), $this->getRoles());
    }

    public function isTrainer()
    {
        return in_array(new UserRoles('trainer'), $this->getRoles());
    }

    public function isConsultant()
    {
        return in_array(new UserRoles('consultant'), $this->getRoles());
    }
}
