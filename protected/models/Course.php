<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property integer $course_ID
 * @property string $alias
 * @property string $language
 * @property string $title_ua
 * @property string $title_ru
 * @property string $title_en
 * @property integer $course_duration_lectures
 * @property integer $modules_count
 * @property string $course_price
 * @property integer $status
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
class Course extends CActiveRecord implements IBillableObject
{
    const MAX_LEVEL = 5;
    public $logo = array(), $oldLogo;


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
            array('language, title_ua, alias', 'required', 'message' => Yii::t('coursemanage', '0387')),
            array('course_duration_hours, course_price, cancelled, course_number', 'numerical', 'integerOnly' => true,
                'min' => 0, "tooSmall" => Yii::t('coursemanage', '0388'), 'message' => Yii::t('coursemanage', '0388')),
            array('alias, course_price', 'length', 'max' => 20),
            array('alias, course_number', 'unique', 'message' => Yii::t('course', '0740')),
            array('language', 'length', 'max' => 6),
            array('title_ua, title_ru, title_en', 'length', 'max' => 100),
            array('course_img', 'length', 'max' => 255),
            array('course_img', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
            array('start', 'date', 'format' => 'yyyy-MM-dd', 'message' => Yii::t('coursemanage', '0389')),
            array('for_whom_ua, what_you_learn_ua, what_you_get_ua, for_whom_ru, what_you_learn_ru, what_you_get_ru,
			for_whom_en, what_you_learn_en, what_you_get_en, level, start, course_price, status, review, rating', 'safe'),
            // The following rule is used by search().
            array('course_ID,alias, language, title_ua, title_ru, title_en, course_duration_hours, modules_count,
			course_price, status, for_whom_ua, what_you_learn_ua,what_you_get_ua,
			 for_whom_ru, what_you_learn_ru, what_you_get_ru, for_whom_en, what_you_learn_en, what_you_get_en,
			 course_img, cancelled, course_number', 'safe', 'on' => 'search'),
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
            'module' => array(self::MANY_MANY, 'Module', 'course_modules(id_course,id_module)')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'course_ID' => 'ID',
            'alias' => Yii::t('course', '0745'),
            'language' => Yii::t('course', '0400'),
            'title_ua' => Yii::t('course', '0401'),
            'title_ru' => Yii::t('course', '0744'),
            'title_en' => Yii::t('course', '0743'),
            'course_duration_hours' => Yii::t('course', '0402'),
            'modules_count' => Yii::t('course', '0403'),
            'course_price' => Yii::t('course', '0404'),
            'for_whom_ua' => Yii::t('course', '0405') . " (UA)",
            'what_you_learn_ua' => Yii::t('course', '0406') . " (UA)",
            'what_you_get_ua' => Yii::t('course', '0407') . " (UA)",
            'for_whom_ru' => Yii::t('course', '0405') . " (RU)",
            'what_you_learn_ru' => Yii::t('course', '0406') . " (RU)",
            'what_you_get_ru' => Yii::t('course', '0407') . " (RU)",
            'for_whom_en' => Yii::t('course', '0405') . " (EN)",
            'what_you_learn_en' => Yii::t('course', '0406') . " (EN)",
            'what_you_get_en' => Yii::t('course', '0407') . " (EN)",
            'course_img' => Yii::t('course', '0408'),
            'level' => Yii::t('course', '0409'),
            'start' => Yii::t('course', '0410'),
            'status' => Yii::t('course', '0411'),
            'cancelled' => Yii::t('course', '0741'),
            'course_number' => Yii::t('course', '0742'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('course_ID', $this->course_ID);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('title_ua', $this->title_ua, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('course_duration_hours', $this->course_duration_hours);
        $criteria->compare('modules_count', $this->modules_count);
        $criteria->compare('course_price', $this->course_price, true);
        $criteria->compare('for_whom_ua', $this->for_whom_ua, true);
        $criteria->compare('what_you_learn_ua', $this->what_you_learn_ua, true);
        $criteria->compare('what_you_get_ua', $this->what_you_get_ua, true);
        $criteria->compare('for_whom_ru', $this->for_whom_ru, true);
        $criteria->compare('what_you_learn_ru', $this->what_you_learn_ru, true);
        $criteria->compare('what_you_get_ru', $this->what_you_get_ru, true);
        $criteria->compare('for_whom_en', $this->for_whom_en, true);
        $criteria->compare('what_you_learn_en', $this->what_you_learn_en, true);
        $criteria->compare('what_you_get_en', $this->what_you_get_en, true);
        $criteria->compare('course_img', $this->course_img, true);
        $criteria->compare('cancelled', $this->cancelled, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('course_number', $this->course_number);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Course the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getBasePrice()
    {
        $price = 0;
        $modules = $this->module;

        foreach ($modules as $module) {
            $price += $module->module_price;
        }

        return $price;
    }

    public function getDuration()
    {
        $modules = $this->getCourseModulesSchema($this->course_ID);
        $tableCells = $this->getTableCells($modules, $this->course_ID);
        $courseDurationInMonths = Course::getCourseDuration($tableCells) + 1 + 4;//где 1 месяц екзамена, где 4 месяца стажировки

        return $courseDurationInMonths;

    }

    public function getHoursTermination($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if ($number > 10 and $number < 15) {
            $term = "";
        } else {

            $number = substr($number, -1);

            if ($number == 0) {
                $term = "";
            }
            if ($number == 1) {
                $term = "а";
            }
            if ($number > 1) {
                $term = "и";
            }
            if ($number > 4) {
                $term = "";
            }
        }

        echo ' годин' . $term;
    }

    public function getModulesTermination($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if ($number > 10 and $number < 15) {
            $term = "ів";
        } else {

            $number = substr($number, -1);

            if ($number == 0) {
                $term = "ів";
            }
            if ($number == 1) {
                $term = "ь";
            }
            if ($number > 1) {
                $term = "я";
            }
            if ($number > 4) {
                $term = "ів";
            }
        }

        echo ' модул' . $term;
    }

    public function findCourseIDByAlias($alias)
    {
        return $this->find('alias=:alias', array(':alias' == $alias))->course_ID;
    }

    protected function beforeSave()
    {
        if (!Avatar::saveCourseLogo($this, 'course'))
            return false;

        if ($this->start == '') $this->start = null;

        return true;
    }

    public static function getPrice($idCourse)
    {
        $modules = Yii::app()->db->createCommand("SELECT id_module FROM course_modules WHERE id_course =" . $idCourse
        )->queryAll();
        $summa = 0;
        for ($i = 0, $count = count($modules); $i < $count; $i++) {
            $summa += (integer)Module::model()->findByPk($modules[$i]["id_module"])->module_price;
        }
        return $summa;
    }

    public static function getCoursesByLevel($selector)
    {
        $criteria = Course::getCriteriaBySelector($selector);
        $dataProvider = new CActiveDataProvider('Course', array(
            'criteria' => $criteria,
            'pagination' => false,
        ));

        return $dataProvider;
    }

    public static function getCriteriaBySelector($selector)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'course';
        $criteria->order = 'rating DESC';
        $criteria->condition = 'language="ua" and cancelled="0"';
        if ($selector !== 'all') {
            if ($selector == 'junior') {
                $criteria->addInCondition('level', array('intern', 'strong junior', 'junior'));
            } else {
                $criteria->condition = 'level=:level and language="ua" and cancelled=0';
                $criteria->params = array(':level' => $selector);
            }
        }
        return $criteria;
    }

    public static function getCourseModulesSchema($idCourse)
    {
        $criteria = new CDbCriteria();
        $criteria->select = '*';
        $criteria->condition = 'id_course=' . $idCourse;
        $criteria->toArray();

        $modules = CourseModules::model()->findAll($criteria);

        $modules = CourseModules::sortByModuleDuration($idCourse, $modules);
        return $modules;
    }

    public static function getTableCells($modules, $idCourse)
    {
        $cells = [];
        for ($i = 0, $count = count($modules); $i < $count; $i++) {
            $cells[$i]['idModule'] = $modules[$i]['id_module'];
            $start = CourseModules::startMonth($idCourse, $modules[$i]['id_module']);
            $duration = CourseModules::getModuleDurationMonths($modules[$i]['id_module']);
            $end = $start + $duration;
            for ($j = 0; $j < $start; $j++) {
                $cells[$i][$j] = 0;
            }
            for ($k = $start; $k < $end; $k++) {
                if ($end - $k > 1) {
                    $cells[$i][$k] = Module::lessonsInMonth($modules[$i]['id_module']);
                } else {
                    $cells[$i][$k] = fmod(Module::getLessonsCount($modules[$i]['id_module']),
                        Module::lessonsInMonth($modules[$i]['id_module']));
                }
            }
        }
        return $cells;
    }

    public static function getCourseDuration($tableCells)
    {

        $count = count($tableCells);
        $arr = [];
        for ($i = 0; $i < $count; $i++) {
            $arr[$i] = count($tableCells[$i]) - 2;
        }

        return max($arr) + 1;
    }

    public static function getStatus($id)
    {
        return Course::model()->findByPk($id)->status;
    }

    public static function generateCoursesList()
    {
        $courses = Course::model()->findAll();
        $count = count($courses);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $courses[$i]->course_ID;
            $result[$i]['alias'] = Course::getCourseName($courses[$i]->course_ID);
            $result[$i]['language'] = Course::getCourseLang($courses[$i]->course_ID);
        }
        return $result;
    }

    public static function getCourseLang($id)
    {
        return Course::model()->findByPk($id)->language;
    }

    public static function getCourseTitlesList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID, title_ua';
        $criteria->distinct = true;
        $criteria->toArray();

        $result = '';
        $titles = Course::model()->findAll($criteria);
        for ($i = 0; $i < count($titles); $i++) {
            $result[$i][$titles[$i]['course_ID']] = $titles[$i]['title_ua'];
        }
        return $result;
    }

    public static function getCourseNumber($id)
    {
        return Course::model()->findByPk($id)->course_number;
    }

    public static function getCreditCoursePrice($idCourse, $years)
    {
        $modules = Yii::app()->db->createCommand("SELECT id_module FROM course_modules WHERE id_course =" . $idCourse
        )->queryAll();
        $summa = 0;
        for ($i = 0, $count = count($modules); $i < $count; $i++) {
            $summa += (integer)Module::model()->findByPk($modules[$i]["id_module"])->module_price;
        }
        $toPaySumma = $summa * pow((1 + 0.3), $years);
        return $toPaySumma;
    }

    public static function getCourseLevel($idCourse)
    {
        $level = Course::model()->findByPk($idCourse)->level;
        return CommonHelper::translateLevel($level);
    }

    public function getRate(){
        $rate = 0;
        switch ($this->level) {
            case 'intern':
                $rate = 1;
                break;
            case 'junior':
                $rate = 2;
                break;
            case 'strong junior':
                $rate = 3;
                break;
            case 'middle':
                $rate = 4;
                break;
            case 'senior':
                $rate = 5;
                break;
        }
        return $rate;
    }

    public static function translateLevelUa($course)
    {
        $level = Course::model()->findByPk($course)->level;
        return CommonHelper::translateLevelUa($level);
    }

    public function getTranslatedLevel(){
        return CommonHelper::translateLevel($this->level);
    }

    public function getTitle(){
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $this->$title;
    }

    public static function getCourseName($idCourse)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $courseTitle = Course::model()->findByPk($idCourse)->$title;
        return $courseTitle;
    }

    public static function getLessonsCount($id)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'course_modules';
        $criteria->addCondition('id_course=' . $id);
        $modules = CourseModules::model()->findAll($criteria);
        $modulesId = [];
        foreach ($modules as $module) {
            array_push($modulesId, $module->id_module);
        }

        $criteria2 = new CDbCriteria;
        $criteria2->alias = 'module';
        $criteria2->addInCondition('module_ID', $modulesId, 'OR');
        $modulesInfo = Module::model()->findAll($criteria2);
        $lessonsCount = 0;
        foreach ($modulesInfo as $modul) {
            $lessonsCount = $lessonsCount + $modul->lesson_count;
        }

        return $lessonsCount;
    }

    public static function getMessage($message = null, $type = null)
    {
        if ($message !== null) {
            switch ($type) {
                case 'months' :
                    return $message[0];
                case 'module' :
                    return $message[1];
                case 'trainee' :
                    return $message[2];
                case 'chart' :
                    return $message[3];
                case 'save' :
                    return $message[4];
            }
        } else {
            switch ($type) {
                case 'months' :
                    return Yii::t('course', '0667');
                case 'module' :
                    return Yii::t('course', '0668');
                case 'trainee' :
                    return Yii::t('course', '0669');
                case 'chart' :
                    return Yii::t('course', '0670');
                case 'save' :
                    return Yii::t('course', '0671');
                case 'exam' :
                    return Yii::t('course', '0673');
            }
        }
    }

    public static function printTitle($idCourse, $messages = null)
    {
        $chartSchema = Course::getMessage($messages, 'chart');
        return $chartSchema . ' ' . Course::getCourseName($idCourse) . ", " . Course::getCourseLevel($idCourse);
    }

    public static function generateModuleCoursesList($idModule, $messages = null)
    {
        $result = [];
        if ($messages !== null) {
            return $result;
        }

        $courses = CourseModules::model()->findAllByAttributes(array('id_module' => $idModule));
        $count = count($courses);
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $courses[$i]->id_course;
            $result[$i]['alias'] = Course::getCourseName($courses[$i]->id_course);
            $result[$i]['language'] = Course::getCourseLang($courses[$i]->id_course);
            $result[$i]['mandatory'] = $courses[$i]->mandatory_modules;
            $result[$i]['price'] = $courses[$i]->price_in_course;
        }
        return $result;
    }

