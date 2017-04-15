<?php

class Trainer extends Role
{
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
     * @param $organization Organization
     * @return string sql for check role trainer.
     */
    public function checkRoleSql($organization=null)
    {
        $condition=$organization?' and at.id_organization='.$organization:'';
        return 'select "trainer" from user_trainer at where at.id_user = :id and at.end_date IS NULL'.$condition;
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
    public function attributes(StudentReg $user, $organization=null)
    {
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
        );
    }

    private function studentsList(StudentReg $user)
    {
        $students = Yii::app()->db->createCommand()
            ->select('id, firstName, secondName, middleName, email, tr.start_time, tr.end_time')
            ->from('user u')
            ->join('trainer_student tr', 'tr.student=u.id')
            ->where('trainer=:id and id_organization=:id_org and end_time is NULL',
                array(':id' => $user->id, ':id_org' => Yii::app()->user->model->getCurrentOrganization()->id))
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
                if ($this->checkTrainer($value)
                    && $this->checkUserStudent($value)) {
                    if (Yii::app()->db->createCommand()->
                    insert('trainer_student', array(
                        'trainer' => $user->id,
                        'student' => $value,
                        'id_organization'=>Yii::app()->user->model->getCurrentOrganization()->id
                    ))
                    ) {
                        $user->notify('trainer' . DIRECTORY_SEPARATOR . '_assignNewStudent',
                            array(StudentReg::model()->findByPk($value), Yii::app()->user->model->getCurrentOrganization()->id),
                            'Призначено нового студента', Yii::app()->user->getId());
                        return true;
                    }
                    $this->errorMessage = "Призначити тренера не вдалося";
                    return false;
                    break;
                }else {
                    return false;
                }
            default:
                parent::setAttribute($user, $attribute, $value);
                return true;
        }
    }

    public function checkTrainer($student)
    {
        if (Yii::app()->db->createCommand('select trainer from trainer_student where student=' . $student .
            ' and end_time IS NULL and id_organization='.Yii::app()->user->model->getCurrentOrganization()->id)->queryScalar()
        ) {
            $this->errorMessage = "Для даного студента тренер вже призначений.";
            return false;
        } else return true;
    }

    public function checkUserStudent($student)
    {
        if(!UserStudent::model()->exists('id_user=:id and end_date IS NULL and id_organization='.Yii::app()->user->model->getCurrentOrganization()->id, array(':id' => $student))) {
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
                ), 'trainer=:user and student=:student and id_organization=:id_org',
                    array(':user' => $user->id, ':student' => $value, ':id_org'=>Yii::app()->user->model->getCurrentOrganization()->id))
                ) {
                    $user->notify('trainer' . DIRECTORY_SEPARATOR . '_cancelStudent',
                        array(StudentReg::model()->findByPk($value),Yii::app()->user->model->getCurrentOrganization()->id),
                        'Скасовано студента', Yii::app()->user->getId());
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
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->addCondition('u.id_user IS NOT NULL and u.end_date IS NULL and tco.id_user IS NOT NULL 
		and tco.end_date IS NULL and tco.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);

        $data = StudentReg::model()->findAll($criteria);
        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["nameEmail"] = trim($model->secondName . " " . $model->firstName . " " . $model->middleName.' ('.$model->email.')');
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null)
    {
        if (Yii::app()->db->createCommand('select count(student) from trainer_student where trainer=' . $user->id .
                ' and end_time IS NULL')->queryScalar() > 0
        ) {
            $this->errorMessage = "Тренеру призначені студенти. Щоб видалити роль тренера, потрібно скасувати права тренера для всіх студентів";
            return false;
        } else return true;
    }

    public function addRoleFormList($query, $organization)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id = s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_trainer ut ON ut.id_user = t.user_id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (ut.id_user IS NULL or ut.end_date IS NOT NULL or (ut.end_date IS NULL and ut.id_organization!='.$organization.'))');
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

    function getMembers($criteria = null)
    {
        return UserTrainer::model()->findAll($criteria);
    }
}
