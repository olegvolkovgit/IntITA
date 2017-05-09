<?php

/**
 * This is the model class for table "v_tasks_in_lectures".
 *
 * The followings are the available columns in table 'v_tasks_in_lectures':
 * @property integer $id_lecture
 * @property integer $id_state
 * @property integer $quiz
 * @property integer $id_type
 */
class TasksInLectures extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_tasks_in_lectures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture, id_state, quiz, id_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_lecture, id_state, quiz, id_type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_lecture' => 'Id Lecture',
			'id_state' => 'Id State',
			'quiz' => 'Quiz',
			'id_type' => 'Id Type',
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

		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('id_state',$this->id_state);
		$criteria->compare('quiz',$this->quiz);
		$criteria->compare('id_type',$this->id_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TasksInLectures the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
