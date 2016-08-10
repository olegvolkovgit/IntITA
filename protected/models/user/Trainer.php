<?php

class Trainer extends Role
{
    private $capacity;
    private $dbModel;
    private $studentsList;
    private $errorMessage = "";

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user_trainer';
    }

    /**
     * @return string sql for check role trainer.
     */
    public function checkRoleSql()
    {
        return 'select "trainer" from user_trainer at where at.id_user = :id and end_date IS NULL';
    }

    /**
     * @return string the role title (ua)
     */
    public function title()
    {
        return 'Тренер';
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return array attributes trainer role
     */
    public function attributes(StudentReg $user)
    {
        $capacity = $this->getCapacity($user);
        if ($this->studentsList == null) {
            $this->studentsList = $this->studentsList($user);
        }

        return array(
            array(
                'key' => 'students-list',
                'title' => 'Список студентів',
                'type' => 'students-list',
                'value' => $this->studentsList
            ),
            array(
                'key' => 'capacity',
                'title' => 'Максимальна кількість студентів',
                'type' => 'number',
                'value' => $capacity["capacity"]
            )
        );
    }

    private function getCapacity(StudentReg $user)
    {
        return Yii::app()->db->createCommand()
            ->select('capacity')
            ->from($this->tableName())
            ->where('id_user=:id', array(':id' => $user->id))
            ->queryRow();
    }

    private function studentsList(StudentReg $user)
    {
        $students = Yii::app()->db->createCommand()
            ->select('id, firstName, secondName, middleName, email, tr.start_time, tr.end_time')
            ->from('user u')
            ->join('trainer_student tr', 'tr.student=u.id')
            ->where('trainer=:id', array(':id' => $user->id))
            ->queryAll();

        $list = [];
        foreach ($students as $key => $value) {
            $list[$key]['id'] = $value["id"];
            $list[$key]['title'] = implode(" ", array($value["secondName"], $value["firstName"], $value["middleName"]));
            $list[$key]['email'] = $value["email"];
            $list[$key]['start_date'] = $value["start_time"];
            $list[$key]['end_date'] = $value["end_time"];
        }

        $this->studentsList = $list;
        return $list;
    }

    private function currentStudentsCount(StudentReg $user)
    {
        $records = Yii::app()->db->createCommand()
            ->select('*')
            ->from('trainer_student')
            ->where('trainer=:id and end_time IS NULL', array(':id' => $user->id))
            ->queryAll();

        return count($records);
    }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'students-list':
                if ($this->checkTrainer($value) && $this->checkTrainerCapacity($user) && $this->checkUserStudent($value)) {
                    if (Yii::app()->db->createCommand()->
                    insert('trainer_student', array(
                        'trainer' => $user->id,
                        'student' => $value
                    ))
                    ) {
                        $user->notify('trainer' . DIRECTORY_SEPARATOR . '_assignNewStudent',
                            array(StudentReg::model()->findByPk($value)),
                            'Призначено нового студента');
                        return true;
                    }
                    return false;
                    break;
                }
                if($this->errorMessage) 
                    return $this->errorMessage;
                else return false;
            case 'capacity':
                if ($this->checkCapacity($value,$user)) {
                    $response=parent::setAttribute($user, $attribute, $value);
                    if($response==0 || $response==1) return true;
                    else return false;
                }
                if($this->errorMessage)
                    return $this->errorMessage;
                else return false;
            default:
                $response=parent::setAttribute($user, $attribute, $value);
                if($response==0 || $response==1) return true;
                else return false;
        }
    }

    public function checkTrainer($student)
    {
        if (Yii::app()->db->createCommand('select trainer from trainer_student where student=' . $student .
            ' and end_time IS NULL')->queryScalar()
        ) {
            $this->errorMessage = "Для даного студента тренер вже призначений.";
            return false;
        } else return true;
    }
    public function checkCapacity($count,$user)
    {
        if($count<$this->currentStudentsCount($user)) {
            $this->errorMessage = "Не можна виставити максимальну кількість студентів меншу ніж уже є в тренера";
            return false;
        } else return true;
    }
    public function checkTrainerCapacity($user)
    {
        if($this->currentStudentsCount($user)>$this->getCapacity($user)['capacity']) {
            $this->errorMessage = "Даного студента додати не можна, оскільки максимальна кількість студентів для тренера обмежена";
            return false;
        } else return true;
    }

    public function checkUserStudent($student)
    {
        if(!UserStudent::model()->exists('id_user=:id and end_date IS NULL', array(':id' => $student))) {
            $this->errorMessage = "Користувача додати не вдалося, оскільки він не є студентом";
            return false;
        } else return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'students-list':
                if (Yii::app()->db->createCommand()->
                update('trainer_student', array(
                    'end_time' => date("Y-m-d H:i:s"),
                ), 'trainer=:user and student=:student', array(':user' => $user->id, 'student' => $value))
                ) {
                    $user->notify('trainer' . DIRECTORY_SEPARATOR . '_cancelStudent',
                        array(StudentReg::model()->findByPk($value)),
                        'Скасовано студента');
                    return true;
                }
                return false;
                break;
            default:
                return false;
        }
    }

    public static function trainersByQuery($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "distinct id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN user_trainer u ON u.id_user = s.id';
        $criteria->addCondition('u.id_user IS NOT NULL and u.end_date IS NULL');

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function checkBeforeDeleteRole(StudentReg $user)
    {
        if (Yii::app()->db->createCommand('select count(student) from trainer_student where trainer=' . $user->id .
                ' and end_time IS NULL')->queryScalar() > 0
        ) {
            $this->errorMessage = "Тренеру призначені студенти. Щоб видалити роль тренера, потрібно скасувати права тренера для всіх студентів";
            return false;
        } else return true;
    }

    public function addRoleFormList($query)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id = s.id';
        $criteria->join .= ' LEFT JOIN user_trainer ut ON ut.id_user = t.user_id';
        $criteria->addCondition('t.user_id IS NOT NULL and ut.id_user IS NULL or ut.end_date IS NOT NULL');
        $criteria->group = 's.id';

        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }
}
