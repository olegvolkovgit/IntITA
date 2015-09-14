<?php

/**
 * This is the model class for table "course_modules".
 *
 * The followings are the available columns in table 'course_modules':
 * @property integer $id_course
 * @property integer $id_module
 * @property integer $order
 * @property integer $mandatory_modules
 *
 * The followings are the available model relations:
 * @property Course $idCourse
 * @property Module $idModule
 */
class CourseModules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_course, id_module, order', 'required'),
			array('id_course, id_module, order, mandatory_modules', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_course, id_module, order, mandatory_modules', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'moduleInCourse' => array(self::HAS_ONE, 'Module', array('module_ID' => 'id_module')),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_course' => 'Id Course',
			'id_module' => 'Id Module',
            'mandatory_modules' => 'Попередні модулі(обов`язкові)',
			'order' => 'Order',
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
	public function search($id)
	{

		$criteria=new CDbCriteria;

        $criteria->addCondition('id_course='.$id);

		$criteria->compare('id_course',$this->id_course);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('order',$this->order);
        $criteria->compare('mandatory_modules',$this->mandatory_modules);
        $criteria->with = array('moduleInCourse');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CourseModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function primaryKey()
    {
        return array('id_course', 'id_module');
    }
}
