<?php

class Trainer extends Role
{
    private $capacity;
	private $dbModel;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_trainer';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title()
    {
		return 'Тренер';
	}

    /**
     * @return array attributes trainer role
     */
	public function attributes(StudentReg $user)
	{
        $capacity = $this->getCapacity($user);
        $list = $this->studentsList($user);
        $newAnswers = $this->newPlainTaskAnswers($user);

		return array(
            array(
                'key' => 'students-list',
                'title' => 'Список студентів',
                'type' => 'students-list',
                'value' => $list
            ),
            array(
                'key' => 'capacity',
                'title' => 'Максимальна кількість студентів',
                'type' => 'number',
                'value' => $capacity["capacity"]
            ),
            array(
                'key' => 'new-answers',
                'title' => 'Нові відповіді студентів',
                'type' => 'new-answers',
                'value' => $newAnswers
            )
        );
	}

    private function getCapacity(StudentReg $user){
        return Yii::app()->db->createCommand()
            ->select('capacity')
            ->from($this->tableName())
            ->where('id_user=:id', array(':id'=>$user->id))
            ->queryRow();
    }

    private function studentsList(StudentReg $user){
        $students = Yii::app()->db->createCommand()
            ->select('id, firstName, secondName, middleName, email, tr.start_time, end_time')
            ->from('user u')
            ->join('trainer_student tr', 'tr.student=u.id')
            ->where('trainer=:id', array(':id'=>$user->id))
            ->queryAll();

        $list = [];
        foreach($students as $key=>$value){
            $list[$key]['id'] = $value["id"];
            $list[$key]['title'] = $value["secondName"]." ".$value["firstName"]." ".$value["middleName"]." ".$value["email"];
            $list[$key]['email'] = $value["email"];
            $list[$key]['start_date'] = $value["start_time"];
            $list[$key]['end_date'] = $value["end_time"];
        }

        return $list;
    }

    private function newPlainTaskAnswers($user){
        return Yii::app()->db->createCommand()
            ->select('ans.id, ans.answer, CONCAT(u.secondName, u.firstName) studentName, u.email, pt.id_plain_task_answer, pt.end_date')
            ->from('plain_task_answer ans')
            ->leftJoin('plain_task_answer_teacher pt', 'pt.id_plain_task_answer = ans.id')
            ->leftJoin('plain_task_marks pm', 'pm.id_answer = ans.id')
            ->leftJoin('user u', 'u.id = ans.id_student')
            ->where('(pt.id_plain_task_answer IS NULL or (pt.end_date IS NOT NULL and pt.id_plain_task_answer IS NOT NULL)) and ans.id_student in (
            select id_student from trainer_student where trainer=:trainer and end_time IS NULL) and pt.id_teacher=:trainer',
                array(':trainer' => $user->id))
            ->group('ans.id')
            ->having('MAX(pt.end_date) IS NOT NULL')
            ->queryAll();
     }

    public function setAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'students-list':
                if($this->checkTrainer($value)) {
                    return Yii::app()->db->createCommand()->
                    insert('trainer_student', array(
                        'trainer' => $user->id,
                        'student' => $value
                    ));
                    break;
                }
            return false;
            default:
                return parent::setAttribute($user, $attribute, $value);
        }
    }

    public function checkTrainer($student){
        if(Yii::app()->db->createCommand('select trainer from trainer_student where student='.$student.
            ' and end_time IS NULL')->queryScalar())
            return false;
        else return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        switch ($attribute) {
            case 'students-list':
                return Yii::app()->db->createCommand()->
                update('trainer_student', array(
                    'end_time' => date("Y-m-d H:i:s"),
                ), 'trainer=:user and student=:student', array(':user' => $user->id, 'student' => $value));
                break;
            default:
                return false;
        }
    }

    public static function trainersByQuery($query){
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
        foreach ($data as $key=>$model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function checkBeforeDeleteRole(StudentReg $user){
        return count($this->attributes($user)["students-list"]) > 0;
    }
}
