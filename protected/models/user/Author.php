<?php

class Author extends Role
{
    private $dbModel;
    private $modules;
    private $errorMessage = "";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return "user_author";
    }

    /**
     * @param $organization Organization
     * @return string sql for check role author.
     */
    public function checkRoleSql($organization=null){
        $condition=$organization?' and ua.id_organization='.$organization:'';
        return 'select "author" from user_author ua where ua.id_user = :id and ua.end_date IS NULL'.$condition;
    }

    /**
     * @return string the role title (ua)
     */
    public function title(){
        return Yii::t('profile', '0967');
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function attributes(StudentReg $user, $organization=null)
    {
        $organization=$organization?$organization:Yii::app()->user->model->getCurrentOrganizationId();
        $records = Yii::app()->db->createCommand()
            ->select('idModule, language, m.title_ua, tm.start_time, tm.end_time, m.cancelled')
            ->from('teacher_module tm')
            ->leftJoin('module m', 'm.module_ID=tm.idModule')
            ->leftJoin('user_author ua', 'ua.id_user=tm.idTeacher')
            ->where('idTeacher=:id AND tm.end_time IS NULL and ua.end_date IS NULL and ua.id_organization=:id_org 
            and m.id_organization=:id_org', array(':id' => $user->id, ':id_org'=>$organization),'')
            ->queryAll();

        $list = [];
        foreach ($records as $record) {
            $row["id"] = $record['idModule'];
            $row["title"] = $record['title_ua'];
            $row["start_date"] = $record['start_time'];
            $row["end_date"] = $record['end_time'];
            $row["lang"] = $record['language'];
            $row["cancelled"] = $record['cancelled'];
            array_push($list, $row);
        }

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
                        if (Yii::app()->db->createCommand()->
                        insert('teacher_module', array(
                            'idTeacher' => $user->id,
                            'idModule' => $value,
                            'assigned_by'=>Yii::app()->user->getId()
                        ))){
                            $revisionRequest=MessagesAuthorRequest::model()->findByAttributes(array('id_module'=>$value,'id_teacher'=>$user->id,'cancelled'=>0));
                            if($revisionRequest){
                                $revisionRequest->setApproved();
                            }
                            $user->notify('author' .DIRECTORY_SEPARATOR . '_assignNewModule',
                                array(Module::model()->findByPk($value)),
                                'Призначено модуль для редагування', Yii::app()->user->getId());
                            return true;
                        }else{
                            $this->errorMessage="Призначити модуль не вдалося";
                            return false;   
                        }
                    } else {
                        return false;
                    }
                }else{
                    return false;
                }
                break;
            default:
                $this->errorMessage="Виконати операцію не вдалося";
                return false;
        }
    }

    public function checkBeforeSetAttribute(StudentReg $user){
        $user = RegisteredUser::userById($user->id);
        if($user->isAuthor())
            return true;
        else {
            $this->errorMessage="Призначити авторство модулю не вдалося. Користувачу не призначена роль автора";
            return false;
        }
    }

    public function checkBeforeUnsetAttribute($userId, $module){
        $user = RegisteredUser::userById($userId);
        $model=Module::model()->findByPk($module);

        if(!$user->isAuthor() || $model->id_organization!=Yii::app()->user->model->getCurrentOrganization()->id) {
            $this->errorMessage="Ти не можеш скасувати модуль автору контента в межах даної організації";
            return false;
        }
        return true;
    }

    public function checkModule($teacher, $module){
        $model=Module::model()->findByPk($module);
        if(Yii::app()->db->createCommand('select idTeacher from teacher_module where idModule='.$module.
            ' and idTeacher='.$teacher.' and end_time IS NULL')->queryScalar()) {
            $this->errorMessage = "Обраний модуль вже присутній у списку модулів даного автора";
            return false;
        }
        if($model->id_organization!=Yii::app()->user->model->getCurrentOrganizationId()) {
            $this->errorMessage="Автору не можна призначити модуль, який не належить його організації";
            return false;
        }
        return true;
    }

    public static function isTeacherAuthorModule($teacher, $module){
        if(Yii::app()->db->createCommand('select idTeacher from teacher_module where idModule='.$module.
            ' and idTeacher='.$teacher.' and end_time IS NULL')->queryScalar())
            return true;
        else return false;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkBeforeUnsetAttribute($user->id, $value)){
                    if (Yii::app()->db->createCommand()->
                    update('teacher_module', array(
                        'end_time' => date("Y-m-d H:i:s"),
                        'cancelled_by'=>Yii::app()->user->getId(),
                    ), 'idTeacher=:user and idModule=:module and end_time IS NULL', array(':user' => $user->id, 'module' => $value))){
                        $user->notify('author' .DIRECTORY_SEPARATOR . '_cancelModule',
                            array(Module::model()->findByPk($value)),
                            'Скасовано модуль для редагування', Yii::app()->user->getId());
                        return true;
                    }else{
                        $this->errorMessage="Скасувати модуль не вдалося";
                        return false;
                    }
                }else{
                    return false;
                }
                break;
                default:
                    $this->errorMessage="Виконати операцію не вдалося";
                    return false;
        }
    }

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null){
        return true;
    }

    public function checkBeforeSetRole(StudentReg $user, $organization=null){
        return true;
    }

    /**
     * @param $query string - query from typeahead
     * @param $organization - query from typeahead
     * @return string - json for typeahead field in user manage page (cabinet, add)
     */
    public function addRoleFormList($query, $organization)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id=s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_author ua ON ua.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (ua.id_user IS NULL or ua.end_date IS NOT NULL or (ua.end_date IS NULL and ua.id_organization!='.$organization.'))');
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
            ->select('tm.idModule id, language lang, m.title_ua title, tm.start_time')
            ->from('teacher_module tm')
            ->leftJoin('module m', 'm.module_ID=tm.idModule')
            ->where('idTeacher=:id and tm.end_time IS NULL and m.cancelled=:isCancel 
            and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id, array(
                ':id' => $teacher->id,
                ':isCancel' => Module::ACTIVE
            ))
            ->group('tm.idModule')
            ->queryAll();

        return $records;
    }

    //cancel author role
    public function cancelRole(StudentReg $user, $organization)
    {
        if(!$this->checkBeforeDeleteRole($user)){
            return false;
        }

        if(Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            'end_date'=>date("Y-m-d H:i:s"),
            'cancelled_by'=>Yii::app()->user->getId(),
        ), 'id_user=:id and end_date IS NULL', array(':id'=>$user->id))){
            $this->cancelModulesAuthorship($user);
            $this->notifyCancelRole($user, $organization);
            $this->updateRolesRoom();
            return true;
        }
        return false;
    }

    //cancel authorship for all modules
    public function cancelModulesAuthorship(StudentReg $user)
    {
        if(Yii::app()->db->createCommand()->
        update('teacher_module', array(
            'end_time'=>date("Y-m-d H:i:s"),
            'cancelled_by'=>Yii::app()->user->getId(),
        ), 'idTeacher=:id and end_time IS NULL', array(':id'=>$user->id))){
            return true;
        }
        return false;
    }

    function getMembers($criteria = null)
    {
        return UserAuthor::model()->findAll($criteria);
    }
}