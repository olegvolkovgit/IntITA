<?php
/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $course_ID
 *  @property string $alias
 * @property string $language
 * @property string $course_name
 * @property integer $course_duration_lectures
 * @property integer $modules_count
 * @property string $course_price
 * @property string $for_whom
 * @property string $what_you_learn
 * @property string $what_you_get
 * @property string $course_img
 *
 * The followings are the available model relations:
 * @property Modules[] $modules
 * @property Studentsaccess[] $studentsaccesses
 */
class Course extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias, language, course_name, course_duration_hours', 'required'),
			array('course_duration_hours, modules_count', 'numerical', 'integerOnly'=>true),
			array('alias, course_price', 'length', 'max'=>10),
			array('language', 'length', 'max'=>6),
			array('course_name', 'length', 'max'=>45),
			array('course_img', 'length', 'max'=>255),
			array('for_whom, what_you_learn, what_you_get', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('course_ID,alias, language, course_name, course_duration_hours, modules_count, course_price, for_whom, what_you_learn,what_you_get, course_img', 'safe', 'on'=>'search'),
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
			'modules' => array(self::HAS_MANY, 'Modules', 'course'),
			'studentsaccesses' => array(self::HAS_MANY, 'Studentsaccess', 'courseID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_ID' => 'Course',
			'alias' => 'Alias',
			'language' => 'Language',
			'course_name' => 'Course Name',
			'course_duration_hours' => 'Course Duration Hours',
			'modules_count' => 'Modules Count',
			'course_price' => 'Course Price',
			'for_whom' => 'For Whom',
			'what_you_learn' => 'What You Learn',
			'what_you_get' => 'What You Get',
			'course_img' => 'Course Img',
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

		$criteria->compare('course_ID',$this->course_ID);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('course_name',$this->course_name,true);
		$criteria->compare('course_duration_hours',$this->course_duration_hours);
		$criteria->compare('modules_count',$this->modules_count);
		$criteria->compare('course_price',$this->course_price,true);
		$criteria->compare('for_whom',$this->for_whom,true);
		$criteria->compare('what_you_learn',$this->what_you_learn,true);
		$criteria->compare('what_you_get',$this->what_you_get,true);
		$criteria->compare('course_img',$this->course_img,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Course the static model class
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
	public function getModulesTermination ($num)
	{
		//Оставляем две последние цифры от $num
		$number = substr($num, -2);

		//Если 2 последние цифры входят в диапазон от 11 до 14
		//Тогда подставляем окончание "ЕВ"
		if($number > 10 and $number < 15)
		{
			$term = "ів";
		}
		else
		{

			$number = substr($number, -1);

			if($number == 0) {$term = "ів";}
			if($number == 1 ) {$term = "ь";}
			if($number > 1 ) {$term = "я";}
			if($number > 4 ) {$term = "ів";}
		}

		echo  ' модул'.$term;
	}

	public function getCourseAlias($id){
		return $this->findByPk($id)->alias;
	}

	public function exists($alias){
		return $this->findCourseIDByAlias($alias);
	}

	public function findCourseIDByAlias($alias){
		return $this->find('alias=:alias', array(':alias' == $alias))->course_ID;
	}
}