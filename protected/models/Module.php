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
 * @property integer $hours_in_day
 * @property integer $days_in_week
 * @property integer $level
 * @property integer $rating
 * @property integer $module_number
 * @property integer $cancelled
 *
 * The followings are the available model relations:
 * @property Course $course0
 * @property Level $level0
 */

const EDITOR_ENABLED = 1;
const EDITOR_DISABLED = 0;
 
class Module extends CActiveRecord implements IBillableObject
{
    public $logo = array();
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
            array('status', 'required'),
            array('language, title_ua, level', 'required'),
            array('alias,module_number','unique'),
            array('module_duration_hours, module_duration_days, lesson_count, hours_in_day, days_in_week,
            module_number, cancelled, level', 'numerical', 'integerOnly' => true, 'message' => Yii::t('module', '0413')),
            array('module_price', 'length', 'max' => 10),
            array('module_number', 'unique', 'message' => 'Номер модуля повинен бути унікальним. Такий номер модуля вже існує.'),
            array('alias', 'length', 'max' => 30),
            array('language', 'length', 'max' => 6),
            array('title_ua', 'match',
                'pattern' => "/^[=а-еж-щьюяА-ЕЖ-ЩЬЮЯa-zA-Z0-9ЄєІіЇї.,\/<>:;`'?!~* ()+-]+$/u",
                'message' => 'Тільки українські символи!','on' => 'insert'),
            array('module_img, title_ua, title_ru, title_en', 'length', 'max' => 255),
            array('module_img', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true),
            array('for_whom, what_you_learn, what_you_get, days_in_week, hours_in_day, level,days_in_week, hours_in_day, level, rating', 'safe'),
            array('title_ua, title_ru, title_en, level,hours_in_day, days_in_week', 'required', 'message' => Yii::t('module', '0412'), 'on' => 'canedit'),
            array('hours_in_day, days_in_week', 'numerical', 'integerOnly' => true, 'min' => 1, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
            array('module_price', 'numerical', 'integerOnly' => true, 'min' => 0, "tooSmall" => Yii::t('module', '0413'), 'message' => Yii::t('module', '0413'), 'on' => 'canedit'),
            // The following rule is used by search().
            array('module_ID, title_ua, title_ru, title_en, alias, language, module_duration_hours,
			module_duration_days, lesson_count, module_price, for_whom, what_you_learn, what_you_get, module_img,
			days_in_week, hours_in_day, level, module_number, cancelled', 'safe', 'on' => 'search'),
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
            'Course' => array(self::MANY_MANY,'Course','course_modules(id_module,id_course)'),
            'lectures' => array(self::HAS_MANY, 'Lecture','idModule',
                                                'order' => 'lectures.order ASC'),
            'teacher' => array(self::MANY_MANY, 'Teacher','teacher_module(idModule,idTeacher)',
                                                'on' => 'teacher.isPrint=1'),
            'level0' => array(self::BELONGS_TO, 'Level', 'level'),
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
            'alias' => 'Псевдонім',
            'language' => 'Мова',
            'module_duration_hours' => 'Тривалість модуля (години)',
            'module_duration_days' => 'Тривалість модуля (дні)',
            'lesson_count' => 'Кількість лекцій',
            'module_price' => 'Ціна',
            'for_whom' => 'Для кого',
            'what_you_learn' => 'Що ти вивчиш',
            'what_you_get' => 'Що ти отримаєш',
            'module_img' => 'Фото',
            'module_number' => 'Номер модуля',
            'cancelled' => 'Видалений',
            'status' => 'Статус',
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
        $criteria->compare('module_duration_hours', $this->module_duration_hours);
        $criteria->compare('module_duration_days', $this->module_duration_days);
        $criteria->compare('lesson_count', $this->lesson_count);
        $criteria->compare('module_price', $this->module_price, true);
        $criteria->compare('for_whom', $this->for_whom, true);
        $criteria->compare('what_you_learn', $this->what_you_learn, true);
        $criteria->compare('what_you_get', $this->what_you_get, true);
        $criteria->compare('module_img', $this->module_img, true);
        $criteria->compare('days_in_week', $this->days_in_week, true);
        $criteria->compare('hours_in_day', $this->hours_in_day, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('rating', $this->rating, true);
        $criteria->compare('module_number', $this->module_number, true);
        $criteria->compare('cancelled', $this->cancelled, true);

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

    public function level(){
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $this->level0->$title;
    }

    public function rate(){
        return $this->level0->id;
    }


    /**
     * Creating module processes in initNewModule function.
     * Deprecated.
     */
    public function addNewModule($idCourse, $titleUa, $titleRu, $titleEn, $lang)
    {
        $module = new Module();
        $courseModule = new CourseModules();
        $module->level = Course::model()->findByPk($idCourse)->level;
        $module->language = $lang;
        $module->title_ua = $titleUa;
        $module->title_ru = $titleRu;
        $module->title_en = $titleEn;
        if ($module->validate()) {
            if($module->save()){
                $idModule = Yii::app()->db->createCommand("SELECT max(module_ID) from module")->queryScalar();
                $module->alias = $idModule;
                $module->save();
                $order = count(Yii::app()->db->createCommand("SELECT DISTINCT id_module FROM course_modules WHERE id_course =" . $idCourse
                )->queryAll());
                Module::model()->updateByPk($module->module_ID, array('module_img' => 'module.png'));
                if(!file_exists(Yii::app()->basePath . "/../content/module_".$idModule)){
                    mkdir(Yii::app()->basePath . "/../content/module_".$idModule);
                }
                $courseModule->id_course = $idCourse;
                $courseModule->id_module = $idModule;
                $courseModule->order = $order + 1;
                if ($courseModule->validate()) {
                    $courseModule->save();
                    return true;
                }
            }
        }
        return false;
    }

    public static function getModules($id)
    {
        $modules = Yii::app()->db->createCommand()
            ->select('module_ID')
            ->from('module')
            ->order('module_ID DESC')
            ->where('course=' . $id)
            ->queryAll();
        $result = [];
        for ($i = count($modules) - 1; $i > 0; $i--) {
            array_push($result, $modules[$i]["module_ID"]);
        }
        return $result;
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

    public function monthsCount(){
        return round($this->lesson_count * 7 / ($this->hours_in_day * $this->days_in_week));
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

        return round($hours * $days);
    }

    public function statusTitle()
    {
        if ($this->status == 0) return 'в розробці';
        if ($this->status == 1) return 'готовий';
        else return false;
    }

    public function cancelledTitle()
    {
        if ($this->cancelled == 0) return 'доступний';
        if ($this->cancelled == 1) return 'видалений';
        else return false;
    }

    public static function showModule($course)
    {
        $first = '<select name="module" class="form-control" id="payModuleList" required="true">';

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

        $titleParam = Module::getModuleTitleParam();

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $rows = Module::model()->findAll($criteriaData);
        $result = $first . '<optgroup label="' . Yii::t('payments', '0607') . '">';
        foreach ($rows as $numRow => $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            $result = $result . '<option value="' . $row['module_ID'] . '">' . $row[$title]." (".$row['language'].") ".'</option>';
        };
        $last = '</select>';
        return $result . $last;
    }

    public static function moduleAccessStyle($data)
    {
        $user = Yii::app()->user->getId();
        if (Yii::app()->user->isGuest) {
            return 'disableModuleStyle';
        }
        if (StudentReg::isAdmin()) {
            return 'availableModuleStyle';
        }
        if (StudentReg::getRoleString($user) == 'викладач') {
            if (Teacher::isTeacherAuthorModule($user, $data->moduleInCourse->module_ID))
                return 'availableModuleStyle';
        }
        if (PayCourses::model()->checkCoursePermission($user, $data->id_course, array('read'))) {
            switch (Module::getModuleProgress($data->moduleInCourse->module_ID, $user)[0]) {
                case 'inline':
                    return 'inlineModuleStyle';
                    break;
                case 'inProgress':
                    return 'inProgressModuleStyle';
                    break;
                case 'finished':
                    return 'inFinishedModuleStyle';
                    break;
                default:
                    return 'inlineModuleStyle';
                    break;
            }
        }
        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission($user, $data->moduleInCourse->module_ID, array('read'))) {
            return 'disableModuleStyle';
        }
        return 'availableModuleStyle';
    }


    public static function moduleProgressDescription($data, $value)
    {
        $user = Yii::app()->user->getId();
        $time = Module::getAverageModuleDuration($data->moduleInCourse->lesson_count,
            $data->moduleInCourse->hours_in_day,
            $data->moduleInCourse->days_in_week);
        if (Yii::app()->user->isGuest) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' .
                $time . ' ' . CommonHelper::getDaysTermination($time) . $img . '</div>',
                Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID,
                    "idCourse" => $data->id_course)), array('class' => 'disableModule'));
        }
        if (StudentReg::isAdmin()) {
            return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                CommonHelper::getDaysTermination($time) . '</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }
        if (StudentReg::getRoleString(Yii::app()->user->getId()) == 'викладач') {
            if (Teacher::isTeacherAuthorModule(Yii::app()->user->getId(), $data->moduleInCourse->module_ID))
                return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                    CommonHelper::getDaysTermination($time) . '</div>', Yii::app()->createUrl("module/index",
                    array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }

        if (PayCourses::model()->checkCoursePermission(Yii::app()->user->getId(), $data->id_course, array('read'))) {
            if (Module::getModuleProgress($data->moduleInCourse->module_ID, $user)) {
                $moduleInfo = Module::getModuleProgress($data->moduleInCourse->module_ID, $user);
                switch ($moduleInfo[0]) {
                    case 'inline':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                        return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' .
                            $time . ' ' . CommonHelper::getDaysTermination($time) . '. ' . Yii::t('module', '0648') .
                            $img . '</div>', Yii::app()->createUrl("module/index", array("idModule" =>
                            $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'inProgress':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'inProgress.png'));
                        return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' .
                            $time . ' ' . CommonHelper::getDaysTermination($time) . '. ' . Yii::t('module', '0650') . ' ' .
                            $moduleInfo[1] . ' ' . CommonHelper::getDaysTermination($moduleInfo[1]) . '. ' .
                            Yii::t('module', '0651') . $img . '</div>', Yii::app()->createUrl("module/index",
                            array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'finished':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'finished.png'));
                        return CHtml::link($value . '<div class="moduleProgress"><span class="greenFinished">' .
                            Yii::t('module', '0649') . '</span> (' . Yii::t('module', '0650') . ': <span class="' .
                            Module::getHoursColor($moduleInfo[1], $time) . '">' . $moduleInfo[1] . '</span> ' .
                            CommonHelper::getDaysTermination($moduleInfo[1]) . ' ' . Yii::t('module', '0652') . ' ' .
                            $time . ')' . $img . '</div>', Yii::app()->createUrl("module/index", array("idModule" =>
                            $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    default:
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.
                            $time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').
                            $img.'</div>', Yii::app()->createUrl("module/index", array(
                            "idModule" => $data->moduleInCourse->module_ID,
                            "idCourse" => $data->id_course
                        )));
                        break;
                }
            } else {
                $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                    CommonHelper::getDaysTermination($time) . '. ' . Yii::t('module', '0648') . $img . '</div>',
                    Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID,
                        "idCourse" => $data->id_course)));
            }
        }

        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $data->moduleInCourse->module_ID,
            array('read'))
        ) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                CommonHelper::getDaysTermination($time) . ' ' . $img . '</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)),
                array('class' => 'disableModule'));
        } else {
            return CHtml::link($value . '<div class="moduleProgress">' . Yii::t('module', '0647') . ': ' . $time . ' ' .
                CommonHelper::getDaysTermination($time) . '</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)),
                array('class' => ''));
        }
    }

    public static function generateModulesList()
    {
        $modules = Module::model()->findAll();
        $count = count($modules);
        $result = [];
        $titleParam = Lecture::getTypeTitleParam();
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $modules[$i]->module_ID;
            $result[$i]['alias'] = $modules[$i]->$titleParam;
            $result[$i]['language'] = $modules[$i]->language;
        }
        return $result;
    }

    public static function getResourceDescription($id)
    {
        $module = Module::model()->findByPk($id);
        return "Module" . " " . $module->module_ID . ". " . $module->title_ua;
    }

    public static function getLessonsCount($idModule)
    {
        return count(Lecture::model()->findAllByAttributes(array('idModule' => $idModule)));
    }

    public static function getTeacherModules($teacher, $modules)
    {
        $result = [];
        for ($i = 0; $i < count($modules); $i++) {
            if ($id = TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
                ':teacher' => $teacher,
                ':module' => $modules[$i],
            ))
            ) {
                array_push($result, $modules[$i]);
            }
        }
        return $result;
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

    public static function getModuleName($id)
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';

        $title = "title_" . $lang;
        $moduleTitle = Module::model()->findByPk($id)->$title;
        if ($moduleTitle == "") {
            $moduleTitle = Module::model()->findByPk($id)->title_ua;
        }
        return htmlspecialchars($moduleTitle);
    }

    public static function getModuleDurationFormat($countless, $hours, $hInDay, $daysInWeek)
    {
        if ($countless == 0) {
            return '';
        }
        return ", " . Yii::t('module', '0217') . " - <b>" . round($countless * 7 / ($hInDay * $daysInWeek)) . " " . Yii::t('module', '0218') . "</b> (" . $hInDay . " " . Yii::t('module', '0219') . ", " . $daysInWeek . " " . Yii::t('module', '0220') . ")";
    }

    public static function getModulePrice($moduleId, $idCourse=0)
    {
        if ($idCourse > 0) {
            $price = CourseModules::model()->findByAttributes(array('id_module' => $moduleId,
                'id_course' => $idCourse))->price_in_course;
            if ($price <= 0) {
                $price = Module::model()->findByPk($moduleId)->module_price;
            }
        } else {
            $price = Module::model()->findByPk($moduleId)->module_price * Config::getCoeffIndependentModule();
        }
        if ($price == 0) {
            return '<span class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
    }

    public function lecturesCount()
    {
        return Lecture::model()->count("idModule=$this->module_ID and `order`>0");
    }

    public static function getModuleTitleParam()
    {
        $lang = (Yii::app()->session['lg']) ? Yii::app()->session['lg'] : 'ua';
        $title = "title_" . $lang;
        return $title;
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
        if ($idCourse > 0) {
            $price = CourseModules::model()->findByAttributes(array('id_module' => $moduleId,
                'id_course' => $idCourse))->price_in_course;
            if ($price <= 0) {
                return round(Module::model()->findByPk($moduleId)->module_price);
            } else {
                return $price;
            }
        } else {
            return round(Module::model()->findByPk($moduleId)->module_price * Config::getCoeffIndependentModule());
        }
    }

    public static function getModulePricePayment($idModule, $discount = 0, $idCourse)
    {
        $price = Module::getModuleSumma($idModule, $idCourse);
        if ($price == 0) {
            return '<span style="display: inline-block;margin-top: 3px" class="colorGreen">' . Yii::t('module', '0421') . '</span>';
        }
        if ($discount == 0) {
            return
                '<table class="mainPay">
                    <tr>
                    <td class="icoPay"><img class="icoNoCheck" src="' .
                StaticFilesHelper::createPath('image', 'course', 'wallet.png') . '"><img class="icoCheck" src="' .
                StaticFilesHelper::createPath('image', 'course', 'checkWallet.png') . '"></td>
                    <td>
                        <table>
                            <tr><td><div>' . Yii::t('payment', '0661') . '</div></td></tr>
                            <tr><td><span class="coursePriceStatus2">' . $price . " " . Yii::t('courses', '0322') . '</span></td></tr>
                        </table>
                    </td>
                    </tr>
                </table>';
        }
        return
            '<table class="mainPay">
                <tr>
                <td class="icoPay"><img class="icoNoCheck" src="' .
            StaticFilesHelper::createPath('image', 'course', 'wallet.png') . '"><img class="icoCheck" src="' .
            StaticFilesHelper::createPath('image', 'course', 'checkWallet.png') . '"></td>
                <td>
                    <table>
                        <tr><td><div>' . Yii::t('course', '0197') . '</div></td></tr>
                        <tr><td>
                            <div class="numbers"><span class="coursePriceStatus1">' . $price . " " . Yii::t('courses', '0322') . '</span>
                            &nbsp<span class="coursePriceStatus2">' . PaymentHelper::discountedPrice($price, $discount) . " " . Yii::t('courses', '0322') . '</span><br>
                            <span id="discount"> <img style="text-align:right" src="' . StaticFilesHelper::createPath('image', 'course', 'pig.png') . '">(' . Yii::t('courses', '0144') . ' - ' . $discount . '%)</span>
                            </div>
                        </td></tr>
                    </table>
                </td>
                </tr>
            </table>';
    }

    public static function getAverageModuleDuration($lesson_count, $hours_in_day, $days_in_week)
    {
        return round($lesson_count * 7 / ($hours_in_day * $days_in_week));
    }

    public static function getModuleProgress($module_ID, $user)
    {
        $module = Module::model()->findByPk($module_ID);
        $firstLectureId = $module->firstLectureID();
        $lastLectureId = $module->lastLectureID();

        if ($firstLectureId && $lastLectureId) {
            $firstQuiz = LecturePage::getFirstQuiz($firstLectureId);
            $lastQuiz = LecturePage::getLastQuiz($lastLectureId);
        } else {
            $moduleStatus = array('inline', 0);
            return $moduleStatus;
        }
        if ($firstQuiz) $startTime = Module::getModuleStartTime($firstQuiz, $user); else $startTime = false;
        if ($lastQuiz) $endTime = Module::getModuleFinishedTime($lastQuiz, $user); else $endTime = false;

        if (!$startTime) {
            $moduleStatus = array('inline', 0);
            return $moduleStatus;
        }
        if ($startTime && !$endTime) {
            $days=round((time()-strtotime($startTime))/86400);
            $moduleStatus=array('inProgress', abs($days)+1);
            return $moduleStatus;
        }
        if ($startTime && $endTime) {
            $days = round((strtotime($endTime) - strtotime($startTime)) / 86400);
            $moduleStatus = array('finished', abs($days) + 1);
            return $moduleStatus;
        }
    }

    public function firstLectureID()
    {
        if (isset(Lecture::model()->findByAttributes(array('idModule' => $this->module_ID, 'order' => 1))->id))
            return Lecture::model()->findByAttributes(array('idModule' => $this->module_ID, 'order' => 1))->id;
        else return false;
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

    public static function getModuleStartTime($firstQuiz, $user)
    {
        switch (LectureElement::model()->findByPk($firstQuiz)->id_type) {
            case '5':
                return TaskMarks::taskTime($user, Task::model()->findByAttributes(array('condition' => $firstQuiz))->id);
                break;
            case '6':
                return PlainTaskMarks::taskTime($user, PlainTask::model()->findByAttributes(array('block_element' => $firstQuiz))->id);
                break;
            case '12':
                return TestsMarks::testTime($user, Tests::model()->findByAttributes(array('block_element' => $firstQuiz))->id);
                break;
            case '9':
                return SkipTaskMarks::taskTime($user, SkipTask::model()->findByAttributes(array('condition' => $firstQuiz))->id);
                break;
            default:
                return false;
                break;
        }
    }

    public static function getModuleFinishedTime($lastQuiz, $user)
    {
        switch (LectureElement::model()->findByPk($lastQuiz)->id_type) {
            case '5':
                return TaskMarks::taskTime($user, Task::model()->findByAttributes(array('condition' => $lastQuiz))->id);
                break;
            case '6':
                return PlainTaskMarks::taskTime($user, PlainTask::model()->findByAttributes(array('block_element' => $lastQuiz))->id);
                break;
            case '12':
                return TestsMarks::testTime($user, Tests::model()->findByAttributes(array('block_element' => $lastQuiz))->id);
                break;
            case '9':
                return SkipTaskMarks::taskTime($user, SkipTask::model()->findByAttributes(array('condition' => $lastQuiz))->id);
                break;
            default:
                return false;
                break;
        }
    }

    public static function getHoursColor($finishedTime, $averageTime)
    {
        if ($finishedTime <= $averageTime) return 'greenFinished';
        else return 'redFinished';
    }

    //true if $pathString is a module alias
    public static function checkModuleAlias($pathString)
    {
        if (in_array($pathString, array('index', 'saveLesson', 'saveModule', 'unableLesson', 'upLesson',
            'downLesson', 'lecturesUpdate', 'updateModuleAttribute', 'updateModuleImage'
        ))) {
            return false;
        } else {
            return true;
        }
    }

    public static function getTeacherByModule($idModule)
    {
        $module = Module::model()->findByPk($idModule);
        return $module->teacher;
    }
    
    /**
     * Checks if model can be editable by current user
     * @return int "1" if model editable by current user, "0" if does not editable
     */
    public function isEditableByCurrentUser() {
        if (!Yii::app()->user->isGuest) { // if user not guest
            if ($this->teacher == null) {
                $this->getRelated('teacher');
            }
            $authId = Yii::app()->user->getId();
            foreach ($this->teacher as $teacher){
                if ($teacher->user_id == $authId) { //if teacher's user_id correspond to authorized user_id
                    return EDITOR_ENABLED;
                    break;
                }
            }
        }
        return EDITOR_DISABLED;
    }

    /**
     * Returns CArrayDataProvider of lectures.
     * @return CArrayDataProvider
     */
    public function getLecturesDataProvider($reloadLectures = false) {
        if ($this->lectures == null || $reloadLectures) {
            $this->getRelated('lectures');
        }
        return new CArrayDataProvider($this->lectures, array(
            'pagination' => false
        ));
    }

    /**
     * Creates new lecture.
     * @param array $params must include fields 'titleUa', 'titleRu', 'titleEn', 'order';
     */

    public function addLecture($params) {

        $teacher = Teacher::model()->find('user_id=:user', array(':user' => Yii::app()->user->getId()));

        //todo: rafactor static method
        $lecture = Lecture::model()->addNewLesson(
            $this->module_ID,
            $params['titleUa'],
            $params['titleRu'],
            $params['titleEn'],
            $teacher->teacher_id
        );

        $this->lesson_count = $this->getLecturesCount(true);
        $this->update(array('lesson_count'));

        LecturePage::addNewPage($lecture->id, 1);
    }

    /**
     * Returns count of lectures in the module
     * @return int
     * @throws CDbException
     */

    public function getLecturesCount($reloadLectures = false) {
        if (!isset($this->lectures) || $reloadLectures){
            $this->getRelated('lectures');
        }
        return count($this->lectures);
    }

    /**
     * Disables lesson from the module and shifting order of lessons;
     */

    public function disableLesson($idLecture) {

        $lecture = Lecture::model()->findByPk($idLecture);

        $oldLecturePosition = $lecture->order;

        $count =  $this->getLecturesCount();

        $lecture->idModule = 0;
        $lecture->order = 0;
        $lecture->update(array('idModule', 'order'));

        for ($i = $oldLecturePosition; $i < $count; $i++) {
            $this->lectures[$i]->decreaseOrderByOne();
        }

        $this->lesson_count = $count-1;
        $this->update(array('lesson_count'));
    }

    public function initNewModule($course, $titleUa, $titleRu, $titleEn, $lang) {

        $this->level = $course->level;
        $this->language = $lang;
        $this->title_ua = $titleUa;
        $this->title_ru = $titleRu;
        $this->title_en = $titleEn;

        if ($this->validate()) {
            if($this->save()){

                $this->alias = $this->module_ID;
                $this->module_img = "module.png";
                $this->update();

                if(!file_exists(Yii::app()->basePath . "/../content/module_".$this->module_ID)){
                    mkdir(Yii::app()->basePath . "/../content/module_".$this->module_ID);
                }

                $courseModule = new CourseModules();
                $courseModule->id_course = $course->course_ID;
                $courseModule->id_module = $this->module_ID;
                $courseModule->order = $course->getModuleCount() + 1;
                if ($courseModule->validate()) {
                    $courseModule->save();
                    return true;
                }
            }
        }
        return false;
    }

}
