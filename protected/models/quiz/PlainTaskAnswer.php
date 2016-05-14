<?php

/**
 * This is the model class for table "plain_task_answer".
 *
 * The followings are the available columns in table 'plain_task_answer':
 * @property integer $id
 * @property string $answer
 * @property integer $id_student
 * @property integer $id_plain_task
 * @property string $date
 * @property int $consultant
 *
 * @property PlainTask $plainTask
 * @property StudentReg $user
 */
class PlainTaskAnswer extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'plain_task_answer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_student, id_plain_task', 'required'),
            array('id_student, id_plain_task,consultant', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, answer,consultant, id_student, id_plain_task, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'plainTask' => array(self::BELONGS_TO, 'PlainTask', 'id_plain_task'),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'id_student'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'answer' => 'Answer',
            'id_student' => 'Id Student',
            'id_plain_task' => 'Id Plain Task',
            'consultant' => 'Consultant',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('answer', $this->answer, true);
        $criteria->compare('id_student', $this->id_student);
        $criteria->compare('id_plain_task', $this->id_plain_task);
        $criteria->compare('date', $this->date);
        $criteria->compare('consultant', $this->consultant);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PlainTaskAnswer the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function fillHole($answer, $id_student, $id_plain_task)
    {
        $plainTaskAnswer = new PlainTaskAnswer();
        $plainTaskAnswer->answer = $answer;
        $plainTaskAnswer->id_student = $id_student;
        $plainTaskAnswer->id_plain_task = $id_plain_task;

        return $plainTaskAnswer;
    }

    public function getStudentName()
    {
        if ($this->user)
            return $this->user->email;
        else return null;
    }

    public function getConsultant()
    {
        $teacher = Yii::app()->db->createCommand()
            ->select('id_teacher')
            ->from('plain_task_answer_teacher')
            ->where('id_plain_task_answer = :id and end_date IS NULL',
                array(':id' => $this->id))
            ->queryScalar();

        return RegisteredUser::userById($teacher)->registrationData;
    }

    public function getCondition()
    {
        $plainTask = $this->plainTask;
        return $plainTask->lectureElement->html_block;
    }

    public function getModule()
    {
        return Module::model()->findByPk(Yii::app()->db->createCommand()
            ->select('idModule')
            ->from('plain_task')
            ->where('plain_task.id = :id', array(':id' => $this->id_plain_task))
            ->join('lecture_element', 'lecture_element.id_block = block_element')
            ->join('lectures', 'lectures.id = lecture_element.id_lecture')
            ->queryRow());
    }

    public function getTrainersByAnswer()
    {
        $module = $this->getModule();
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 't';
        $criteria->distinct = true;
        $criteria->join = 'JOIN consultant_modules cm ON cm.consultant = t.user_id';
        $criteria->addCondition('cm.module = :module');
        $criteria->params = array(':module' => $module->module_ID);

        return Teacher::model()->findAll($criteria);
    }

    public static function newTeacherPlainTask($teacherPlainTask)
    {
        $result = [];

        $nonMarkTasks = Yii::app()->db->createCommand()
            ->select('plain_task_answer.id')
            ->from('plain_task_answer')
            ->leftJoin('plain_task_marks', 'plain_task_answer.id = id_answer')
            ->where('plain_task_marks.mark IS NULL')
            ->queryAll();
        for ($i = 0; $i < count($nonMarkTasks); $i++) {
            for ($j = 0; $j < count($teacherPlainTask); $j++) {
                if ($teacherPlainTask[$j]['id'] == $nonMarkTasks[$i]['id']) {
                    array_push($result, $teacherPlainTask[$j]['id']);
                }
            }
        }

        return $result;
    }

    public static function plainTaskListByTeacher($id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'ans';
        $criteria->order = 'ans.id DESC';
        $criteria->join = ' LEFT JOIN teacher_consultant_student tcs ON ans.id_student = tcs.id_student';
        $criteria->join .= ' LEFT JOIN teacher_consultant_module tcm ON tcs.id_module = tcm.id_module';
        $criteria->addCondition('tcs.id_teacher =:id and tcs.end_date IS NULL and tcm.end_date IS NULL and tcm.id_teacher=:id');
        $criteria->params = array(':id' => $id);
        $criteria->group = 'ans.id DESC';
        return PlainTaskAnswer::model()->findAll($criteria);
    }

    public function mark()
    {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->order = 'time DESC';
        $criteria->addCondition('id_user =:user and id_answer =:answer');
        $criteria->params = array(':user' => $this->id_student, ':answer' => $this->id);
        $criteria->limit = 1;

        return PlainTaskMarks::model()->find($criteria);
    }

    public function getModuleTitle()
    {
        return Yii::app()->db->createCommand()
            ->select('title_ua')
            ->from('plain_task')
            ->where('plain_task.id = :id', array(':id' => $this->id_plain_task))
            ->join('lecture_element', 'lecture_element.id_block = block_element')
            ->join('lectures', 'lectures.id = lecture_element.id_lecture')
            ->queryScalar();
    }
}
