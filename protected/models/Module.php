<?php

/**
 * This is the model class for table "module".
 *
 * The followings are the available columns in table 'module':
 * @property integer $module_ID
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property string $alias
 * @property string $language
 * @property integer $module_duration_hours
 * @property integer $module_duration_days
 * @property integer $lesson_count
 * @property string $module_price
 * @property string $for_whom
 * @property string $what_you_learn
 * @property string $what_you_get
 * @property string $module_img
 * @property string $about_module
 * @property string $owners
 * @property integer $hours_in_day
 * @property integer $days_in_week
 * @property integer $level
 * @property integer $rating
 *
 * The followings are the available model relations:
 * @property Course $course0
 */
class Module extends CActiveRecord
{
    public $logo=array();
    public $oldLogo;
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
			array('language', 'required'),
			array('module_duration_hours, module_duration_days, lesson_count, hours_in_day, days_in_week', 'numerical', 'integerOnly'=>true, 'message'=>Yii::t('module', '0413')),
			array('level', 'length', 'max'=>45),
			array('alias, module_price', 'length', 'max'=>10),
			array('language', 'length', 'max'=>6),
			array('module_img, title_ua, title_ru, title_en', 'length', 'max'=>255),
            array('module_img', 'file','types'=>'jpg, gif, png', 'allowEmpty' => true),
			array('for_whom, what_you_learn, what_you_get, about_module, owners,days_in_week, hours_in_day, level,days_in_week, hours_in_day, level, rating', 'safe'),
            array('title_ua, title_ru, title_en, level,hours_in_day, days_in_week', 'required','message'=>Yii::t('module', '0412'),'on'=>'canedit'),
            array('hours_in_day, days_in_week', 'numerical', 'integerOnly'=>true, 'min'=>1,"tooSmall"=>Yii::t('module', '0413'),'message'=>Yii::t('module', '0413'), 'on'=>'canedit'),
            array('module_price', 'numerical', 'integerOnly'=>true, 'min'=>0,"tooSmall"=>Yii::t('module', '0413'),'message'=>Yii::t('module', '0413'), 'on'=>'canedit'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('module_ID, title_ua, title_ru, title_en, alias, language, module_duration_hours, module_duration_days, lesson_count, module_price, for_whom, what_you_learn, what_you_get, module_img, about_module, owners, days_in_week, hours_in_day, level', 'safe', 'on'=>'search'),
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
            'ModuleId' => array(self::BELONGS_TO, 'Lecture', 'idModule'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'module_ID' => 'Module',
			'title_ua' => 'Назва українською',
            'title_ru' => 'Назва російською',
            'title_en' => 'Назва англійською',
			'alias' => 'Alias',
			'language' => 'Language',
			'module_duration_hours' => 'Module Duration Hours',
			'module_duration_days' => 'Module Duration Days',
			'lesson_count' => 'Lesson Count',
			'module_price' => 'Module Price',
			'for_whom' => 'For Whom',
			'what_you_learn' => 'What You Learn',
			'what_you_get' => 'What You Get',
			'module_img' => 'Module Img',
			'about_module' => 'About Module',
			'owners' => 'Owners',
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
		$criteria->compare('title_ua',$this->title_ua,true);
        $criteria->compare('title_ru',$this->title_ru,true);
        $criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('module_duration_hours',$this->module_duration_hours);
		$criteria->compare('module_duration_days',$this->module_duration_days);
		$criteria->compare('lesson_count',$this->lesson_count);
		$criteria->compare('module_price',$this->module_price,true);
		$criteria->compare('for_whom',$this->for_whom,true);
		$criteria->compare('what_you_learn',$this->what_you_learn,true);
		$criteria->compare('what_you_get',$this->what_you_get,true);
		$criteria->compare('module_img',$this->module_img,true);
		$criteria->compare('about_module',$this->about_module,true);
		$criteria->compare('owners',$this->owners,true);
        $criteria->compare('days_in_week',$this->days_in_week,true);
        $criteria->compare('hours_in_day',$this->hours_in_day,true);
        $criteria->compare('level',$this->level,true);
        $criteria->compare('rating',$this->rating,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Module the static model class
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

        public function getByAlias($alias){
        return $this->find('alias=:alias', array(':alias' == $alias))->module_ID;
    }

    public function addNewModule($idCourse, $titleUa, $titleRu, $titleEn, $lang){
        $module = new Module();
        $coursemodule = new CourseModules();

        $order = CourseModules::model()->count("id_course=$idCourse");

        $module->alias = "";
        $module->language = $lang;
        $module->title_ua = $titleUa;
        $module->title_ru = $titleRu;
        $module->title_en = $titleEn;
        if($module->validate()) {
            $module->save();
        }

        $idModule = Yii::app()->db->createCommand("SELECT max(module_ID) from module")->queryScalar();

        $coursemodule->id_course = $idCourse;
        $coursemodule->id_module = $idModule;
        $coursemodule->order = $order + 1;

        if($coursemodule->validate()) {
            $coursemodule->save();
        }

        return $order;
    }

    public static function getModules($id){
        $modules = Yii::app()->db->createCommand()
            ->select('module_ID')
            ->from('module')
            ->order('module_ID DESC')
            ->where('course='.$id)
            ->queryAll();
        $result = [];
        for($i = count($modules)-1; $i > 0; $i--){
            array_push($result, $modules[$i]["module_ID"]);
        }
        return $result;
    }

    public static function getModuleAlias($idModule, $idCourse){
        if($alias = Module::model()->findByPk($idModule)->alias){
            return $alias;
        } else{
            return CourseModules::model()->findByAttributes(array(
                'id_course' => $idCourse,
                'id_module' => $idModule
            ))->order;
        }
    }

    public static function getModuleByAlias($alias, $idCourse){
        if ($module = Module::model()->find(array(
            'condition' => 'alias = :alias',
            'params' => array('alias' => $alias),
        ))){
            return $module;
        } else {
            $idModule = CourseModules::model()->findByAttributes(array(
                'id_course' => $idCourse,
                'order' => $alias
            ))->id_module;
            return Module::model()->findByPk($idModule);
        }
    }
}
