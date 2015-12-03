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
 */
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
            array('status','required'),
            array('language, title_ua, level', 'required'),
            array('module_duration_hours, module_duration_days, lesson_count, hours_in_day, days_in_week,
            module_number, cancelled', 'numerical', 'integerOnly' => true, 'message' => Yii::t('module', '0413')),
            array('level', 'length', 'max' => 45),
            array('module_price', 'length', 'max' => 10),
            array('module_number','unique','message'=>'Номер модуля повинен бути унікальним. Такий номер модуля вже існує.'),
            array('alias', 'length', 'max' => 30),
            array('language', 'length', 'max' => 6),
            array('module_img, title_ua, title_ru, title_en', 'length', 'max' => 255),
            array('module_img', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
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
            'lectures' => array(self::HAS_MANY, 'Lecture','idModule')
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
       return $this->getModuleDuration($this);
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

    public function addNewModule($idCourse, $titleUa, $titleRu, $titleEn, $lang)
    {
        $module = new Module();
        $coursemodule = new CourseModules();

        $order = CourseModules::model()->count("id_course=$idCourse");

        $module->level = Course::model()->findByPk($idCourse)->level;
        $module->language = $lang;
        $module->title_ua = $titleUa;
        $module->title_ru = $titleRu;
        $module->title_en = $titleEn;
        if ($module->validate()) {
            $module->save();
        }

        $idModule = Yii::app()->db->createCommand("SELECT max(module_ID) from module")->queryScalar();
        $module->alias = $idModule;
        $module->save();

        $coursemodule->id_course = $idCourse;
        $coursemodule->id_module = $idModule;
        $coursemodule->order = $order + 1;

        if ($coursemodule->validate()) {
            $coursemodule->save();
        }

        return $order;
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
                //throw new CHttpException(404, 'Модуля з таким псевдонімом немає.');
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

    public static function lessonsInMonth($idModule)
    {
        $model = Module::model()->findByPk($idModule);

        $lesson = Module::getModuleDuration($model) * 4; //умножаем на уроки в день

        return $lesson;

    }

    private static function getModuleDuration($module)
    {
        $hours = ($module->hours_in_day != 0) ? $module->hours_in_day : 3;
        $days = ($module->days_in_week != 0) ? $module->days_in_week : 2;

        return round($hours * $days);
    }

    public static function getStatusName($status)
    {
        if($status == 0) return 'В розробці';
        if($status == 1) return 'Розроблений';
        else return false;


    }

    public function getCancelledName($status)
    {
        if($status == 0) return 'Не Видалений';
        if($status == 1) return 'Видалений';
        else return false;
    }

    public static function showModule($course)
    {
        $first = '<select name="module" id="payModuleList">';

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

        $titleParam = ModuleHelper::getModuleTitleParam();

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $rows = Module::model()->findAll($criteriaData);
        $result = $first . '<option value="">' . Yii::t('payments', '0606') . '</option>
                   <optgroup label="' . Yii::t('payments', '0607') . '">';
        foreach ($rows as $numRow => $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            $result = $result . '<option value="' . $row['module_ID'] . '">' . $row[$title] . '</option>';
        };
        $last = '</select>';
        return $result . $last;
    }

    public static function moduleAccessStyle($data)
    {
        $user=Yii::app()->user->getId();
        if (Yii::app()->user->isGuest) {
            return 'disableModuleStyle';
        }
        if (StudentReg::isAdmin()) {
            return 'availableModuleStyle';
        }
        if (StudentReg::getRoleString($user) == 'викладач') {
            if (TeacherHelper::isTeacherAuthorModule($user, $data->moduleInCourse->module_ID))
                return 'availableModuleStyle';
        }
        if(PayCourses::model()->checkCoursePermission($user, $data->id_course, array('read'))){
            switch (ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user)[0]) {
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


    public static function moduleProgressDescription($data,$value)
    {
        $user=Yii::app()->user->getId();
        $time=ModuleHelper::getAverageModuleDuration($data->moduleInCourse->lesson_count,
            $data->moduleInCourse->hours_in_day,
            $data->moduleInCourse->days_in_week);
        if (Yii::app()->user->isGuest) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.
                $time.' '.CommonHelper::getDaysTermination($time).$img.'</div>',
                Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID,
                    "idCourse" => $data->id_course)), array('class' => 'disableModule'));
        }
        if (StudentReg::isAdmin()) {
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.
                CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }
        if (StudentReg::getRoleString(Yii::app()->user->getId()) == 'викладач') {
            if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(), $data->moduleInCourse->module_ID))
                return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.
                    CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index",
                    array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }

        if(PayCourses::model()->checkCoursePermission(Yii::app()->user->getId(), $data->id_course, array('read'))){
            if(ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user)){
                $moduleInfo=ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user);
                switch ($moduleInfo[0]) {
                    case 'inline':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.
                            $time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').
                            $img.'</div>', Yii::app()->createUrl("module/index", array("idModule" =>
                            $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'inProgress':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'inProgress.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.
                            $time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0650').' '.
                            $moduleInfo[1].' '.CommonHelper::getDaysTermination($moduleInfo[1]).'. '.
                            Yii::t('module', '0651').$img.'</div>', Yii::app()->createUrl("module/index",
                            array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'finished':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'finished.png'));
                        return CHtml::link($value.'<div class="moduleProgress"><span class="greenFinished">'.
                            Yii::t('module', '0649').'</span> ('.Yii::t('module', '0650').': <span class="'.
                            ModuleHelper::getHoursColor($moduleInfo[1],$time).'">'.$moduleInfo[1].'</span> '.
                            CommonHelper::getDaysTermination($moduleInfo[1]).' '.Yii::t('module', '0652').' '.
                            $time.')'.$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" =>
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
            }else{
                $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.
                    CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').$img.'</div>',
                    Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID,
                        "idCourse" => $data->id_course)));
            }
        }

        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $data->moduleInCourse->module_ID,
            array('read'))) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.
                CommonHelper::getDaysTermination($time).' '.$img.'</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)),
                array('class' => 'disableModule'));
        }else{
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.
                CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index",
                array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)),
                array('class' => ''));
        }
    }

    public static function generateModulesList()
    {
        $modules = Module::model()->findAll();
        $count = count($modules);
        $result = [];
        $titleParam = LectureHelper::getTypeTitleParam();
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $modules[$i]->module_ID;
            $result[$i]['alias'] = $modules[$i]->$titleParam;
        }
        return $result;
    }

    public static function getResourceDescription($id)
    {
        $module = Module::model()->findByPk($id);

        return "Module" . " " . $module->module_ID . ". " . $module->title_ua;
    }
}
