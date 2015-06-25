<?php

/**
 * This is the model class for table "consultant_modules".
 *
 * The followings are the available columns in table 'consultant_modules':
 * @property integer $id
 * @property integer $consultant
 * @property integer $module
 *
 * The followings are the available model relations:
 * @property Module $module0
 * @property Teacher $consultant0
 */
class ConsultantModules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consultant_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('consultant, module', 'required'),
			array('consultant, module', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, consultant, module', 'safe', 'on'=>'search'),
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
			'module0' => array(self::BELONGS_TO, 'Module', 'module'),
			'consultant0' => array(self::BELONGS_TO, 'Teacher', 'consultant'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'consultant' => 'Consultant',
			'module' => 'Module',
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
		$criteria->compare('consultant',$this->consultant);
		$criteria->compare('module',$this->module);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConsultantModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getModulesByConsultant($consultant){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('module'),
            'from' => 'consultant_modules',
            'where' => 'consultant=:id',
            'order' => 'module',
            'params' => array(':id' => $consultant),
        ))->queryAll();
        $count = count($modules);

        for($i = 0;$i < $count;$i++){
            $modules[$i]['id'] = $modules[$i]["module"];
            $modules[$i]['title'] = Module::model()->findByPk($modules[$i]["module"])->module_name;
        }

        return (!empty($modules))?$modules:[];
    }

    public static function setRoleAttribute($teacher, $attribute, $value){
        $result = false;
        if (ConsultantModules::model()->exists('consultant=:teacher and module=:attribute', array('teacher'=>$teacher, 'attribute'=>$attribute))){
            $model = ConsultantModules::model()->findByAttributes(array('consultant'=>$teacher, 'module'=>$attribute));
        } else{
            $model = new ConsultantModules();
            $model->consultant = $teacher;
            $model->module = $attribute;
        }
        $model->value = $value;
        if ($model->validate()){
            $model->save();
            $result = true;
        }
        return $result;
    }
}
