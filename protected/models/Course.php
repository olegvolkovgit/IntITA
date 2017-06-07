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
 * @property integer $status_online
 * @property integer $status_offline
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
 * @property integer $level
 * @property integer $cancelled
 * @property integer $course_number
 * @property integer $id_organization
 * 
 * The followings are the available model relations:
 * @property CourseModules $module
 * @property Level $level0
 * @property CourseService $courseServiceOffline
 * @property CourseService $courseServiceOnline
 * @property Organization $organization
 */
class Course extends CActiveRecord implements IBillableObject, IServiceableWithEducationForm {

    use withToArray;

    const MAX_LEVEL = 5;
    const AVAILABLE = 0;
    const DELETED = 1;
    const READY = 1;
    const DEVELOP = 0;
    const ALL_ORGANIZATION = 0;
    const OUR_ORGANISATION = 1;
    const OTHER_ORGANISATION = 2;
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
            array('language, title_ua, title_ru, title_en, alias, id_organization', 'required', 'message' => Yii::t('coursemanage', '0387')),
            array('cancelled, course_number', 'numerical', 'integerOnly' => true,
                'min' => 0, "tooSmall" => Yii::t('coursemanage', '0388'), 'message' => Yii::t('coursemanage', '0388')),
            array('alias', 'match', 'pattern' => "/^[a-zA-Z0-9_]+$/u", 'message' => 'Допустимі символи: латинські літери, цифри та знак "_"'),
            array('alias', 'length', 'max' => 20),
            array('alias, course_number', 'unique', 'message' => Yii::t('course', '0740')),
            array('language', 'length', 'max' => 6),
            array('title_ua, title_ru, title_en', 'length', 'max' => 100),
            array('title_ua', 'match', 'pattern' => "/".Yii::app()->params['titleUAPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_ru', 'match', 'pattern' => "/".Yii::app()->params['titleRUPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_en', 'match', 'pattern' => "/".Yii::app()->params['titleENPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('course_img', 'length', 'max' => 255),
            array('course_img', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            array('start', 'date', 'format' => 'yyyy-MM-dd', 'message' => Yii::t('coursemanage', '0389')),
            array('for_whom_ua, what_you_learn_ua, what_you_get_ua, for_whom_ru, what_you_learn_ru, what_you_get_ru,
			for_whom_en, what_you_learn_en, what_you_get_en, level, start, status_online, status_offline, review, rating, id_organization', 'safe'),
            // The following rule is used by search().
            array('course_ID,alias, language, title_ua, title_ru, title_en, 
            status_online, status_offline, for_whom_ua, what_you_learn_ua,what_you_get_ua,
			 for_whom_ru, what_you_learn_ru, what_you_get_ru, for_whom_en, what_you_learn_en, what_you_get_en,
			 course_img, cancelled, course_number', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'module' => array(self::MANY_MANY, 'CourseModules', 'course_modules(id_course, id_course)', 'order' => 'module.order ASC','with' => 'moduleInCourse'),
            'level0' => array(self::BELONGS_TO, 'Level', 'level'),
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),

            'courseServiceOffline' => [self::HAS_ONE, 'CourseService', 'course_id', 'on' => 'courseServiceOffline.education_form='.EducationForm::OFFLINE],
            'corporateEntityServicesOffline' => [
                self::HAS_MANY,
                'CorporateEntityService',
                ['service_id' => 'serviceId'],
                'through' => 'courseServiceOffline',
                'on' => 'corporateEntityServicesOffline.deletedAt IS NULL OR corporateEntityServicesOffline.deletedAt > NOW()'],
            'corporateEntityOffline' => [self::HAS_ONE, 'CorporateEntity', ['corporateEntityId' => 'id'], 'through' => 'corporateEntityServicesOffline'],
            'checkingAccountOffline' => [self::HAS_ONE, 'CheckingAccounts', ['checkingAccountId' => 'id'], 'through' => 'corporateEntityServicesOffline'],

            'courseServiceOnline' => [self::HAS_ONE, 'CourseService', 'course_id', 'on' => 'courseServiceOnline.education_form='.EducationForm::ONLINE],
            'corporateEntityServicesOnline' => [
                self::HAS_MANY,
                'CorporateEntityService',
                ['service_id' => 'serviceId'],
                'through' => 'courseServiceOnline',
                'on' => 'corporateEntityServicesOnline.deletedAt IS NULL OR corporateEntityServicesOnline.deletedAt > NOW()'],
            'corporateEntityOnline' => [self::HAS_ONE, 'CorporateEntity', ['corporateEntityId' => 'id'], 'through' => 'corporateEntityServicesOnline'],
            'checkingAccountOnline' => [self::HAS_ONE, 'CheckingAccounts', ['checkingAccountId' => 'id'], 'through' => 'corporateEntityServicesOnline'],
        );
    }

    protected function beforeValidate()
    {
        if($this->isNewRecord){
            $this->id_organization=Yii::app()->user->model->getCurrentOrganization()->id;
        }

        return parent::beforeValidate();
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
            'status_online' => Yii::t('course', '0411'),  // ++
            'status_offline' => Yii::t('course', '0943'),  // ++
            'cancelled' => Yii::t('course', '0741'),
            'course_number' => Yii::t('course', '0742'),  // ++
            'id_organization' => 'Id організації',
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
        $criteria->compare('status_online', $this->status_online, true);
        $criteria->compare('status_offline', $this->status_offline, true);
        $criteria->compare('course_number', $this->course_number);
        $criteria->compare('id_organization', $this->id_organization);

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
        foreach ($this->module as $module) {
            $price += $module->moduleInCourse->module_price;
        }
        return $price*Config::getCoeffDependentModule();
    }

    public function getDuration()
    {
        return $this->getApproximatelyDurationInMonths();
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

    public static function getCoursesByLevel($criteria)
    {
        $dataProvider = new CActiveDataProvider('Course', array(
            'criteria' => $criteria,
            'pagination' => false,
        ));

        return $dataProvider;
    }

    public static function getCriteriaBySelector($selector, $organization)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'course';
        $criteria->order = 'rating DESC';
        $criteria->condition = 'cancelled='.Course::AVAILABLE;

        if($organization == 'ourcourses' || $organization == 'partnerscourses' || $organization == 'allcourses'){

            if($organization == 'ourcourses'){
                $criteria->addColumnCondition(array('id_organization'=>1));
            }elseif($organization == 'partnerscourses'){
                $criteria->addColumnCondition(array('id_organization'=>2));
            }

            if ($selector !== 'all') {
                switch ($selector) {
                    case 'junior':
                        $criteria->addInCondition('level', array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR));
                        break;
                    case 'middle':
                        $criteria->addCondition('level='.Level::MIDDLE, 'AND');
                        break;
                    case 'senior':
                        $criteria->addCondition('level='.Level::SENIOR, 'AND');
                        break;
                    default:
                        break;
                }
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
        if ($arr)
            return max($arr) + 1;
        else return 0;
    }

    public function getNumber()
    {
        return $this->course_ID;
    }

    public function getType()
    {
        return 'K';
    }

    public static function getStatus_online($id)
    {
        return Course::model()->findByPk($id)->status_online;
    }

    public static function getStatus_offline($id)
    {
        return Course::model()->findByPk($id)->status_offline;
    }

    public static function generateCoursesList()
    {
        $courses = Course::model()->findAll();

        $i = 0;
        $result = [];
        foreach ($courses as $course) {
            $result[$i]['id'] = $course->course_ID;
            $result[$i]['alias'] = $course->getTitle();
            $result[$i]['language'] = $course->language;
            $i++;
        }
        return $result;
    }

    public static function getCourseTitlesList()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID, title_ua, language';
        $criteria->distinct = true;
        $criteria->toArray();

        $result = '';
        $titles = Course::model()->findAll($criteria);
        for ($i = 0; $i < count($titles); $i++) {
            $result[$i][$titles[$i]['course_ID']] = $titles[$i]['title_ua'] . " (" . $titles[$i]['language'] . ")";
        }
        return $result;
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

    public function level()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        if($lang) {
            $title = "title_" . $lang;
        } else {
            $title = "title_ua";
        }
        return $this->level0->$title;
    }

    public function getRate()
    {
        return $this->level0->id;
    }

    public function getTranslatedLevel()
    {
        return $this->level();
    }

    public function getTitle()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return CHtml::encode($this->$title);
    }

    public static function getCourseName($idCourse)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $courseTitle = Course::model()->findByPk($idCourse)->$title;
        return CHtml::encode($courseTitle);
    }
    public static function getCourseTitleForBreadcrumbs($idCourse)
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
        foreach ($modulesInfo as $module) {
            $lessonsCount = $lessonsCount + $module->getLecturesCount();
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
        $course = Course::model()->findByPk($idCourse);
        $chartSchema = Course::getMessage($messages, 'chart');
        return $chartSchema . ' ' . $course->getTitle() . ", " . $course->level();
    }

    public static function generateModuleCoursesList($idModule, $messages = null)
    {
        $result = [];
        if ($messages !== null) {
            return $result;
        }

        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN course_modules cm ON course_ID = cm.id_course';
        $criteria->addCondition('cm.id_module = ' . $idModule);

        $courses = Course::model()->findAll($criteria);
        return $courses;
    }

    public static function selectCoursesCount($arr, $organisation)
    {
        if($organisation == Course::OUR_ORGANISATION){
            $condition = 'id_organization='.$organisation;
        }elseif($organisation == Course::OTHER_ORGANISATION ){
            $condition = 'id_organization!='.Course::OUR_ORGANISATION;
        }elseif($organisation == Course::ALL_ORGANIZATION){
            $condition = 'id_organization';
        }

        if(!is_array($arr) && $arr != NULL){
            $arr = array(0 => $arr);
        }

        if(isset($arr)){
            $criteria=new CDbCriteria;
            $criteria->condition = $condition;
            $criteria->addInCondition('level', $arr);
            $criteria->addCondition('cancelled='.Course::AVAILABLE);
            $courses = Course::model()->findAll( $criteria );
        }else{
            $courses = Course::model()->findAllByAttributes(array('cancelled'=>Course::AVAILABLE));
        }

        $coursesLangs = CourseLanguages::model()->findAll();
        $langs = array('ua', 'ru', 'en');
        $duplicate=0;

        foreach($coursesLangs as $langsRecord){
            $linkedCourses=0;
            for($i=0; $i < 3; $i++) {
                if ($langsRecord['lang_'.$langs[$i]] != 0) {
                    foreach ($courses as $key=>$course) {
                        if ($langsRecord['lang_'.$langs[$i]] == $course["course_ID"]) {
                            $linkedCourses++;
                        }
                    }
                }
            }
            if($linkedCourses>0){
                $duplicate=$duplicate+$linkedCourses-1;
            }
        }
        return count($courses)-$duplicate;
    }

//    public static function selectModulesCount()
//    {
//        $criteria = new CDbCriteria();
//        $criteria->condition = 'cancelled='.Module::ACTIVE.' and (status_online='.Module::READY.' or status_offline='.Module::READY.')';
//        $modules = Module::model()->findAll($criteria);
//        return count($modules);
//    }

    public function modulesCount()
    {
        return count(Yii::app()->db->createCommand("SELECT DISTINCT id_module FROM course_modules WHERE id_course =" . $this->course_ID
        )->queryAll());
    }

    public function mandatoryModule($id){
        return CourseModules::model()->findByAttributes(array(
                'id_course' => $this->course_ID,
                'id_module' => $id
            )
        )->mandatory_modules;
    }

    public function cancelledTitle()
    {
        if ($this->cancelled == 0) return 'доступний';
        if ($this->cancelled == 1) return 'видалений';
        else return false;
    }

    public function getModuleCount() {
        return count($this->module);
    }

    /**
     * Deletes specified module from course and update modules count in course.
     * @param $idModule
     * @throws Exception
     */
    public function disableModule($idModule) {

        $order = $this->getModuleOrderInCourse($this->course_ID, $idModule);
        if ($order == null) {
            // Now this method is called from a course instance,
            // so $order can be null only if specified module is absent in the course.
            throw new \application\components\Exceptions\ModuleNotFoundException();
        }

        $sqlDeleteRecord = "DELETE FROM course_modules WHERE id_course = $this->course_ID AND id_module = $idModule";
        $sqlUpdateOrder = "UPDATE `course_modules` SET `order`=`order`-1 WHERE `id_course` = $this->course_ID AND `order` > $order";

        $connection = Yii::app()->db;
        $transaction=$connection->beginTransaction();
        try
        {
            $rowAffected = $connection->createCommand($sqlDeleteRecord)->execute();
            if ($rowAffected == 0) {
                throw new \application\components\Exceptions\ModuleDelitingException;
            }
            $connection->createCommand($sqlUpdateOrder)->execute();
            $transaction->commit();
        }
        catch(Exception $e)
        {
            $transaction->rollback();
            throw $e;
        }
    }

    public static function coursesList(){
        $courses = Course::model()->findAll();
        $return = array('data' => array());

        foreach ($courses as $record) {
            $row = array();

            $row["id"] = $record->course_ID;
            $row["alias"] = $record->alias;
            $row["lang"] = $record->language;
            $row["title"]["name"] = $record->title_ua.", ".$record->language;
            $row["title"]["header"] = "'Курс ".CHtml::encode($record->title_ua)."'";
            $row["status"] = $record->statusLabel();
            $row["cancelled"] = $record->cancelledLabel();
            $row["level"] = $record->level0->title_ua;
            $row["title"]["id"] = $record->course_ID;;
            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public function onlineStatusLabel(){
        return ($this->isReadyOnline())?'готовий':'в розробці';
    }
    public function offlineStatusLabel(){
        return ($this->isReadyOffline())?'готовий':'в розробці';
    }

    public function cancelledLabel(){
        return ($this->isActive())?'доступний':'видалений';
    }

    public static function modulesInCourse($idCourse)
    {
        $modules= Yii::app()->db->createCommand()
            ->select('id_module')
            ->from('course_modules cm')
            ->join('module m', 'm.module_ID=cm.id_module')
            ->where('cm.id_course=:id and cm.`order`>0 and m.cancelled=0', array(':id' => $idCourse))
            ->order('order ASC')
            ->queryAll();
        return $modules;
    }

    public static function modulesIdInCourse($idCourse)
    {
        $moduleList=Course::model()->modulesInCourse($idCourse);
        $list=array();
        foreach ($moduleList as $item) {
            array_push($list,$item["id_module"]);
        }
        return $list;
    }

    /**
     * Shifts up specified module;
     * @param $idModule
     * @throws Exception
     */
    public function upModule($idModule) {

        $connection = Yii::app()->db;
        $sqlSelectData = "SELECT `id_course`, `id_module`, `order` FROM `course_modules` WHERE `id_course`=".$this->course_ID." ORDER BY `order` ASC";
        $result = $connection->createCommand($sqlSelectData)->queryAll();
        $length = count($result);
        for ($i = 0; $i<$length; $i++) {
            if ($result[$i]['id_module']==$idModule) {
                if ($i > 0) {
                    $sqlDownPrevModule = "UPDATE `course_modules` SET `order` = ".$result[$i-1]['order']." WHERE id_course = $this->course_ID AND `id_module` = ".$result[$i]['id_module'];
                    $sqlUpModule = "UPDATE `course_modules` SET `order` = ".$result[$i]['order']." WHERE id_course = $this->course_ID AND `id_module` = ".$result[$i-1]['id_module'];
                    $transaction = $connection->beginTransaction();
                    try
                    {
                        $connection->createCommand($sqlDownPrevModule)->execute();
                        $connection->createCommand($sqlUpModule)->execute();
                        $transaction->commit();
                    }
                    catch(Exception $e)
                    {
                        $transaction->rollback();
                        throw $e;
                    }
                }
                return;
            }
        }
    }

    /**
     * Shifts down specified module;
     * @param $idModule
     * @throws Exception
     */
    public function downModule($idModule) {

        $connection = Yii::app()->db;
        $sqlSelectData = "SELECT `id_course`, `id_module`, `order` FROM `course_modules` WHERE `id_course`=".$this->course_ID." ORDER BY `order` ASC";
        $result = $connection->createCommand($sqlSelectData)->queryAll();
        $length = count($result);
        for ($i = 0; $i<$length; $i++) {
            if ($result[$i]['id_module']==$idModule) {
                if ($i < $length-1) {
                    $sqlUpNextModule = "UPDATE `course_modules` SET `order` = ".$result[$i]['order']." WHERE id_course = $this->course_ID AND `id_module` = ".$result[$i+1]['id_module'];
                    $sqlDownModule = "UPDATE `course_modules` SET `order` = ".$result[$i+1]['order']." WHERE id_course = $this->course_ID AND `id_module` = ".$result[$i]['id_module'];
                    $transaction = $connection->beginTransaction();
                    try
                    {
                        $connection->createCommand($sqlUpNextModule)->execute();
                        $connection->createCommand($sqlDownModule)->execute();
                        $transaction->commit();
                    }
                    catch(Exception $e)
                    {
                        $transaction->rollback();
                        throw $e;
                    }
                }
                return;
            }
        }
        
    }

    /**
     * Returns the order of module in course
     * @param $idCourse
     * @param $idModule
     * @return int - module's order in course
     * @return null if such course+module wasn't found
     */
    public function getModuleOrderInCourse($idCourse, $idModule) {
        $criteria = new CDbCriteria();
        $criteria->select = '`order`';
        $criteria->condition = '`id_course`='.$idCourse.' AND `id_module` ='.$idModule;
        return CourseModules::model()->find($criteria)->order;
    }

    public function isActive(){
        return $this->cancelled == Course::AVAILABLE;
    }

    public function isDeleted(){
        return $this->cancelled == Course::DELETED;
    }

    public function isReadyOnline(){
        return $this->status_online == Course::READY;
    }
    public function isReadyOffline(){
        return $this->status_offline == Course::READY;
    }
    public function isDeveloping(){
        return ($this->status_online == Course::DEVELOP && $this->status_offline == Course::DEVELOP);
    }

    public function changeStatus(){
        if ($this->isActive()){
            return $this->setDeleted();
        } else {
            return $this->setActive();
        }
    }

    public function setActive(){
        $this->cancelled = Course::AVAILABLE;
        return $this->update(array("cancelled"));
    }

    public function setDeleted(){
        $this->cancelled = Course::DELETED;
        return $this->update(array("cancelled"));
    }

    public function paymentMailTemplate(){
        return '_payCourseMail';
    }

    public function paymentMailTheme(){
        return 'Доступ до курсу';
    }

    public static function readyCoursesList($query, $organization){
        $criteria = new CDbCriteria();
        $criteria->select = "course_ID, title_ua, title_ru, title_en, language";
        $criteria->alias = "s";
        $criteria->addSearchCondition('title_ua', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_ru', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_en', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('course_ID', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('alias', $query, true, "OR", "LIKE");
        $criteria->addCondition('s.cancelled=0');
        if($organization) $criteria->addCondition('s.id_organization='.$organization);
        
        $data = Course::model()->findAll($criteria);

        $result = array();
        $lang =(Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $titleParam = "title_".$lang;
        foreach ($data as $key=>$record) {
            $result["results"][$key]["id"] = $record->course_ID;
            $result["results"][$key]["title"] = $record->$titleParam." (".$record->language.")";
        }

        return json_encode($result);
    }

    /**
     * Returns linked courses in other languages (ua, ru, en) though table course_languages.
     */
    public function linkedCourses(){
        return CourseLanguages::model()->findByAttributes(array('lang_'.$this->language => $this->course_ID));
    }

    public function isContain(Module $module){
        return CourseModules::model()->exists('id_course=:course and id_module=:module', array(
            'course' => $this->course_ID,
            'module' => $module->module_ID
            )
        );
    }
    public function getEncodeAlias(){
        return CHtml::encode($this->alias);
    }

    /**
     * Return array of course's blocks organized by linked languages (for courses page).
     * @param $selector string course's level ID
     * @return array
     */
    public static function getCoursesByLang($selector, $organization){
        $criteria = Course::getCriteriaBySelector($selector, $organization);

//        var_dump($criteria);die;

        $courses = Course::model()->findAll($criteria);

        $result = [];
        $langs = array('ua', 'ru', 'en');
        $coursesLangs = CourseLanguages::model()->findAll();
        foreach($coursesLangs as $langsRecord){
            $row = [];
            //for each language find course model
            for($i=0; $i < 3; $i++) {
                if ($langsRecord['lang_'.$langs[$i]] != 0) {
                    foreach ($courses as $key=>$course) {
                        if ($langsRecord['lang_'.$langs[$i]] == $course["course_ID"]) {
                            array_push($row, $course);
                            unset($courses[$key]);
                        }
                    }
                }
            }
            if(!empty($row)) {
                array_push($result, $row);
            }
        }

        function notNullToArray($value)
        {
            if($value != null)
            return array($value);
        }

        $courses = array_map("notNullToArray", $courses);

        return array_merge($result, $courses);
    }

    public static function countersBySelectors($organization){
        $result = [];
        if($organization == 'ourcourses'){
            $result["junior"] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR), Course::OUR_ORGANISATION);
            $result["middle"] = Course::selectCoursesCount(Level::MIDDLE, Course::OUR_ORGANISATION);
            $result["senior"] = Course::selectCoursesCount(Level::SENIOR, Course::OUR_ORGANISATION);
            $result["total"] = Course::selectCoursesCount(null, Course::OUR_ORGANISATION);
            $result["modules"] = Module::selectModulesCount(null);

            if(!isset($result['our'])){
                $result['our'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OUR_ORGANISATION);
            }

            if(!isset($result['partner'])){
                $result['partner'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OTHER_ORGANISATION);
            }
        }elseif($organization == 'partnerscourses'){
            $result["junior"] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR), Course::OTHER_ORGANISATION);
            $result["middle"] = Course::selectCoursesCount(Level::MIDDLE, Course::OTHER_ORGANISATION);
            $result["senior"] = Course::selectCoursesCount(Level::SENIOR, Course::OTHER_ORGANISATION);
            $result["total"] = Course::selectCoursesCount(null, Course::OTHER_ORGANISATION);
            $result["modules"] = Module::selectModulesCount(null);

            if(!isset($result['our'])){
                $result['our'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OUR_ORGANISATION);
            }

            if(!isset($result['partner'])){
                $result['partner'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OTHER_ORGANISATION);
            }
        }elseif($organization == 'allcourses'){
            $result["junior"] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR), Course::ALL_ORGANIZATION);
            $result["middle"] = Course::selectCoursesCount(Level::MIDDLE, Course::ALL_ORGANIZATION);
            $result["senior"] = Course::selectCoursesCount(Level::SENIOR, Course::ALL_ORGANIZATION);
            $result["total"] = Course::selectCoursesCount(null, Course::OTHER_ORGANISATION);
            $result["modules"] = Module::selectModulesCount(null);
//var_dump($result['our']);die;
            if(!isset($result['our'])){
                $result['our'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OUR_ORGANISATION);
            }

            if(!isset($result['partner'])){
                $result['partner'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OTHER_ORGANISATION);
            }
        }elseif($organization == 'modules'){
            $result["junior"] = Module::selectModulesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR));
            $result["middle"] = Module::selectModulesCount(array(Level::MIDDLE));
            $result["senior"] = Module::selectModulesCount(array(Level::SENIOR));
            $result["total"] = Course::selectCoursesCount(null, Course::OUR_ORGANISATION);
            $result["modules"] = Module::selectModulesCount(null);

            if(!isset($result['our'])){
                $result['our'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OUR_ORGANISATION);
            }
            if(!isset($result['partner'])){
                $result['partner'] = Course::selectCoursesCount(array(Level::INTERN, Level::JUNIOR, Level::STRONG_JUNIOR,
                    Level::MIDDLE, Level::SENIOR), Course::OTHER_ORGANISATION);
            }
        }

