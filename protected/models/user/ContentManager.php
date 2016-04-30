<?php

class ContentManager extends Role
{
    private $errorMessage = "";
    private $dbModel;

    public function tableName(){
        return "user_content_manager";
    }

    /**
     * @return string sql for check role content manager.
     */
    public function checkRoleSql(){
        return 'select "content_manager" from user_content_manager ucm where ucm.id_user = :id and ucm.end_date IS NULL';
    }

    public function title(){
        return "Контент менеджер";
    }

    public function getErrorMessage(){
        return $this->errorMessage;
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
        $criteria->select = "id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id = s.id';
        $criteria->join .= ' LEFT JOIN user_content_manager u ON u.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and u.id_user IS NULL or u.end_date IS NOT NULL');
        $criteria->group = 's.id';
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