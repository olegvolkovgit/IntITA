<?php

/**
 * This is the model class for table "modules".
 *
 * The followings are the available columns in table 'modules':
 * @property integer $module_ID
 * @property string $module_name
 * @property integer $module_duration_hours
 * @property integer $module_duration_days
 * @property integer $lesson_count
 * @property string $module_price
 * @property string $for_whom
 * @property string $what_you_learn
 * @property string $what_you_get
 * @property string $module_img
 * @property string $about_module
 *
 * The followings are the available model relations:
 * @property Studentsaccess[] $studentsaccesses
 */
class Module extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_name, module_duration_hours, module_duration_days', 'required'),
			array('module_duration_hours, module_duration_days, lesson_count', 'numerical', 'integerOnly'=>true),
			array('module_name', 'length', 'max'=>45),
			array('module_price', 'length', 'max'=>10),
			array('module_img', 'length', 'max'=>255),
			array('for_whom, what_you_learn, what_you_get, about_module', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('module_ID, module_name, module_duration_hours, module_duration_days, lesson_count, module_price, for_whom, what_you_learn, what_you_get, module_img, about_module', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'module_ID' => 'Module',
			'module_name' => 'Module Name',
			'module_duration_hours' => 'Module Duration Hours',
			'module_duration_days' => 'Module Duration Days',
			'lesson_count' => 'Lesson Count',
			'module_price' => 'Module Price',
			'for_whom' => 'For Whom',
			'what_you_learn' => 'What You Learn',
			'what_you_get' => 'What You Get',
			'module_img' => 'Module Img',
			'about_module' => 'About Module',
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

		$criteria->compare('module_ID',$this->module_ID);
		$criteria->compare('module_name',$this->module_name,true);
		$criteria->compare('module_duration_hours',$this->module_duration_hours);
		$criteria->compare('module_duration_days',$this->module_duration_days);
		$criteria->compare('lesson_count',$this->lesson_count);
		$criteria->compare('module_price',$this->module_price,true);
		$criteria->compare('for_whom',$this->for_whom,true);
		$criteria->compare('what_you_learn',$this->what_you_learn,true);
		$criteria->compare('what_you_get',$this->what_you_get,true);
		$criteria->compare('module_img',$this->module_img,true);
		$criteria->compare('about_module',$this->about_module,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Modules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getHoursTermination ($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if($number > 10 and $number < 15)
        {
            $term = "";
        }
        else
        {

            $number = substr($number, -1);

            if($number == 0) {$term = "";}
            if($number == 1 ) {$term = "а";}
            if($number > 1 ) {$term = "и";}
            if($number > 4 ) {$term = "";}
        }

        echo  ' годин'.$term;
    }
    public function getLessonsTermination ($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if($number > 10 and $number < 15)
        {
            $term = "ь";
        }
        else
        {

            $number = substr($number, -1);

            if($number == 0) {$term = "ь";}
            if($number == 1 ) {$term = "тя";}
            if($number > 1 ) {$term = "тя";}
            if($number > 4 ) {$term = "ь";}
        }

        echo  ' занят'.$term;
    }

	public function findModuleIDByAlias($alias){
		return $this->find('alias=:alias', array(':alias' == $alias))->module_ID;
	}
}