    public static function getSummaBySchemaNum($courseId, $summaNum, $isWhole = false)
    {
        switch ($summaNum) {
            case '1':
                $summa = Course::getSummaWholeCourse($courseId);
                break;
            case '2':
                $summa = Course::getSummaCourseTwoPays($courseId, $isWhole);
                break;
            case '3':
                $summa = Course::getSummaCourseFourPays($courseId, $isWhole);
                break;
            case '4':
                $summa = Course::getSummaCourseMonthly($courseId, $isWhole);
                break;
            case '5':
                $summa = Course::getSummaCourseCreditTwoYears($courseId, $isWhole);
                break;
            case '6':
                $summa = Course::getSummaCourseCreditThreeYears($courseId, $isWhole);
                break;
            case '7':
                $summa = Course::getSummaCourseCreditFourYears($courseId, $isWhole);
                break;
            case '8':
                $summa = Course::getSummaCourseCreditFiveYears($courseId, $isWhole);
                break;
            default :
                throw new CHttpException(400, 'Неправильно вибрана схема оплати!');
                break;
        }
        return $summa;
    }

    //discount 30 percent - first pay schema
    public static function getSummaWholeCourse($idCourse)
    {
        return round(Course::getPrice($idCourse));
    }

    //discount 10 percent - second pay schema
    public static function getSummaCourseTwoPays($idCourse, $isWhole)
    {
        $discountedSumma = Course::getPrice($idCourse) * 0.9;
        if ($isWhole) {
            return $discountedSumma;
        }
        $toPay = round($discountedSumma / 2);
        return $toPay;
    }

