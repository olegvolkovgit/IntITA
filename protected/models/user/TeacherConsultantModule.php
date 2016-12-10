<?php

/**
 * This is the model class for table "teacher_consultant_module".
 *
 * The followings are the available columns in table 'teacher_consultant_module':
 * @property integer $id_teacher
 * @property integer $id_module
 * @property string $start_date
 * @property string $end_date
 *
 */
class TeacherConsultantModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_consultant_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_teacher, id_module, start_date', 'required'),
			array('id_teacher, id_module', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_teacher, id_module, start_date, end_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'StudentReg', ['id_teacher'=>'id']),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_teacher' => 'Id Teacher',
			'id_module' => 'Id Module',
            'start_date' => 'Start date',
            'end_date' => 'End date'
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
		$criteria=new CDbCriteria;
		
		$criteria->compare('id_teacher',$this->id_teacher);
		$criteria->compare('id_module',$this->id_module);
        $criteria->compare('start_date',$this->start_date);
        $criteria->compare('end_date',$this->end_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherConsultantModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
