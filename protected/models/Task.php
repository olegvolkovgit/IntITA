<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $id_lecture
 * @property string $language
 * @property integer $assignment
 * @property integer $condition
 * @property integer $author
 * @property integer $level
 *
 * The followings are the available model relations:
 * @property LectureElement $condition0
 * @property Lecture $idLecture
 * @property Teacher $author0
 * @property TaskMarks[] $taskMarks
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture, language, assignment, condition, author, level', 'required'),
			array('id_lecture, assignment, condition, author, level', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lecture, language, assignment, condition, author, level', 'safe', 'on'=>'search'),
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
			'condition0' => array(self::BELONGS_TO, 'LectureElement', 'condition'),
			'idLecture' => array(self::BELONGS_TO, 'Lectures', 'id_lecture'),
			'author0' => array(self::BELONGS_TO, 'Teacher', 'author'),
			'taskMarks' => array(self::HAS_MANY, 'TaskMarks', 'id_task'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_lecture' => 'Id Lecture',
			'language' => 'Language',
			'assignment' => 'Assignment',
			'condition' => 'Condition',
			'author' => 'Author',
			'level' => 'Level',
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
		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('assignment',$this->assignment);
		$criteria->compare('condition',$this->condition);
		$criteria->compare('author',$this->author);
		$criteria->compare('level',$this->level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
