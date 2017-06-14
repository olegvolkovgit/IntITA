<?php

/**
 * This is the model class for table "teacher_response".
 *
 * The followings are the available columns in table 'teacher_response':
 * @property integer $id_teacher
 * @property integer $id_response
 *
 */
class TeacherResponse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_response';
	}

	public function primaryKey()
	{
		return 'id_response';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_teacher, id_response', 'required'),
			// The following rule is used by search().
			array('id_teacher, id_response', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'Teacher', ['id_teacher'=>'user_id']),
            'response' => array(self::BELONGS_TO, 'Response','id_response'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_teacher' => 'Id teacher',
			'id_response' => 'Id response',
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
		$criteria->compare('id_response',$this->id_response);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherResponse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
