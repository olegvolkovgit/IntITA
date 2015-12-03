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
			array('id_student, id_plain_task,consultant', 'numerical', 'integerOnly'=>true),
			array('answer', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, answer,consultant, id_student, id_plain_task, date', 'safe', 'on'=>'search'),
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
            'consultants' => array(self::BELONGS_TO, 'Teacher' , 'consultant'),
            'plainTask' => array(self::BELONGS_TO, 'PlainTask' , 'id_plain_task'),
            'user' => array(self::BELONGS_TO,'StudentReg','id_student'),
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('id_student',$this->id_student);
		$criteria->compare('id_plain_task',$this->id_plain_task);
        $criteria->compare('date',$this->date);
        $criteria->compare('consultant',$this->consultant);


        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlainTaskAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function fillHole($answer,$id_student,$id_plain_task)
    {
        $plainTaskAnswer = new PlainTaskAnswer();
        $plainTaskAnswer->answer = $answer;
        $plainTaskAnswer->id_student = $id_student;
        $plainTaskAnswer->id_plain_task = $id_plain_task;

        return $plainTaskAnswer;
    }

    public function getStudentName()
    {
        return $this->user->email;
    }

    public function getConsultant()
    {
        $teacher = $this->consultants;
        if($teacher)
        return $teacher->first_name;
    }

    public function getCondition()
    {
        $plainTask = $this->plainTask;
        if ($plainTask)
            return $plainTask->lectureElement->html_block;
    }

    public static function getAllPlainTaskAnswers(){
        $results = Yii::app()->db->createCommand()
            ->select('*')
            ->from('plain_task_answer_teacher')
            ->queryAll();
        return $results;
    }
}
