<?php

class Author extends Role
{
    private $dbModel;
    private $modules;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return "";
    }

    /**
     * @return string the role title (ua)
     */
    public function title(){
        return 'Автор';
    }

    public function attributes(StudentReg $user)
    {
        $records = Yii::app()->db->createCommand()
            ->select('idModule, language, m.title_ua, tm.start_time, tm.end_time')
            ->from('teacher_module tm')
            ->join('module m', 'm.module_ID=tm.idModule')
            ->where('idTeacher=:id', array(':id' => $user->id))
            ->queryAll();

        $list = [];
        foreach ($records as $record) {
            $row["id"] = $record['idModule'];
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

    public  function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        return false;
    }
}