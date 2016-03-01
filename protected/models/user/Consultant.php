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
                return Yii::app()->db->createCommand()->
                insert('consultant_modules', array(
                    'consultant' => $user->id,
                    'module' => $value
                ));
                break;
            default:
                return false;
        }
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
}
