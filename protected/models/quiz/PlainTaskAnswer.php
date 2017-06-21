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
 * @property integer $quiz_uid
 * @property integer $read_answer
 *
 * @property PlainTask $plainTask
 * @property StudentReg $user
 */
class PlainTaskAnswer extends CActiveRecord
{
    const STUDENTS_WITHOUT_GROUPS = 0;
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
            array('id_student, id_plain_task, quiz_uid', 'required'),
            array('id_student, id_plain_task, quiz_uid', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, answer, id_student, id_plain_task, date, quiz_uid, read_answer', 'safe', 'on' => 'search'),
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
            'plainTask' => array(self::BELONGS_TO, 'PlainTask', ['quiz_uid'=>'uid']),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'id_student'),
            'plainTaskMark' => array(self::BELONGS_TO, 'PlainTaskMarks', ['id'=>'id_answer']),
            'plainTaskQuestion' => array(self::BELONGS_TO, 'LectureElement', array('block_element'=>'id_block'), 'through' => 'plainTask'),
            'plainTaskLecture' => array(self::BELONGS_TO, 'Lecture', array('id_lecture'=>'id'), 'through' => 'plainTaskQuestion'),
            'plainTaskModule' => array(self::BELONGS_TO, 'Module', array('idModule'=>'module_ID'), 'through' => 'plainTaskLecture'),
            'markedBy' => array(self::BELONGS_TO, 'StudentReg', array('marked_by'=>'id'), 'through' => 'plainTaskMark'),
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
            'quiz_uid' => 'Quiz uid',
            'read_answer' => 'Read answer'
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
        $criteria->compare('quiz_uid', $this->quiz_uid);
        $criteria->compare('read_answer', $this->read_answer);

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
        $plainTask = PlainTask::model()->findByPk($id_plain_task);

        $plainTaskAnswer = new PlainTaskAnswer();
        $plainTaskAnswer->answer = $answer;
        $plainTaskAnswer->id_student = $id_student;
        $plainTaskAnswer->id_plain_task = $plainTask->id;
        $plainTaskAnswer->quiz_uid = $plainTask->uid;

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
        return $plainTask->getDescription();
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

    public static function plainTaskListByTeacher()
    {
        $requestParams = $_GET;
        $untested=false;
        if(isset($requestParams['filter']['plainTaskMark.mark']) && $requestParams['filter']['plainTaskMark.mark']=='null'){
            unset($requestParams['filter']['plainTaskMark.mark']);
            $untested=true;
        }
        if(isset($requestParams['filter']['studentsCategory.id'])){
            $studentsCategory=$requestParams['filter']['studentsCategory.id'];
            unset($requestParams['filter']['studentsCategory.id']);
        }

        $ngTable = new NgTableAdapter('PlainTaskAnswer', $requestParams);

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 't';
        $criteria->join = ' LEFT JOIN plain_task pt ON t.quiz_uid = pt.uid';
        $criteria->join .= ' LEFT JOIN lecture_element le ON pt.block_element = le.id_block';
        $criteria->join .= ' LEFT JOIN lectures l ON le.id_lecture = l.id';
        $criteria->join .= ' RIGHT JOIN teacher_consultant_student tcs ON t.id_student = tcs.id_student and l.idModule = tcs.id_module';
        $criteria->join .= ' RIGHT JOIN teacher_consultant_module tcm ON l.idModule = tcm.id_module';
        $criteria->join .= ' LEFT JOIN module m ON m.module_ID = tcm.id_module';
        if($untested){
            $criteria->join .= ' LEFT JOIN plain_task_marks ptm ON t.id = ptm.id_answer';
            $criteria->addCondition('ptm.id_answer IS NULL');
        }
        if(isset($studentsCategory)){
            if($studentsCategory!=self::STUDENTS_WITHOUT_GROUPS){
                $criteria->join .= ' LEFT JOIN offline_students os ON tcs.id_student = os.id_user';
                $criteria->join .= ' LEFT JOIN offline_subgroups osg ON osg.id = os.id_subgroup';
                $criteria->join .= ' LEFT JOIN offline_groups og ON og.id = osg.group';
                $criteria->addCondition('og.id='.$studentsCategory.' 
                and og.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
                and os.end_date IS NULL');
            }else{
                $studentsId = array();
                foreach (OfflineStudents::model()->with('group')->findAll(
                    array('order'=>'id_user',
                        'condition'=>'end_date is NULL and group.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id,
                        'select'=>'id_user',
                        'distinct'=>true)) as $row) {
                    array_push($studentsId, $row->id_user);
                }

                $criteria->join .= ' LEFT JOIN user_student us ON tcs.id_student = us.id_user';
                $criteria->addNotInCondition('us.id_user',$studentsId);
                $criteria->addCondition('us.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id.' 
                and us.end_date IS NULL');
            }
        }
        $criteria->addCondition('tcs.id_teacher ='.Yii::app()->user->getId().' and tcs.end_date IS NULL 
        and tcm.end_date IS NULL and tcm.id_teacher='.Yii::app()->user->getId().' 
        and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $criteria->group = 't.id DESC';
        $ngTable->mergeCriteriaWith($criteria);
        $result = $ngTable->getData();
        return json_encode($result);
    }

    public static function newPlainTaskListByTeacher($id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->alias = 'ans';
        $criteria->order = 'ans.id DESC';
        $criteria->join = ' LEFT JOIN plain_task pt ON ans.quiz_uid = pt.uid';
        $criteria->join .= ' LEFT JOIN lecture_element le ON pt.block_element = le.id_block';
        $criteria->join .= ' LEFT JOIN lectures l ON le.id_lecture = l.id';
        $criteria->join .= ' RIGHT JOIN teacher_consultant_student tcs ON ans.id_student = tcs.id_student and l.idModule = tcs.id_module';
        $criteria->join .= ' RIGHT JOIN teacher_consultant_module tcm ON l.idModule = tcm.id_module';
        $criteria->join .= ' LEFT JOIN module m ON m.module_ID = tcm.id_module';
        $criteria->addCondition('tcs.id_teacher =:id and tcs.end_date IS NULL 
        and tcm.end_date IS NULL and tcm.id_teacher=:id and ans.read_answer=0 
        and m.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);
        $criteria->params = array(':id' => $id);

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

    public function getLectureTitle()
    {
        return Yii::app()->db->createCommand()
            ->select('title_ua')
            ->from('plain_task')
            ->where('plain_task.uid = :id', array(':id' => $this->quiz_uid))
            ->join('lecture_element', 'lecture_element.id_block = block_element')
            ->join('lectures', 'lectures.id = lecture_element.id_lecture')
            ->queryScalar();
    }
}
