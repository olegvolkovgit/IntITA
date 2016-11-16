<?php

class Consultant extends Role
{
    private $dbModel;
    private $errorMessage = "";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_consultant';
    }

    /**
     * @return string sql for check role consultant.
     */
    public function checkRoleSql(){
        return 'select "consultant" from user_consultant acs where acs.id_user = :id and end_date IS NULL';
    }

    /**
     * @return string the role title (ua)
     */
    public function title()
    {
        return 'Консультант';
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function attributes(StudentReg $user)
    {
        $list = Yii::app()->db->createCommand()
            ->select('module id, language lang, m.title_ua title, cm.start_time start_date, cm.end_time end_date, m.cancelled')
            ->from('consultant_modules cm')
            ->join('module m', 'm.module_ID=cm.module')
            ->where('consultant=:id AND cm.end_time IS NULL', array(':id' => $user->id))
            ->queryAll();

        $attribute = array(
            array(
                'key' => 'module',
                'title' => 'Модулі',
                'type' => 'module-list',
                'value' => $list
            )
        );
        
        return $attribute;
    }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkBeforeSetAttribute($user)){
                    if($this->checkModule($user->id, $value)) {
                        if(Yii::app()->db->createCommand()->
                        insert('consultant_modules', array(
                            'consultant' => $user->id,
                            'module' => $value
                        ))){
                            $user->notify('consultant'. DIRECTORY_SEPARATOR . '_addConsultantModule', array(Module::model()->findByPk($value)),
                                'Надано права консультанта');
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }else{
                    return false;
                }
            default:
                return false;
        }
    }

    public function checkBeforeSetAttribute(StudentReg $user){
        $user = RegisteredUser::userById($user->id);
        if($user->isConsultant())
            return true;
        else {
            $this->errorMessage="Призначити модуль не вдалося. Користувачу не призначена роль консультанта";
            return false;
        }
    }
    
    public function checkModule($teacher, $module){
        if(Yii::app()->db->createCommand('select consultant from consultant_modules where module='.$module.
            ' and consultant='.$teacher.' and end_time IS NULL')->queryScalar()) {
            $this->errorMessage = "Даний користувач вже має права консультанта для обраного модуля.";
            return false;
        }
        else return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if (Yii::app()->db->createCommand()->
                update('consultant_modules', array(
                    'end_time' => date("Y-m-d H:i:s"),
                ), 'consultant=:user and module=:module and end_time IS NULL', array(':user' => $user->id, 'module' => $value))){
                    $user->notify('consultant'. DIRECTORY_SEPARATOR . '_cancelConsultantModule', array(Module::model()->findByPk($value)),
                        'Скасовано права консультанта');
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                return false;
        }
    }

    public static function consultantsByQuery($query){

        $criteria = new CDbCriteria();
        //$criteria->select = "idUser.id, idUser.secondName, idUser.firstName, idUser.middleName, idUser.email, idUser.avatar";
        $criteria->addSearchCondition('idUser.firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('idUser.secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('idUser.middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('idUser.email', $query, true, "OR", "LIKE");
        $criteria->addCondition('end_date IS NULL');
        $data = UserConsultant::model()->with('idUser')->findAll($criteria);

        $result = [];
        foreach ($data as $key=>$model) {
            $result["results"][$key]["id"] = $model->id_user;
            $result["results"][$key]["name"] = $model->idUser->secondName . " " . $model->idUser->firstName . " " . $model->idUser->middleName;
            $result["results"][$key]["email"] = $model->idUser->email;
            $result["results"][$key]["url"] = $model->idUser->avatarPath();
        }
        return json_encode($result);
    }

    public static function addConsultantsByQuery($query){
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_consultant uc ON uc.id_user = s.id';
        $criteria->addCondition('uc.id_user IS NOT NULL and uc.end_date IS NULL');
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

    public function checkBeforeDeleteRole(StudentReg $teacher){
       // return !$this->existOpenTaskAnswers($teacher);
        return true;
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
        $criteria->join .= ' LEFT JOIN user_consultant uc ON uc.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and uc.id_user IS NULL or uc.end_date IS NOT NULL');
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

    public function activeModules(StudentReg $teacher)
    {
        $records = Yii::app()->db->createCommand()
            ->select('module id, language lang, m.title_ua title, cm.start_time')
            ->from('consultant_modules cm')
            ->join('module m', 'm.module_ID=cm.module')
            ->where('consultant=:id and cm.end_time IS NULL and m.cancelled=:isCancel', array(
                ':id' => $teacher->id,
                ':isCancel' => Module::ACTIVE
            ))
            ->group('m.module_ID')
            ->queryAll();

        return $records;
    }


    function getMembers($criteria = null)
    {
        return UserConsultant::model()->findAll($criteria);

    }

    public function cancelRole(StudentReg $user)
    {
        if(!$this->checkBeforeDeleteRole($user)){
            return false;
        }

        if(Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            'end_date'=>date("Y-m-d H:i:s"),
            'cancelled_by'=>Yii::app()->user->getId(),
        ), 'id_user=:id and end_date IS NULL', array(':id'=>$user->id))){
            $this->cancelModulesRights($user);
            $this->notifyCancelRole($user);
            return true;
        }
        return false;
    }

    //cancel rules for all consultant's modules
    public function cancelModulesRights(StudentReg $user)
    {
        if(Yii::app()->db->createCommand()->
        update('consultant_modules', array(
            'end_time'=>date("Y-m-d H:i:s"),
        ), 'consultant=:id and end_time IS NULL', array(':id'=>$user->id))){
            return true;
        }
        return false;
    }
}
