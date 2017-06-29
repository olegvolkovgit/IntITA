<?php

const EDITOR_ENABLED = 1;
const EDITOR_DISABLED = 0;

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
 * @property string $module_price
 * @property string $for_whom
 * @property string $what_you_learn
 * @property string $what_you_get
 * @property string $module_img
 * @property integer $hours_in_day
 * @property integer $days_in_week
 * @property integer $level
 * @property integer $understand_rating
 * @property integer $interesting_rating
 * @property integer $accessibility_rating
 * @property integer $module_number
 * @property integer $cancelled
 * @property integer $status_online
 * @property integer $status_offline
 * @property integer $id_organization
 * @property integer $id_module_revision
 *
 * The followings are the available model relations:
 * @property Course[] $Course
 * @property CourseModules $inCourses
 * @property Level $level0
 * @property Lecture[] $lectures
 * @property Teacher $teacher
 * @property ModuleService $moduleServiceOnline
 * @property ModuleService $moduleServiceOffline
 * @property ModuleTags $moduleTags
 * @property Tags[] $tags
 * @property Organization $organization
 */

class Module extends CActiveRecord implements IBillableObject, IServiceableWithEducationForm {

    use withToArray;

    public $logo = array();
    public $oldLogo;
    const READY = 1;
    const DEVELOP = 0;
    const ACTIVE = 0;
    const DELETED = 1;

