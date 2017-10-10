<?php

class ContentManager extends Role
{
    private $errorMessage = "";
    private $dbModel;

    public function tableName(){
        return "user_content_manager";
    }

    /**
     * @param $organization Organization
     * @return string sql for check role content manager.
     */
    public function checkRoleSql($organization=null){
        $condition=$organization?' and ucm.id_organization='.$organization:'';
        return 'select "content_manager" from user_content_manager ucm where ucm.id_user = :id and ucm.end_date IS NULL'.$condition;
    }

    public function title(){
        return Yii::t('profile','0970');
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function attributes(StudentReg $user, $organization=null){
        return array();
    }

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null){
        return true;
    }

    public function checkBeforeSetRole(StudentReg $user, $organization=null){
        return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value){
        return false;
    }

    public function addRoleFormList($query, $organization){
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id = s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_content_manager u ON u.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (u.id_user IS NULL or u.end_date IS NOT NULL or (u.end_date IS NULL and u.id_organization!='.$organization.'))');
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

    function getMembers($criteria = null)
    {
        return UserContentManager::model()->findAll($criteria);
    }
}