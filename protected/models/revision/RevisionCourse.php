<?php

/**
 * This is the model class for table "vc_course".
 *
 * The followings are the available columns in table 'vc_course':
 * @property integer $id_course_revision
 * @property integer $id_parent
 * @property integer $id_course
 * @property integer $id_properties
 *
 * The followings are the available model relations:
 * @property Course $idCourse
 * @property CourseProperties $idProperties
 * @property CourseModule[] $courseModules
 */
class RevisionCourse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_course, id_properties', 'required'),
			array('id_parent, id_course, id_properties', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_course_revision, id_parent, id_course, id_properties', 'safe', 'on'=>'search'),
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
			'idCourse' => array(self::BELONGS_TO, 'Course', 'id_course'),
			'idProperties' => array(self::BELONGS_TO, 'CourseProperties', 'id_properties'),
			'courseModules' => array(self::HAS_MANY, 'CourseModule', 'id_course_revision'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_course_revision' => 'Id Course Revision',
			'id_parent' => 'Id Parent',
			'id_course' => 'Id Course',
			'id_properties' => 'Id Properties',
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

		$criteria->compare('id_course_revision',$this->id_course_revision);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_course',$this->id_course);
		$criteria->compare('id_properties',$this->id_properties);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionCourse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