        return $result;
    }

    public static function coursesByQueryAndLang($query, $lang, $currentCourseLang){
        $criteria = new CDbCriteria();
        $criteria->alias = 'c';
        $criteria->select = "course_ID, title_ua, title_ru, title_en, language";
        $criteria->addSearchCondition('title_ua', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_ru', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_en', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('course_ID', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('alias', $query, true, "OR", "LIKE");
        $criteria->join = ' left join course_languages cl on cl.lang_'.$lang.'=c.course_ID';
        $criteria->addCondition('cl.lang_'.$currentCourseLang.' IS NULL and cancelled=0 and language LIKE "'.$lang.'" 
        and c.id_organization='.Yii::app()->user->model->getCurrentOrganization()->id);

        $data = Course::model()->findAll($criteria);
        $result = array();
        $langParam =(Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $titleParam = "title_".$langParam;

        foreach ($data as $key=>$record) {
            $result["results"][$key]["id"] = $record->course_ID;
            $result["results"][$key]["title"] = $record->$titleParam." (".$record->language.")";
        }

        return json_encode($result);
    }

    public function priceOffline(){
        return round($this->getBasePrice() * Config::getCoeffModuleOffline());
    }

    public function getPropertyLabel($param){
        //remove language from item label
        return substr(Course::model()->attributeLabels()[$param], 0, -5);
    }

    public function courseDurationInDays(){
        $sum=0;
        foreach($this->module as $module){
            $sum=+$sum+$module->moduleInCourse->moduleDurationInDays();
        }
        return round($sum);
    }

    public function getApproximatelyDurationInMonths(){
        return ceil($this->courseDurationInDays() / 30);
    }

    public function getModelUAH(){
        return new CourseUAH($this);
    }

    /**
     * @param EducationForm $educationForm
     * @return Service
     * @throws Exception
     */
    public function getService(EducationForm $educationForm) {
        return CourseService::model()->getService($this->course_ID, $educationForm)->service;
    }

    /**
     * Function check user's access to course based on user's payments
     * @param $userId
     * @return bool
     */
    public function checkPaidAccess($userId) {

        $access = false;
        $studentReg = StudentReg::model()->findByPk($userId);
        $access = $studentReg->access->checkVisitorAccess($this->courseServiceOffline);

        if (!$access) {
            $access = $studentReg->access->checkVisitorAccess($this->courseServiceOnline);
        }
        if (!$access) {
            foreach ($studentReg->offlineGroups as $group) {
                $access = $group->access->checkVisitorAccess($this->courseServiceOffline);
                if (!$access) {
                    $access = $group->access->checkVisitorAccess($this->courseServiceOnline);
                }
                if ($access) {
                    break;
                }
            }
        }
        return $access;
    }

    public function hasPromotionSchemes()
    {
        $service=CourseService::model()->getService($this->course_ID, EducationForm::model()->findByPk(1));
        $criteria = new CDbCriteria;
        $criteria->condition = 'courseId='.$this->course_ID.' or (serviceType=1 and id_organization='.$service->courseModel->id_organization.')';
        $criteria->addCondition('((showDate IS NOT NULL && NOW()>=showDate && endDate IS NOT NULL && NOW()<=endDate) or 
            (showDate IS NULL && endDate IS NULL) or (showDate IS NOT NULL && NOW()>=showDate && endDate IS NULL))');
        $promotions=PromotionPaymentScheme::model()->findAll($criteria);

        return $promotions?true:false;
    }
}
