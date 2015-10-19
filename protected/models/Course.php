<?php
/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $course_ID
 *  @property string $alias
 * @property string $language
 * @property string $title_ua
 *  @property string $title_ru
 *  @property string $title_en
 * @property integer $course_duration_lectures
 * @property integer $modules_count
 * @property string $course_price
 * @property string $for_whom_ua
 * @property string $what_you_learn_ua
 * @property string $what_you_get_ua
 * @property string $for_whom_ru
 * @property string $what_you_learn_ru
 * @property string $what_you_get_ru
 * @property string $for_whom_en
 * @property string $what_you_learn_en
 * @property string $what_you_get_en
 * @property string $course_img
 * @property integer $rating
 * @property string $level
 * @property integer $cancelled
 * @property integer $course_number
 *
 * The followings are the available model relations:
 * @property Modules[] $modules
 */
class Course extends CActiveRecord
{
	const MAX_LEVEL = 5;
    public $logo=array(),$oldLogo;
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
			array('language, title_ua, alias', 'required', 'message'=>Yii::t('coursemanage', '0387')),
			array('course_duration_hours, course_price, cancelled, course_number', 'numerical', 'integerOnly'=>true,
                'min'=>0,"tooSmall" => Yii::t('coursemanage', '0388'),'message'=>Yii::t('coursemanage', '0388')),
			array('alias, course_price', 'length', 'max'=>20),
			array('language', 'length', 'max'=>6),
			array('title_ua, title_ru, title_en', 'length', 'max'=>100),
			array('course_img', 'length', 'max'=>255),
            array('course_img', 'file','types'=>'jpg, gif, png', 'allowEmpty' => true),
            array('start', 'date', 'format'=>'yyyy-MM-dd','message'=>Yii::t('coursemanage', '0389')),
			array('for_whom_ua, what_you_learn_ua, what_you_get_ua, for_whom_ru, what_you_learn_ru, what_you_get_ru,
			for_whom_en, what_you_learn_en, what_you_get_en, level, start, course_price, status, review, rating', 'safe'),
			// The following rule is used by search().
			array('course_ID,alias, language, title_ua, title_ru, title_en, course_duration_hours, modules_count,
			course_price, for_whom_ua, what_you_learn_ua,what_you_get_ua,
			 for_whom_ru, what_you_learn_ru, what_you_get_ru, for_whom_en, what_you_learn_en, what_you_get_en,
			 course_img, cancelled, course_number', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'course_ID' => 'ID',
            'alias' => 'Псевдонім',
            'language' => Yii::t('course', '0400'),
            'title_ua' => Yii::t('course', '0401'),
            'title_ru' => 'Назва російською',
            'title_en' => 'Назва англійською',
            'course_duration_hours' => Yii::t('course', '0402'),
            'modules_count' => Yii::t('course', '0403'),
            'course_price' => Yii::t('course', '0404'),
            'for_whom_ua' => Yii::t('course', '0405')." (UA)",
            'what_you_learn_ua' => Yii::t('course', '0406')." (UA)",
            'what_you_get_ua' => Yii::t('course', '0407')." (UA)",
            'for_whom_ru' => Yii::t('course', '0405')." (RU)",
            'what_you_learn_ru' => Yii::t('course', '0406')." (RU)",
            'what_you_get_ru' => Yii::t('course', '0407')." (RU)",
            'for_whom_en' => Yii::t('course', '0405')." (EN)",
            'what_you_learn_en' => Yii::t('course', '0406')." (EN)",
            'what_you_get_en' => Yii::t('course', '0407')." (EN)",
            'course_img' => Yii::t('course', '0408'),
            'level' => Yii::t('course', '0409'),
            'start' => Yii::t('course', '0410'),
            'status' => Yii::t('course', '0411'),
            'cancelled' => 'Видалений',
            'course_number' => 'Номер курса',
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

		$criteria->compare('course_ID',$this->course_ID);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('title_ua',$this->title_ua,true);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('course_duration_hours',$this->course_duration_hours);
		$criteria->compare('modules_count',$this->modules_count);
		$criteria->compare('course_price',$this->course_price,true);
		$criteria->compare('for_whom_ua',$this->for_whom_ua,true);
		$criteria->compare('what_you_learn_ua',$this->what_you_learn_ua,true);
		$criteria->compare('what_you_get_ua',$this->what_you_get_ua,true);
        $criteria->compare('for_whom_ru',$this->for_whom_ru,true);
        $criteria->compare('what_you_learn_ru',$this->what_you_learn_ru,true);
        $criteria->compare('what_you_get_ru',$this->what_you_get_ru,true);
        $criteria->compare('for_whom_en',$this->for_whom_en,true);
        $criteria->compare('what_you_learn_en',$this->what_you_learn_en,true);
        $criteria->compare('what_you_get_en',$this->what_you_get_en,true);
		$criteria->compare('course_img',$this->course_img,true);
        $criteria->compare('cancelled',$this->cancelled,true);
        $criteria->compare('cancelled',$this->course_number);

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

/*	public function exists($alias){
		return $this->findCourseIDByAlias($alias);
	}*/

	public function findCourseIDByAlias($alias){
		return $this->find('alias=:alias', array(':alias' == $alias))->course_ID;
	}

    protected function beforeSave()
    {
        if($this->start=='') $this->start=null;
        if (($this->scenario=="update") && (empty($this->logo['tmp_name']['course_img'])))
        {
            $this->course_img=$this->oldLogo;
        } else if(($this->scenario=="update") && (!empty($this->logo['tmp_name']['course_img']))){
            $src=Yii::getPathOfAlias('webroot')."/images/course/".$this->oldLogo;
            if (is_file($src))
                unlink($src);
        }
        if (($this->scenario=="insert" || $this->scenario=="update") && !empty($this->logo['tmp_name']['course_img']))
        {
            if(!copy($this->logo['tmp_name']['course_img'],Yii::getPathOfAlias('webroot')."/images/course/".$this->logo['name']['course_img']))
                throw new CHttpException(500);
        }
        return true;
    }

	public static function getCoursePrice($idCourse){
        $modules = Yii::app()->db->createCommand("SELECT id_module FROM course_modules WHERE id_course =".$idCourse
        )->queryAll();
        $summa = 0;
        for ($i = 0, $count = count($modules); $i < $count; $i++){
            $summa += (integer) Module::model()->findByPk($modules[$i]["id_module"])->module_price;
        }
        return $summa;
    }

    public static function getCoursesByLevel($selector)
    {
        $criteria = Course::getCriteriaBySelector($selector);
        $dataProvider = new CActiveDataProvider('Course', array(
            'criteria' => $criteria,
            'Pagination'=>false,
        ));

        return $dataProvider;
    }

    public static function getCriteriaBySelector($selector)
    {
        $criteria= new CDbCriteria;
        $criteria->alias = 'course';
        $criteria->order = 'rating DESC';
        $criteria->condition = 'language="ua" and cancelled="0"';
        if ($selector !== 'all'){
            if ($selector == 'junior'){
                $criteria->addInCondition('level', array('intern','strong junior','junior'));
            } else {
                $criteria->condition = 'level=:level and language="ua" and cancelled=0';
                $criteria->params = array(':level'=>$selector);
            }
        }
        return $criteria;
    }
}