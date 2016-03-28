<?php


abstract class Role
{

    abstract function tableName();

    abstract function title();

    abstract function attributes(StudentReg $user);

    abstract function checkBeforeDeleteRole(StudentReg $user);

    abstract function cancelAttribute(StudentReg $user, $attribute, $value);

    public static function getInstance($role){
        switch($role){
            case "admin":
                $model = new Admin();
                break;
            case "accountant":
                $model = new Accountant();
                break;
            case "trainer":
                $model = new Trainer();
                break;
            case "student":
                $model = new Student();
                break;
            case "consultant":
                $model = new Consultant();
                break;
            case "author":
                $model = new Author();
                break;
            default :
                $model = null;
        }
        return $model;
    }

    public function setRole(StudentReg $user)
    {
        return Yii::app()->db->createCommand()->
        insert($this->tableName(), array(
            'id_user' => $user->id
        ));
    }

    public function cancelRole(StudentReg $user)
    {
        if(!$this->checkBeforeDeleteRole($user)){
            return false;
        }
        return Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            'end_date'=>date("Y-m-d H:i:s"),
        ), 'id_user=:id', array(':id'=>$user->id));
    }

    public function setAttribute(StudentReg $user, $attribute, $value){
        return Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            $attribute=>$value,
        ), 'id_user=:id', array(':id'=>$user->id));
    }
}