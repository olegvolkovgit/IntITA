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
        return "";
    }

    /**
     * @return string sql for check role author.
     */
    public function checkRoleSql(){
        return 'select "author" from teacher_module tm where tm.idTeacher = :id and end_time IS NULL';
    }

    /**
     * @return string the role title (ua)
     */
    public function title(){
        return 'Автор';
    }

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function attributes(StudentReg $user)
    {
        $records = Yii::app()->db->createCommand()
            ->select('idModule, language, m.title_ua, tm.start_time, tm.end_time, m.cancelled')
            ->from('teacher_module tm')
            ->leftJoin('module m', 'm.module_ID=tm.idModule')
            ->where('idTeacher=:id', array(':id' => $user->id))
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
            'key' => 'module',
            'title' => 'Модулі',
            'type' => 'module-list',
            'value' => $list
        );

        $result = [];
        $result["module"] = $attribute;

        return $result;
    }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkModule($user->id, $value)) {
                    return Yii::app()->db->createCommand()->
                    insert('teacher_module', array(
                        'idTeacher' => $user->id,
                        'idModule' => $value
                    ));
                } else {
                    return false;
                }
                break;
            default:
                return false;
        }
    }

    public function checkModule($teacher, $module){
        if(Yii::app()->db->createCommand('select idTeacher from teacher_module where idModule='.$module.
            ' and idTeacher='.$teacher.' and end_time IS NULL')->queryScalar())
            return false;
        else return true;
    }

    public function isTeacherAuthorModule($teacher, $module){
        if(Yii::app()->db->createCommand('select idTeacher from teacher_module where idModule='.$module.
            ' and idTeacher='.$teacher.' and end_time IS NULL')->queryScalar())
            return true;
        else return false;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                return Yii::app()->db->createCommand()->
                update('teacher_module', array(
                    'end_time' => date("Y-m-d H:i:s"),
                ), 'idTeacher=:user and idModule=:module', array(':user' => $user->id, 'module' => $value));
                break;
            default:
                return false;
        }
    }

    public function checkBeforeDeleteRole(StudentReg $user){
        return true;
    }

    //not supported
    public function addRoleFormList($query){
        return array();
    }
}