    public $errorMessage;
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
            array('language, title_ua, level, id_organization', 'required', 'message' => 'Поле не може бути пустим'),
            array('alias', 'unique', 'message' => 'Псевдонім модуля повинен бути унікальним. Такий псевдонім модуля вже існує.'),
            array('alias', 'match', 'pattern' => "/^((?:[\d]*[^\d]+[\d]*)+$)/u", 'message' => 'Псевдонім не може містити тільки цифри'),
            array('alias', 'match', 'pattern' => "/^[a-zA-Z0-9_]+$/u", 'message' => 'Допустимі символи: латинські літери, цифри та знак "_"'),
            array('module_number, cancelled, level, module_price', 'numerical', 'integerOnly' => true, 'min' => 0, 'message' => Yii::t('module', '0413'), 'tooSmall' => 'Значення має бути цілим, невід\'ємним'),
            array('hours_in_day', 'numerical', 'integerOnly' => true, 'min'=>0,'max'=>24, 'message' => Yii::t('module', '0413'),'tooSmall' => 'Значення має бути цілим, невід\'ємним', 'tooBig'=>'Занадто велике число'),
            array('days_in_week', 'numerical', 'integerOnly' => true, 'min'=>0,'max'=>7, 'message' => Yii::t('module', '0413'),'tooSmall' => 'Значення має бути цілим, невід\'ємним', 'tooBig'=>'Занадто велике число'),
            array('module_price', 'length', 'max' => 10, 'message' => 'Ціна модуля занадто велика.'),
            array('module_number', 'unique', 'message' => 'Номер модуля повинен бути унікальним. Такий номер модуля вже існує.'),
            array('alias', 'length', 'max' => 30, 'message' => 'Довжина псевдоніма занадто велика.'),
            array('language', 'length', 'max' => 6),
            array('title_ua', 'match', 'pattern' => "/".Yii::app()->params['titleUAPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_ru', 'match', 'pattern' => "/".Yii::app()->params['titleRUPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('title_en', 'match', 'pattern' => "/".Yii::app()->params['titleENPattern']."+$/u", 'message' => Yii::t('error', '0416')),
            array('module_img, title_ua, title_ru, title_en', 'length', 'max' => 255),
            array('module_img', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            array('for_whom, what_you_learn, what_you_get, days_in_week, hours_in_day, level,days_in_week, hours_in_day, level, status_online, status_offline, understand_rating, interesting_rating, accessibility_rating', 'safe'),
            array('title_ua, title_ru, title_en, level,hours_in_day, days_in_week', 'required', 'message' => Yii::t('module', '0412'), 'on' => 'canedit'),
            array('hours_in_day, days_in_week', 'numerical', 'integerOnly' => true, 'min' => 1, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
            array('module_price', 'numerical', 'integerOnly' => true, 'min' => 0, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
            // The following rule is used by search().
            array('module_ID, title_ua, title_ru, title_en, alias, language, module_price, for_whom,
            what_you_learn, what_you_get, module_img,
			days_in_week, hours_in_day, level, module_number, cancelled, id_module_revision, status_online, status_offline', 'safe', 'on' => 'search'),
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
            'Course' => array(self::MANY_MANY, 'Course', 'course_modules(id_module,id_course)'),
            'lectures' => array(self::HAS_MANY, 'Lecture', 'idModule',
                'order' => 'lectures.order ASC'),
            'level0' => array(self::BELONGS_TO, 'Level', 'level'),
            'inCourses' => array(self::HAS_MANY, 'CourseModules', ['id_module'=>'module_ID']),
            'moduleTags' => array(self::HAS_MANY, 'ModuleTags', ['id_module'=>'module_ID']),
            'tags' => [self::HAS_MANY, 'Tags', ['id_tag' => 'id'], 'through' => 'moduleTags'],
            'revisions' => array(self::HAS_MANY, 'RevisionModule', ['id_module'=>'module_ID']),
            'organization' => array(self::BELONGS_TO, 'Organization', 'id_organization'),

            'moduleServiceOffline' => [self::HAS_ONE, 'ModuleService', 'module_id', 'on' => 'moduleServiceOffline.education_form='.EducationForm::OFFLINE],
            'corporateEntityServicesOffline' => [
                self::HAS_MANY,
                'CorporateEntityService',
                ['service_id' => 'serviceId'],
                'through' => 'moduleServiceOffline',
                'on' => 'corporateEntityServicesOffline.deletedAt IS NULL OR corporateEntityServicesOffline.deletedAt > NOW()'],
            'corporateEntityOffline' => [self::HAS_ONE, 'CorporateEntity', ['corporateEntityId' => 'id'], 'through' => 'corporateEntityServicesOffline'],
            'checkingAccountOffline' => [self::HAS_ONE, 'CheckingAccounts', ['checkingAccountId' => 'id'], 'through' => 'corporateEntityServicesOffline'],


            'moduleServiceOnline' => [self::HAS_ONE, 'ModuleService', 'module_id', 'on' => 'moduleServiceOnline.education_form='.EducationForm::ONLINE],
            'corporateEntityServicesOnline' => [
                self::HAS_MANY,
                'CorporateEntityService',
                ['service_id' => 'serviceId'],
                'through' => 'moduleServiceOnline',
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

    public function behaviors() {
        return [
            'ngTable' => [
                'class' => 'NgTableProviderModule'
            ]
        ];
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
            'alias' => 'Псевдонім',
            'language' => 'Мова',
            'module_price' => 'Ціна модуля базова, USD',
            'for_whom' => 'Для кого',
            'what_you_learn' => 'Що ти вивчиш',
            'what_you_get' => 'Що ти отримаєш',
            'module_img' => 'Фото',
            'module_number' => 'Унікальний ідентифікатор, використовується при генерації номера договора про оплату модуля.',
            'cancelled' => 'Видалений',
            'status_online' => 'Онлайн-статус',
            'status_offline' => 'Офлайн-статус',
            'hours_in_day' => 'Годин в день (рекомендований графік занять)',
            'days_in_week' => 'Днів у тиждень (рекомендований графік занять)',
            'level' => 'Рівень',
            'id_organization' => 'Id організації',
            'understand_rating' => 'Рейтинг заняття по зрозумiлостi',
            'interesting_rating' => 'Рейтинг заняття по цiкавостi',
            'accessibility_rating' => 'Рейтинг заняття по доступностi',
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

        $criteria->compare('module_ID', $this->module_ID);
        $criteria->compare('title_ua', $this->title_ua, true);
        $criteria->compare('title_ru', $this->title_ru, true);
        $criteria->compare('title_en', $this->title_en, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('language', $this->language, true);
        $criteria->compare('module_price', $this->module_price, true);
        $criteria->compare('for_whom', $this->for_whom, true);
        $criteria->compare('what_you_learn', $this->what_you_learn, true);
        $criteria->compare('what_you_get', $this->what_you_get, true);
        $criteria->compare('module_img', $this->module_img, true);
        $criteria->compare('days_in_week', $this->days_in_week, true);
        $criteria->compare('hours_in_day', $this->hours_in_day, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('understand_rating', $this->understand_rating, true);
        $criteria->compare('interesting_rating', $this->interesting_rating, true);
        $criteria->compare('accessibility_rating', $this->accessibility_rating, true);
        $criteria->compare('module_number', $this->module_number, true);
        $criteria->compare('cancelled', $this->cancelled, true);
        $criteria->compare('status_online', $this->status_online, true);
        $criteria->compare('status_offline', $this->status_offline, true);
        $criteria->compare('id_module_revision', $this->id_module_revision, true);
        $criteria->compare('id_organization', $this->id_organization);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Module the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getBasePrice()
    {
        return $this->module_price;
    }

    public function getBasePriceUAH()
    {
        return $this->getBasePrice() * Config::getDollarRate();
    }

    public function getDuration()
    {
        return $this->getModuleDuration();
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

    public function getLessonsTermination($num)
    {
        //Оставляем две последние цифры от $num
        $number = substr($num, -2);

        //Если 2 последние цифры входят в диапазон от 11 до 14
        //Тогда подставляем окончание "ЕВ"
        if ($number > 10 and $number < 15) {
            $term = "ь";
        } else {

            $number = substr($number, -1);

            if ($number == 0) {
                $term = "ь";
            }
            if ($number == 1) {
                $term = "тя";
            }
            if ($number > 1) {
                $term = "тя";
            }
            if ($number > 4) {
                $term = "ь";
            }
        }

        echo ' занят' . $term;
    }

    public function getByAlias($alias)
    {
        return $this->find('alias=:alias', array(':alias' == $alias))->module_ID;
    }

    public function level()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $this->level0->$title;
    }

    public function rate()
    {
        return $this->level0->id;
    }

    public static function getModuleAlias($idModule, $idCourse)
    {
        if ($alias = Module::model()->findByPk($idModule)->alias) {
            return $alias;
        } else {
            if ($idCourse != '') {
                return CourseModules::model()->findByAttributes(array(
                    'id_course' => $idCourse,
                    'id_module' => $idModule
                ))->order;
            } else {
                return $idModule;
            }
        }
    }

    public static function getModuleByAlias($alias, $idCourse)
    {

        if ($module = Module::model()->find(array(
            'condition' => 'alias = :alias',
            'params' => array('alias' => $alias),
        ))
        ) {
            return $module;
        } else {
            if ($idCourse != null) {
                if (!CourseModules::model()->exists('id_course = :course and `order` = :order', array(
                    'course' => $idCourse,
                    'order' => $alias
                ))
                )
                    throw new \application\components\Exceptions\IntItaException(404, 'Такого модуля у цьому курсі немає.');

                $idModule = CourseModules::model()->findByAttributes(array(
                    'id_course' => $idCourse,
                    'order' => $alias
                ))->id_module;
                return Module::model()->findByPk($idModule);
            } else {
                return Module::model()->findByPk($alias);
            }
        }
    }

    public function monthsCount()
    {
        return round($this->getLecturesCount() * 7 / ($this->hours_in_day * $this->days_in_week / Config::getLectureDurationInHours()));
    }

    public function moduleDurationInDays()
    {
        return $this->getLecturesCount() * 7 / ($this->hours_in_day * $this->days_in_week / Config::getLectureDurationInHours());
    }

    public static function lessonsInMonth($idModule)
    {
        $model = Module::model()->findByPk($idModule);

        $lesson = $model->getModuleDuration() * 4; //умножаем на уроки в день

        return $lesson;

    }

    public function getModuleDuration()
    {
        $hours = ($this->hours_in_day != 0) ? $this->hours_in_day : 3;
        $days = ($this->days_in_week != 0) ? $this->days_in_week : 2;

        return round($hours * $days / Config::getLectureDurationInHours());
    }

    public function cancelledTitle()
    {
        if ($this->cancelled == 0) return 'доступний';
        if ($this->cancelled == 1) return 'видалений';
        else return false;
    }

    public function getNumber()
    {
        return $this->module_ID;
    }

    public function getType()
    {
        return 'M';
    }

    public static function getLessonsCount($idModule)
    {
        return count(Lecture::model()->findAllByAttributes(array('idModule' => $idModule)));
    }

    public function getTitle()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $moduleTitle = $this->$title;
        if ($moduleTitle == "") {
            $moduleTitle = $this->title_ua;
        }
        return $moduleTitle;
    }

    public function getTitleForBreadcrumbs()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $moduleTitle = $this->$title;
        if ($moduleTitle == "") {
            $moduleTitle = $this->title_ua;
        }
        return $moduleTitle;
    }

    public function getSlashesTitle()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        $moduleTitle = $this->$title;
        if ($moduleTitle == "") {
            $moduleTitle = $this->title_ua;
        }
        return addslashes($moduleTitle);
    }

    public static function getModuleName($id)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';

        $title = "title_" . $lang;
        $moduleTitle = Module::model()->findByPk($id)->$title;
        if ($moduleTitle == "") {
            $moduleTitle = Module::model()->findByPk($id)->title_ua;
        }
        return $moduleTitle;
    }

    public static function getModulePrice($moduleId, $idCourse = 0)
    {
        if ($idCourse > 0) {
            $price = round(Module::model()->findByPk($moduleId)->module_price * Config::getCoeffDependentModule());
        } else {
            $price = round(Module::model()->findByPk($moduleId)->module_price);
        }
        if ($price == 0) {
            return '<span class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
    }

    public function lecturesCount()
    {
        return Lecture::model()->count("idModule=$this->module_ID and `order`>0");
    }

    public function titleParam()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $title;
    }

    public static function getDefaultModuleName($moduleName)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;

        if ($moduleName == "")
            return 'title_ua';
        else return $title;
    }

    public function getCourseOfModule()
    {
        if (CourseModules::model()->exists('id_module=:id', array(':id' => $this->module_ID))) {
            $courseId = CourseModules::model()->find('id_module =' . $this->module_ID)->id_course;
            return $courseId;
        } else {
            return false;
        }
    }

    public static function getModuleLang($idModule)
    {
        return Module::model()->findByPk($idModule)->language;
    }

    public static function getModuleNumber($idModule)
    {
        return Module::model()->findByPk($idModule)->module_number;
    }

    public static function getModuleSumma($moduleId, $idCourse = 0)
    {
        $model = Module::model()->findByPk($moduleId);
        return $model->modulePrice($idCourse);
    }

    public function modulePrice($idCourse = 0)
    {
        if ($idCourse > 0) {
            return round($this->module_price*Config::getCoeffDependentModule(),2);
        } else {
            return round($this->module_price,2);
        }
    }

    //todo refactor
    public static function getModulePricePayment($idModule, $discount = 0, $idCourse)
    {
        $price = Module::getModuleSumma($idModule, $idCourse);

    }

    public static function getTimeAnsweredQuiz($quiz, $user)
    {
        switch (LectureElement::model()->findByPk($quiz)->id_type) {
            case '5':
                return TaskMarks::taskTime($user, Task::model()->findByAttributes(array('condition' => $quiz))->uid);
                break;
            case '6':
                $plain = PlainTask::model()->findByAttributes(array('block_element' => $quiz))->id;
                $isAnswer = PlainTaskAnswer::model()->findByAttributes(array('id_plain_task' => $plain, 'id_student' => $user),array('order'=>'date DESC'));
                if ($isAnswer) return $isAnswer->date;
                else return false;
                break;
            case '12':
                return TestsMarks::testTime($user, Tests::model()->findByAttributes(array('block_element' => $quiz))->uid);
                break;
            case '9':
                return SkipTaskMarks::taskTime($user, SkipTask::model()->findByAttributes(array('condition' => $quiz))->uid);
                break;
            default:
                return false;
                break;
        }
    }

    //true if $pathString is a module alias
    public static function checkModuleAlias($pathString)
    {
        if (in_array($pathString, array('index', 'upLesson',
            'downLesson', 'lecturesUpdate', 'updateModuleAttribute', 'updateModuleImage'
        ))) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Checks if model can be editable by current user
     * @return int "1" if model editable by current user, "0" if does not editable
     */
    public function isEditableByUser($authId)
    {
        if ($this->teacher == null) {
            $this->getRelated('teacher');
        }
        foreach ($this->teacher as $teacher) {
            if ($teacher->user_id == $authId) { //if teacher's user_id correspond to authorized user_id
                return EDITOR_ENABLED;
                break;
            }
        }
        return EDITOR_DISABLED;
    }

    /**
     * Returns CArrayDataProvider of lectures.
     * @return CArrayDataProvider
     */
    public function getLecturesDataProvider($reloadLectures = false)
    {
        if ($this->lectures == null || $reloadLectures) {
            $this->getRelated('lectures');
        }
        return new CArrayDataProvider($this->lectures, array(
            'pagination' => false
        ));
    }

    /**
     * Returns count of lectures in the module
     * @return int
     * @throws CDbException
     */

    public function getLecturesCount()
    {
        return count($this->lectures);
    }

    /**
     * Level ups the lecture.
     * @param $idLecture
     */
    public function upLecture($idLecture)
    {
        if ($this->lectures === null) {
            $this->getRelated('lectures');
        }

        foreach ($this->lectures as $index => $lecture) {
            if ($lecture->id == $idLecture) {
                // if the first lecture do nothing
                if ($index == 0) {
                    return;
                }

                $this->swapLecturesOrder($lecture, $this->lectures[$index - 1]);
                return;
            }
        }
    }

    /**
     * Level downs the lecture.
     * @param $idLecture
     * @throws CDbException
     */
    public function downLecture($idLecture)
    {
        if ($this->lectures === null) {
            $this->getRelated('lectures');
        }

        $count = $this->getLecturesCount();

        foreach ($this->lectures as $index => $lecture) {

            if ($lecture->id == $idLecture) {
                // if the last lecture do nothing
                if ($index == $count - 1) {
                    return;
                }
                $this->swapLecturesOrder($lecture, $this->lectures[$index + 1]);
                return;
            }
        }
    }

    /**
     * Swaps lectures order.
     * @param $lectureA
     * @param $lectureB
     */
    private function swapLecturesOrder($lectureA, $lectureB)
    {
        $orderA = $lectureA->order;
        $lectureA->order = $lectureB->order;
        $lectureB->order = $orderA;

        $lectureA->update(array('order'));
        $lectureB->update(array('order'));
    }


    public static function canAccess($idModule, $userId)
    {
        $services_user = Module::findService($userId);

        if ($services_user) {
            foreach ($services_user as $service_user) {
                $service = AbstractIntITAService::getServiceById($service_user['service_id']);
                if ($service) {
                    return $service->checkAccess($idModule);
                }
            }

        } else return false;
    }

    private static function findService($userId)
    {
        $service_user = Yii::app()->db->createCommand()
            ->select('service_id, user_id')
            ->from('service_user')
            ->where('user_id = :user_id', array(':user_id' => $userId))
            ->queryAll();

        return $service_user;
    }

    public static function allModules($query, $organization)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "module_ID, title_ua, title_ru, title_en, language";
        $criteria->addSearchCondition('title_ua', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_ru', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_en', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('module_ID', $query, true, "OR", "LIKE");
        $criteria->addCondition('cancelled='.Module::ACTIVE);
        if($organization) $criteria->addCondition('id_organization='.$organization);
        
        $criteria->group = 'module_ID';

        $data = Module::model()->findAll($criteria);

        $result = array();
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $titleParam = "title_" . $lang;
        foreach ($data as $key => $record) {
            $result["results"][$key]["id"] = $record->module_ID;
            $result["results"][$key]["title"] = $record->$titleParam . " (" . $record->language . ")";
        }

        return json_encode($result);
    }

    /**
     * Returns id of last quiz in the module.
     * Direct queries to database uses for greater performance
     * @return bool $lectureElement->idBlock or false if nothing found
     * @throws CDbException
     */
    public function getLastQuizId()
    {
        $sqlPagesList =
            "SELECT id FROM lectures WHERE idModule=" . $this->module_ID . " ORDER BY `order` DESC;";

        $lecturePagesIdList = Yii::app()->db->createCommand($sqlPagesList)->queryall();

        $length = count($lecturePagesIdList);
        for ($i = 0; $i < $length; $i++) {
            $sqlGetLastQuizId =
                "SELECT lecture_page.quiz FROM lecture_page WHERE id_lecture = " . $lecturePagesIdList[$i]['id'] . " AND quiz IS NOT NULL ORDER BY page_order DESC LIMIT 1;";
            $idBlock = Yii::app()->db->createCommand($sqlGetLastQuizId)->queryScalar();
            if ($idBlock) {
                return $idBlock;
            }
        }
        return false;
    }

    public static function getResourceDescription($id)
    {
        $module = Module::model()->findByPk($id);
        return "Module" . " " . $module->module_ID . ". " . $module->title_ua;
    }

    /**
     * Returns id of first quiz in the module.
     * Direct queries to database uses for greater performance
     * @return bool $lectureElement->idBlock or false if nothing found
     * @throws CDbException
     */
    public function getFirstQuizId()
    {
        $sqlPagesList =
            "SELECT id FROM lectures WHERE idModule=" . $this->module_ID . " ORDER BY `order` ASC;";

        $lecturePagesIdList = Yii::app()->db->createCommand($sqlPagesList)->queryall();

        $length = count($lecturePagesIdList);
        for ($i = 0; $i < $length; $i++) {
            $sqlGetLastQuizId =
                "SELECT lecture_page.quiz FROM lecture_page WHERE id_lecture = " . $lecturePagesIdList[$i]['id'] . " AND quiz IS NOT NULL ORDER BY page_order ASC LIMIT 1;";
            $idBlock = Yii::app()->db->createCommand($sqlGetLastQuizId)->queryScalar();
            if ($idBlock) {
                return $idBlock;
            }
        }
        return false;
    }

    public function paymentMailTemplate()
    {
        return '_payModuleMail';
    }

    public function paymentMailTheme()
    {
        return 'Доступ до модуля';
    }

    public static function modulesNotInDefinedCourse($query, $course)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "module_ID, title_ua, title_ru, title_en, language";
        $criteria->alias = "m";
        $criteria->distinct = true;
        $criteria->addSearchCondition('title_ua', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_ru', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('title_en', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('module_ID', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN course_modules cm ON cm.id_module = m.module_ID';
        $criteria->addCondition('cm.id_course IS NULL or cm.id_course <>' . $course);
        $data = Module::model()->findAll($criteria);

        $result = array();
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $titleParam = "title_" . $lang;
        foreach ($data as $key => $record) {
            $result["results"][$key]["id"] = $record->module_ID;
            $result["results"][$key]["title"] = $record->$titleParam . " (" . $record->language . ")";
        }

        return json_encode($result);
    }

    public function isCancelled()
    {
        return $this->cancelled == Module::DELETED;
    }

    public function onlineStatusLabel(){
        return ($this->isReadyOnline())?'готовий':'в розробці';
    }
    public function offlineStatusLabel(){
        return ($this->isReadyOffline())?'готовий':'в розробці';
    }

    public function isReadyOnline(){
        return $this->status_online == MODULE::READY;
    }
    public function isReadyOffline(){
        return $this->status_offline == MODULE::READY;
    }

    public function isDeveloping(){
        return ($this->status_online == Module::DEVELOP && $this->status_offline == Module::DEVELOP);
    }

    public function cancelledLabel()
    {
        return (!$this->isCancelled()) ? 'доступний' : 'видалений';
    }

    public function lastLectureID()
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture';
        $criteria->order = '`order` DESC';
        $criteria->condition = 'idModule=' . $this->module_ID . ' and `order`>0';
        if (isset(Lecture::model()->find($criteria)->id))
            return Lecture::model()->find($criteria)->id;
        else return false;
    }

    public function lastLecture()
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture';
        $criteria->order = '`order` DESC';
        $criteria->condition = 'idModule=' . $this->module_ID . ' and `order`>0';
        return Lecture::model()->find($criteria);
    }

    public static function isAliasUnique($alias)
    {
        return Module::model()->exists('alias=:alias', array(':alias' => $alias)) == false;
    }

    public static function showModule($course)
    {
        $modulelist = [];
        $criteria = new CDbCriteria;
        $criteria->alias = 'course_modules';
        $criteria->select = 'id_module';
        $criteria->order = '`order` ASC';
        $criteria->addCondition('id_course=' . $course);
        $temp = CourseModules::model()->findAll($criteria);
        for ($i = 0; $i < count($temp); $i++) {
            array_push($modulelist, $temp[$i]->id_module);
        }
        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');
        return Module::model()->findAll($criteriaData);
    }

    public function consultants()
    {
        $sql = 'select u.id, u.firstName, u.middleName, u.secondName, u.email, cm.start_time, cm.end_time from consultant_modules cm
		 LEFT JOIN user u on u.id=cm.consultant WHERE cm.module=' . $this->module_ID;

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function teacherConsultants()
    {
        $sql = 'select u.id, u.firstName, u.middleName, u.secondName, u.email, tcm.start_date, tcm.end_date from teacher_consultant_module tcm
		 LEFT JOIN user u on u.id=tcm.id_teacher WHERE tcm.id_module=' . $this->module_ID;

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function getDepedentModulePrice()
    {
        return round($this->module_price * Config::getCoeffDependentModule());
    }

    public function priceOffline()
    {
        return round($this->getBasePrice() * Config::getCoeffModuleOffline());
    }

    public function getTeacherConsultant($studentId)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->join = 'inner join user_teacher_consultant utc ON utc.id_user = t.user_id';
        $criteria->join .= ' inner join teacher_consultant_module tcm on t.user_id=tcm.id_teacher';
        $criteria->join .= ' inner join teacher_consultant_student tcs on tcm.id_teacher=tcs.id_teacher';
        $criteria->join .= ' inner join module m on tcm.id_module=m.module_ID and tcs.id_module=m.module_ID';
        $criteria->join .= ' inner join teacher_organization tor on t.user_id=tor.id_user';
        $criteria->addCondition('tor.isPrint = 1 and tor.id_organization = :idOrganization and tcs.id_student = :id and tcs.end_date IS NULL
        and tcm.end_date IS NULL and m.module_ID=:module');
        $criteria->params = array(':id' => $studentId, ':module'=>$this->module_ID, ':idOrganization'=>$this->id_organization);
        $criteria->group = 't.teacher_id';
        $dataProvider = new CActiveDataProvider('Teacher', array(
            'criteria' => $criteria,
            'pagination' => false,
        ));
        
        return $dataProvider;
    }

    public function getModelUAH(){
        return new ModuleUAH($this);
    }

    public function moduleTags(){
        $data = [];
        foreach ($this->tags as $tag) {
            $data[] = $tag->getTagAttrs();
        }
        return json_encode($data);
    }

    /**
     * Function check user's access to module (using courses) based on user's payments
     * @param $userId
     * @return bool
     */
    public function checkPaidAccess($userId) {

        $access = false;
        $studentReg = StudentReg::model()->findByPk($userId);
        $access = $studentReg->access->checkVisitorAccess($this->moduleServiceOnline);

        if (!$access) {
            $access = $studentReg->access->checkVisitorAccess($this->moduleServiceOffline);
        }
        if (!$access) {
            foreach ($studentReg->offlineGroups as $group) {
                $access = $group->access->checkVisitorAccess($this->moduleServiceOnline);
                if (!$access) {
                    $access = $group->access->checkVisitorAccess($this->moduleServiceOffline);
                }
                if ($access) {
                    break;
                }
            }
        }
        if (!$access) {
            foreach ($this->Course as $course) {
                $access = $course->checkPaidAccess($userId);
                if ($access) {
                    break;
                }
            }
        }
        return $access;
    }

    /**
     * Function check user's access only to module based on user's payments
     * @param $userId
     * @return bool
     */
    public function checkPaidModuleAccess($userId) {

        $access = false;
        $studentReg = StudentReg::model()->findByPk($userId);
        $access = $studentReg->access->checkVisitorAccess($this->moduleServiceOnline);

        if (!$access) {
            $access = $studentReg->access->checkVisitorAccess($this->moduleServiceOffline);
        }
        if (!$access) {
            foreach ($studentReg->offlineGroups as $group) {
                $access = $group->access->checkVisitorAccess($this->moduleServiceOnline);
                if (!$access) {
                    $access = $group->access->checkVisitorAccess($this->moduleServiceOffline);
                }
                if ($access) {
                    break;
                }
            }
        }

        return $access;
    }

    /**
     * Function check user's access only to one (all) course(s) where is module based on user's payments
     * @param $userId $course
     * @param $courseId
     * @return bool
     */
    public function checkPaidModuleCourseAccess($userId, $courseId=null) {

        $access = false;

        $course = Course::model()->findByPk($courseId);
        if($courseId){
            $access = $course->checkPaidAccess($userId);
        } else {
            foreach ($this->Course as $course) {
                $access = $course->checkPaidAccess($userId);
                if ($access) {
                    break;
                }
            }
        }

        return $access;
    }

    public function getLastAccessLectureOrder()
    {
        if (Yii::app()->user->model->hasAccessToContent($this) || $this->isModuleDone()) {
            return count($this->lectures);
        }
        $user = Yii::app()->user->getId();
        $moduleAccess=$this->checkPaidAccess($user);
        
        $criteria = new CDbCriteria();
        $criteria->alias = 'lectures';
        $criteria->addCondition('idModule=' . $this->module_ID . ' and `order`>0');
        $criteria->order = '`order` ASC';
        $sortedLectures = Lecture::model()->findAll($criteria);
        
        foreach ($sortedLectures as $key => $lecture) {
            if (!$lecture->isFinished($user) || !$moduleAccess && !$lecture->isFree) {
                return $lecture->order;
            }
        }
        if (empty($sortedLectures))
            return 0;
        else return $sortedLectures[count($sortedLectures) - 1]['order'];
    }

    public function getModuleStatus($idCourse=0)
    {
        if ($idCourse && Course::model()->findByPk($idCourse)->isDeveloping()) {
            $this->errorMessage=Yii::t('lecture', '0811');
            return false;
        }
        if ($this->isDeveloping()) {
            $this->errorMessage=Yii::t('lecture', '0894');
            return false;
        }
        
        return true;
    }

    public static function checkMandatoryModule($idCourse,$idModule,$mandatory)
    {
        if($mandatory=="NULL") return true;
        $nextMandatory=$mandatory;
        $i=0;
        do {
            $nextMandatory=CourseModules::model()->findByAttributes(array(
                'id_course' => $idCourse,
                'id_module' => $nextMandatory
            ))->mandatory_modules;
            if($nextMandatory==$idModule) return false;
            $i=$i+1;
        } while ($nextMandatory);

        return true;
    }

    //    teacher who are teacher_consultant and author if this module
    public function getModuleTeachers()
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->join = 'left join user_teacher_consultant utc ON utc.id_user = t.user_id';
        $criteria->join .= ' inner join teacher_consultant_module tcm on t.user_id=tcm.id_teacher';
        $criteria->join .= ' left join user_author ua on ua.id_user=t.user_id';
        $criteria->join .= ' inner join teacher_module tm on t.user_id=tm.idTeacher';
        $criteria->join .= ' left join teacher_organization tot ON tot.id_user = t.user_id';
        $criteria->addCondition('tot.isPrint ='.TeacherOrganization::SHOW.' and tot.id_organization='.$this->id_organization.' 
        and ((tcm.id_module=:module and tcm.end_date IS NULL and utc.end_date IS NULL) 
        or (tm.idModule=:module and tm.end_time IS NULL and ua.end_date IS NULL))');
        $criteria->params = array(':module'=>$this->module_ID);
        $criteria->group = 't.teacher_id';
        return Teacher::model()->findAll($criteria);
    }

    public function addTag(Tags $tag) {
        $moduleTag = ModuleTags::model()->find('id_module = :moduleId AND id_tag = :tagId', ['moduleId' => $this->module_ID, 'tagId' => $tag->id]);
        if (empty($moduleTag)) {
            $moduleTag = new ModuleTags();
            $moduleTag->id_module = $this->module_ID;
            $moduleTag->id_tag = $tag->id;
            $moduleTag->save();
        }
        return $moduleTag;
    }

    public function removeTag(Tags $tag) {
        $affectedRows = ModuleTags::model()->deleteAll('id_tag = :tagId AND id_module = :moduleId', ['tagId' => $tag->id, 'moduleId' => $this->module_ID]);
        return $affectedRows > 0;
    }

    public function getAverageRating(){
        $average = ($this->understand_rating + $this->interesting_rating + $this->accessibility_rating)/3;
        return  $average;
    }

    public function getModuleStartTime($user=null){
        $user=$user?$user:Yii::app()->user->getId();
        $firstQuiz = $this->getFirstQuizId();
        if ($firstQuiz)
            $result=($start=Module::getTimeAnsweredQuiz($firstQuiz, $user))?(strtotime($start)): (false);
        else $result = false;
        return $result;
    }

    public function getModuleFinishedTime($user=null){
        $user=$user?$user:Yii::app()->user->getId();
        if($this->getLastAccessLectureOrder()<$this->getLecturesCount())
            $lastQuiz = false;
        else $lastQuiz = $this->getLastQuizId();
        if ($lastQuiz)
            $result=($finish=Module::getTimeAnsweredQuiz($lastQuiz, $user))?(strtotime($finish)): (false);
        else $result = false;
        return $result;
    }

    /**
     * @param EducationForm $educationForm
     * @return Service
     */
    public function getService(EducationForm $educationForm) {
        return ModuleService::model()->getService($this->module_ID, $educationForm)->service;
    }

    public static function selectModulesCount($arr)
    {
        if(isset($arr)){
            $criteria = new CDbCriteria;
            $criteria->condition = 'cancelled='.Module::ACTIVE.' and (status_online='.Module::READY.' or status_offline='                       .Module::READY.')';
            $criteria->addInCondition('level', $arr);
            $modules = Module::model()->findAll( $criteria );
        }else{
            $criteria = new CDbCriteria();
            $criteria->condition = 'cancelled='.Module::ACTIVE.' and (status_online='.Module::READY.' or status_offline='                       .Module::READY.')';
            $modules = Module::model()->findAll($criteria);
        }

        return count($modules);
    }

    public function hasPromotionSchemes()
    {
        $service=ModuleService::model()->getService($this->module_ID, EducationForm::model()->findByPk(1));
        $criteria = new CDbCriteria;
        $criteria->condition = 'moduleId='.$this->module_ID.' or (serviceType=2 and id_organization='.$service->moduleModel->id_organization.')';
        $criteria->addCondition('((showDate IS NOT NULL && NOW()>=showDate && endDate IS NOT NULL && NOW()<=endDate) or 
            (showDate IS NULL && endDate IS NULL) or (showDate IS NOT NULL && NOW()>=showDate && endDate IS NULL))');
        $promotions=PromotionPaymentScheme::model()->findAll($criteria);

        return $promotions?true:false;
    }

    //cancel teacher's students for module
    public function cancelTeacherStudentsForModule($student)
    {
        if(Yii::app()->db->createCommand()->
        update('teacher_consultant_student', array(
            'end_date'=>date("Y-m-d H:i:s"),
        ), 'id_student=:idStudent and id_module=:idModule and end_date IS NULL',
                array(':idStudent'=>$student,':idModule'=>$this->module_ID))){
            return true;
        }
        return false;
    }

    public function hasUserAgreement($idUser)
    {
        return UserAgreements::model()->findByAttributes(array('user_id'=>$idUser,'service_id'=>$this->moduleServiceOnline->service_id))
            || UserAgreements::model()->findByAttributes(array('user_id'=>$idUser,'service_id'=>$this->moduleServiceOffline->service_id));
    }

    public function isModuleDone()
    {
        $moduleProgress=RatingUserModule::userModuleProgress($this->module_ID);
        return $moduleProgress?$moduleProgress->module_done:false;
    }

    public function createRatingUserModuleRecord()
    {
        $moduleRating = RatingUserModule::model()->find('id_user=:user AND id_module=:idModule',[':user'=>Yii::app()->user->id,':idModule'=>$this->module_ID]);
        if (!$moduleRating){
            $moduleRating = new RatingUserModule();
            $moduleRating->id_user = Yii::app()->user->id;
            $moduleRating->id_module = $this->module_ID;
            $moduleRating->module_revision = RevisionModule::model()->with(['properties'])->find('id_module=:module AND id_state=:activeState',
                [':module'=>$this->module_ID,':activeState'=>RevisionState::ReleasedState])->id_module_revision;
            $moduleRating->module_done = (int)false;
            $moduleStartDate=$this->getModuleStartTime();
            $moduleRating->start_module = $moduleStartDate?date("Y-m-d H:i:s",$moduleStartDate):new CDbExpression('NOW()');
            $moduleRating->rating = 0;
            $moduleRating->save(false);
        }
    }

}
