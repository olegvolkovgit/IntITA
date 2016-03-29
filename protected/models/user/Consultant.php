<?php

class Consultant extends Role
{
    private $dbModel;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_consultant';
    }

    /**
     * @return string the role title (ua)
     */
    public function title()
    {
        return 'Консультант';
    }

    public function attributes(StudentReg $user)
    {
        $records = Yii::app()->db->createCommand()
            ->select('module, language, m.title_ua, cm.start_time, cm.end_time')
            ->from('consultant_modules cm')
            ->join('module m', 'm.module_ID=cm.module')
            ->where('consultant=:id', array(':id' => $user->id))
            ->queryAll();

        $list = [];
        foreach ($records as $record) {
            $row["id"] = $record['module'];
            $row["title"] = $record['title_ua'];
            $row["start_date"] = $record['start_time'];
            $row["end_date"] = $record['end_time'];
            $row["lang"] = $record['language'];
            array_push($list, $row);
        }

        $attribute = array(
            'key' => 'module',
            'title' => 'Модулі',
            'type' => 'module-list',
            'value' => $list
        );
        $result = [];
        array_push($result, $attribute);

        return $result;
    }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                if($this->checkModule($user->id, $value)) {
                    return Yii::app()->db->createCommand()->
                    insert('consultant_modules', array(
                        'consultant' => $user->id,
                        'module' => $value
                    ));
                } else {
                    return false;
                }
            default:
                return false;
        }
    }

    public function checkModule($teacher, $module){
        if(Yii::app()->db->createCommand('select consultant from consultant_modules where module='.$module.
            ' and consultant='.$teacher.' and end_time IS NULL')->queryScalar())
            return false;
        else return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'module':
                return Yii::app()->db->createCommand()->
                update('consultant_modules', array(
                    'end_time' => date("Y-m-d H:i:s"),
                ), 'consultant=:user and module=:module', array(':user' => $user->id, 'module' => $value));
                break;
            default:
                return false;
        }
    }

    public static function consultantsByQuery($query){
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN consultant_modules cm ON cm.consultant = s.id';
        $criteria->addCondition('cm.consultant IS NOT NULL and cm.end_time IS NULL');

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
        return !$this->existOpenTaskAnswers($teacher);
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