    //discount 8 percent - third pay schema
    public static function getSummaCourseFourPays($idCourse, $isWhole)
    {
        $discountedSumma = Course::getPrice($idCourse) * 0.92;
        if ($isWhole) {
            return $discountedSumma;
        }
        $toPay = round($discountedSumma / 4);
        return $toPay;
    }

    //monthly - forth pay schema
    public static function getSummaCourseMonthly($idCourse, $isWhole)
    {
        $wholePrice = Course::getPrice($idCourse);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 12);
        return $toPay;
    }

    //credit two years - fifth pay schema
    public static function getSummaCourseCreditTwoYears($idCourse, $isWhole)
    {
        $wholePrice = Course::getCreditCoursePrice($idCourse, 2);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 24);
        return $toPay;
    }

    //credit three years - sixth pay schema
    public static function getSummaCourseCreditThreeYears($idCourse, $isWhole)
    {
        $wholePrice = Course::getCreditCoursePrice($idCourse, 3);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 36);
        return $toPay;
    }

    //credit four years - seventh pay schema
    public static function getSummaCourseCreditFourYears($idCourse, $isWhole)
    {
        $wholePrice = Course::getCreditCoursePrice($idCourse, 4);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 48);
        return $toPay;
    }

    //credit five years - eight pay schema
    public static function getSummaCourseCreditFiveYears($idCourse, $isWhole)
    {
        $wholePrice = Course::getCreditCoursePrice($idCourse, 5);
        if ($isWhole) {
            return $wholePrice;
        }
        $toPay = round($wholePrice / 60);
        return $toPay;
    }

    public static function getMainCoursePrice($price, $discount = 0)
    {
        if ($price == 0) {
            return '<span class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        if ($discount == 0) {
            return '<span id="coursePriceStatus2">' . $price . " " . Yii::t('courses', '0322') . '</span>';
        }
        return '<span id="coursePriceStatus1">' . $price . " " . Yii::t('courses', '0322') . '</span>&nbsp<span id="coursePriceStatus2">' . PaymentHelper::discountedPrice($price, $discount) . " " . Yii::t('courses', '0322') . '</span><span id="discount"> (' . Yii::t('courses', '0144') . ' - ' . $discount . '%)</span>';
    }

    public static function juniorCoursesCount(){
        return count(Course::model()->findAllByAttributes(array(
            'level' => array('junior', 'strong junior', 'intern'),
            'language' => 'ua',
            'cancelled' => 0)
        ));
    }

    public static function middleCoursesCount(){
        return Course::model()->count('level=:level and language=:lang and cancelled=0',
            array(':level' => 'middle', ':lang' => 'ua')
        );
    }

    public static function seniorCoursesCount(){
        return Course::model()->count('level=:level and language=:lang and cancelled=0',
            array(':level' => 'senior', ':lang' => 'ua')
        );
    }
}
