<?php

class Tenant extends Role
{
    private $errorMessage = "";
    private $dbModel;

    public function tableName(){
        return "user_tenant";
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function title(){
        return "Tenant";
    }

    public function attributes(StudentReg $user){
        return array();
    }

    public function checkBeforeDeleteRole(StudentReg $user){
        return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value){
        return false;
    }

    public function addRoleFormList($query){
        $criteria = new CDbCriteria();
        $criteria->select = "u.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "u";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'right join chat_user as cu on u.id = cu.intita_user_id';
        $criteria->join .= ' right join user_tenant ut on ut.chat_user_id=cu.id';
        $criteria->addCondition('ut.chat_user_id IS NULL or ut.end_date IS NOT NULL');

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key=>$model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }
}