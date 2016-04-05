<?php

class TeacherConsultant extends Role
{
    private $errorMessage = "";
    private $dbModel;
    private $modules;
    private $user;

    public function tableName(){
        return "user_teacher_consultant";
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function title(){
        return "Викладач";
    }

    public function attributes(StudentReg $user){
        if($this->user == null)
            $this->user = $user;

        $attribute = array(
            'key' => 'module',
            'title' => 'Модулі',
            'type' => 'module-list',
            'value' => $this->getModules()
        );
        $result = [];
        array_push($result, $attribute);

        return $result;
    }

    private function getModules(){
        if($this->modules == null){
            $this->modules = $this->loadModules();
        }

        return $this->modules;
    }

    private function loadModules(){
        $records = Yii::app()->db->createCommand()
            ->select('id_module id, language lang, m.title_ua title, tcm.start_date, tcm.end_date')
            ->from('teacher_consultant_module tcm')
            ->join('module m', 'm.module_ID=tcm.id_module')
            ->where('id_teacher=:id', array(':id' => $this->user->id))
            ->queryAll();

        return $records;
    }

    public function checkBeforeDeleteRole(StudentReg $user){
        return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value){
        switch ($attribute) {
            case 'module':
                return Yii::app()->db->createCommand()->
                update('teacher_consultant_module', array(
                    'end_date' => date("Y-m-d H:i:s"),
                ), 'id_teacher=:user and id_module=:module', array(':user' => $user->id, 'module' => $value));
                break;
            default:
                return false;
        }
    }

    public function addRoleFormList($query){
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_teacher_consultant u ON u.id_user = s.id';
        $criteria->addCondition('u.id_user IS NULL or u.end_date IS NOT NULL');

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

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkModule($user->id, $value)) {
                    return Yii::app()->db->createCommand()->
                    insert('teacher_consultant_module', array(
                        'id_teacher' => $user->id,
                        'id_module' => $value
                    ));
                } else {
                    return false;
                }
            default:
                return false;
        }
    }

    public function checkModule($teacher, $module){
        if(Yii::app()->db->createCommand('select id_teacher from teacher_consultant_module where id_module='.$module.
            ' and id_teacher='.$teacher.' and end_date IS NULL')->queryScalar()) {
            $this->errorMessage = "Даний викладач вже має права консультанта для обраного модуля.";
            return false;
        }
        else return true;
    }

    public function existOpenTaskAnswers(StudentReg $teacher){
        return (count($this->openPlainTaskAnswers($teacher)) > 0);
    }

    public function openPlainTaskAnswers(StudentReg $teacher){
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'ans';
        $criteria->join = 'LEFT JOIN plain_task_answer_teacher pt ON pt.id_plain_task_answer = ans.id';
        $criteria->condition = 'pt.id_teacher = '.$teacher->id.' and end_date IS NOT NULL';

        return PlainTaskAnswer::model()->findAll($criteria);
    }
}