<?php

/**
 * This is the model class for table "teacher_module".
 *
 * The followings are the available columns in table 'teacher_module':
 * @property integer $id
 * @property integer $idTeacher
 * @property integer $idModule
 *
 * The followings are the available model relations:
 * @property Module $idModule0
 * @property Teacher $idTeacher0
 */
class TeacherModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTeacher, idModule', 'required'),
			array('idTeacher, idModule', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, idTeacher, idModule', 'safe', 'on'=>'search'),
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
			'idModule0' => array(self::BELONGS_TO, 'Module', 'idModule'),
			'idTeacher0' => array(self::BELONGS_TO, 'Teacher', 'idTeacher'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTeacher' => 'Id Teacher',
			'idModule' => 'Id Module',
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
		$criteria->compare('idTeacher',$this->idTeacher);
		$criteria->compare('idModule',$this->idModule);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getCourseTeachers($modules){
        $criteria = new CDbCriteria();
        $criteria->select =  'idTeacher';
        $criteria->order = 'idTeacher';
        $criteria->addInCondition('idModule', $modules);
        $criteria->distinct = true;
        $criteria->toArray();

        $teachers = TeacherModule::model()->findAll($criteria);
        $result = [];
        for ($i = count($teachers)-1;$i > 0; $i--){
            array_push($result, $teachers[$i]["idTeacher"]);
        }
        return $result;
    }
}
