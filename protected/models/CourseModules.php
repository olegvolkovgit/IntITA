<?php

/**
 * This is the model class for table "course_modules".
 *
 * The followings are the available columns in table 'course_modules':
 * @property integer $id_course
 * @property integer $id_module
 * @property integer $order
 * @property integer $mandatory_modules
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property Module $moduleInCourse
 * @property Module $mandatory
 */
class CourseModules extends CActiveRecord
{
    public $durationInMonths;
    public $lessonCount;
    public $start;
    public $access;
    public $duration; //days
    public $statusMessage;
    public $startTime;
    public $finishTime;
    public $check;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'course_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_course, id_module, order', 'required'),
			array('id_course, id_module, order, mandatory_modules, lessonCount, durationInMonths', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_course, id_module, order, mandatory_modules, durationInMonths, lessonCount',
                'safe', 'on'=>'search'),
            //array('on' => 'activeModule'),
		);
	}

	/**
	 * @return array relational rules.
	 */
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'mandatory' => array(self::HAS_ONE, 'Module', array('module_ID' => 'mandatory_modules')),
            'moduleInCourse' => array(self::HAS_ONE, 'Module', array('module_ID' => 'id_module')),
            'course' => array(self::HAS_ONE, 'Course', array('course_ID' => 'id_course')),
            'mandatoryCourseModule' => array(self::HAS_ONE, 'CourseModules', array('id_course' => 'id_course','id_module' => 'mandatory_modules')),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_course' => 'Id Course',
			'id_module' => 'Id Module',
            'mandatory_modules' => 'Попередні модулі(обов`язкові)',
			'order' => 'Order',
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
	public function search($id)
	{

		$criteria = new CDbCriteria;

        $criteria->addCondition('id_course='.$id);

		$criteria->compare('t.id_course',$this->id_course);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('order',$this->order);
        $criteria->compare('mandatory_modules',$this->mandatory_modules);
        $criteria->with = array('moduleInCourse');

        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
		));

	}

    public function activeModules($id)
    {
        $criteria = new CDbCriteria;

        $criteria->addCondition('id_course='.$id);
        $criteria->compare('id_course',$this->id_course);
        $criteria->compare('id_module',$this->id_module);
        $criteria->compare('order',$this->order);
        $criteria->compare('mandatory_modules',$this->mandatory_modules);
        $criteria->with = array('moduleInCourse');
        $criteria->alias = 'module';
        $criteria->addCondition('cancelled = 0');


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>false,
            'sort'=>array(
                'defaultOrder'=>array(
                    'order'=>CSort::SORT_ASC,
                )
            )
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CourseModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function primaryKey()
    {
        return array('id_course', 'id_module');
    }

    public static function addNewRecord($idModule, $idCourse){
        $model = new CourseModules();

        $model->id_course = $idCourse;
        $model->id_module = $idModule;

        if(CourseModules::model()->findByAttributes(array('id_course' => $idCourse, 'id_module' => $idModule))){
            echo 'duplicate ';
            return false;
        }

        $model->order = CourseModules::getLastModuleOrder($idCourse) + 1;

        return $model->save();
    }

    public static function getLastModuleOrder($idCourse){
        $lastOrder = Yii::app()->db
            ->createCommand("SELECT MAX(`order`) FROM course_modules where id_course=".$idCourse)
            ->queryScalar();

        return $lastOrder;
    }

    public static function getPrevModule($idCourse, $order){
        $criteria = new CDbCriteria();
        $criteria->select = 'id_module, `order`';
        $criteria->condition = 'id_course='.$idCourse.' and `order`<'.$order;
        $criteria->order = '`order` DESC';
        $criteria->limit = 1;

        $result = CourseModules::model()->find($criteria)->id_module;

        return $result;
    }

    public static function getNextModule($idCourse, $order){
        $criteria = new CDbCriteria();
        $criteria->select = 'id_module, `order`';
        $criteria->condition = 'id_course='.$idCourse.' and `order`>'.$order;
        $criteria->order = '`order` ASC';
        $criteria->limit = 1;

        $result = CourseModules::model()->find($criteria)->id_module;

        return $result;
    }

    public static function sortByModuleDuration($idCourse, $modules)
    {
        for($i = 0,  $count = count($modules); $i < $count; $i++){
            $modules[$i]['lessonCount'] = Module::getLessonsCount($modules[$i]["id_module"]);
            $modules[$i]['durationInMonths'] = (integer)CourseModules::getModuleDurationMonths($modules[$i]["id_module"]);
            $modules[$i]['start'] = CourseModules::startMonth($idCourse, $modules[$i]["id_module"]);
        }
        usort($modules, 'CourseModules::sortByMandatoryModules');

        return $modules;
    }

    public static function sortByMandatoryModules($a, $b)
    {
        $startA = $a->start;
        $startB = $b->start;
        if ($startA == $startB) {
            $lessonCountA = $a->lessonCount;
            $lessonCountB = $b->lessonCount;
            if ($lessonCountA == $lessonCountB){
                $durationA = $a->durationInMonths;
                $durationB = $b->durationInMonths;
                if ($durationA == $durationB){
                    return ($lessonCountA < $lessonCountB) ? +1 : -1;
                } else {
                    return ($durationA < $durationB) ? +1 : -1;
                }
            } else {
                return 0;
            }
        } else {
            return ($startA < $startB) ? +1 : -1;
        }
    }

    public static function startMonth($idCourse, $idModule){
        $mandatory_module = CourseModules::model()->findByAttributes(array(
            'id_course' => $idCourse,
            'id_module' => $idModule
        ))->mandatory_modules;
        if ($mandatory_module == 0){
            return 0;
        } else {
            return CourseModules::startMonth($idCourse, $mandatory_module) +
            CourseModules::getModuleDurationMonths($mandatory_module);
        }
    }

    public static function getModuleDurationMonths($idModule){
        $lectureHoursInMonth = Module::lessonsInMonth($idModule);

        $lectureCount = Module::getLessonsCount($idModule);
        if($lectureHoursInMonth != 0){
            return ceil($lectureCount/$lectureHoursInMonth);
        } else {
            return 0;
        }
    }

    public static function checkModuleInCourse($idModule,$idCourse)
    {
        $module = CourseModules::model()->findByAttributes(array('id_module'=> $idModule,'id_course' =>$idCourse));

        if($module)
            return true;
        else return false;

    }
    public static function getCoursesListName($idModule){
        $courses = CourseModules::model()->findAllByAttributes(array(
            'id_module' => $idModule
        ));
        $coursesCount=count($courses);
        if($coursesCount==0){
            return false;
        }else{
            $list = [];
            for ($i = 0; $i < $coursesCount; $i++) {
                array_push($list, Course::getCourseName($courses[$i]->id_course));
            }
            return $list;
        }
    }

    public static function availableMandatoryModules($course, $module){
        $criteria = new CDbCriteria();
        $criteria->alias = 'm';
        $criteria->distinct = true;
        $criteria->join = 'LEFT JOIN course_modules cm ON cm.id_module = m.module_ID';
        $criteria->condition = 'cm.id_course='.$course.' and cm.id_module<>'.$module;

        return Module::model()->findAll($criteria);
    }

   public static function modulesInfoByCourse($course){
       $sql = 'select m.module_ID as id, m.title_ua as title, m.language as lang, m.cancelled as cancelled
              from module m
              left join course_modules cm on m.module_ID = cm.id_module
              where cm.id_course='.$course.' and m.cancelled='.Module::ACTIVE.'
              group by m.module_ID';

       return Yii::app()->db->createCommand($sql)->queryAll();
   }

    /**
     * Deletes specified module from course and update modules count in course.
     * @throws Exception
     */
    public function deleteModuleFromCourse() {
        $course=Course::model()->findByPk($this->id_course);
        $order = $this->order;
        if ($order == null) {
            // Now this method is called from a course instance,
            // so $order can be null only if specified module is absent in the course.
            throw new \application\components\Exceptions\ModuleNotFoundException();
        }
        
        $sqlUpdateOrder = "UPDATE `course_modules` SET `order`=`order`-1 WHERE `id_course` = $this->id_course AND `order` > $order";

        $connection = Yii::app()->db;
        $transaction = null;

        if ($connection->getCurrentTransaction() == null) {
            $transaction = $connection->beginTransaction();
        }
        try
        {
            $this->delete();
            $connection->createCommand($sqlUpdateOrder)->execute();
            if ($transaction != null) {
                $transaction->commit();
            }
        }
        catch(Exception $e)
        {
            if ($transaction != null) {
                $transaction->rollback();
            }
            throw $e;
        }
    }

    public static function setCourseProgress($modules, $courseAccess)
    {
        if($courseAccess) {
            foreach ($modules as $module){
                if(!$module->check)
                    CourseModules::setModuleProgressInCourse($module);
            }
        }else{
            foreach ($modules as $module){
                $module->access=false;
                $module->statusMessage=Yii::t('modul', '0954');
            }
        }
    }
    public static function setModuleProgressInCourse($module)
    {
        if(!$module->mandatory_modules){
            $moduleProgress = RatingUserModule::userModuleProgress($module->moduleInCourse->module_ID);

            $module->startTime=$moduleProgress?$module->moduleInCourse->getModuleStartTime():$module->moduleInCourse->getModuleStartTime();
            $module->finishTime=($moduleProgress && $moduleProgress->module_done)?$module->moduleInCourse->getModuleFinishedTime():$module->moduleInCourse->getModuleFinishedTime();
            $module->access=true;
            $module->check=true;

            if($module->finishTime) {
                return true;
            } else {
                return false;
            }
        } else {
            $moduleProgress=RatingUserModule::userModuleProgress($module->mandatoryCourseModule->moduleInCourse->module_ID);

            $module->mandatoryCourseModule->startTime=
                $moduleProgress?$module->mandatoryCourseModule->moduleInCourse->getModuleStartTime():
                    $module->mandatoryCourseModule->moduleInCourse->getModuleStartTime();
            $module->mandatoryCourseModule->finishTime=
                ($moduleProgress && $moduleProgress->module_done)?$module->mandatoryCourseModule->moduleInCourse->getModuleFinishedTime():
                $module->mandatoryCourseModule->moduleInCourse->getModuleFinishedTime();
            $module->mandatoryCourseModule->access=true;
            $module->mandatoryCourseModule->check=true;
            if($module->mandatoryCourseModule->finishTime &&
                (!$module->mandatoryCourseModule->mandatoryCourseModule || self::setModuleProgressInCourse($module->mandatoryCourseModule->mandatoryCourseModule))) {
                $module->access=true;
                $module->check=true;
                return true;
            }else{
                $module->statusMessage=CHtml::encode(Yii::t('modul', '0955').' "'.$module->mandatoryCourseModule->moduleInCourse->getTitle().'"');
                $module->access=false;
                $module->check=true;
                return false;
            }
        }
    }

    public function setModuleProgress($moduleAccess)
    {
        if($moduleAccess){
            $this->access=true;
            $moduleProgress = RatingUserModule::userModuleProgress($this->moduleInCourse->module_ID);

            $this->startTime=$moduleProgress?$this->moduleInCourse->getModuleStartTime():$this->moduleInCourse->getModuleStartTime();
            $this->finishTime=($moduleProgress && $moduleProgress->module_done)?$this->moduleInCourse->getModuleFinishedTime():$this->moduleInCourse->getModuleFinishedTime();
        }else{
            $this->access=false;
            $this->statusMessage=Yii::t('modul', '0954');
        }
    }
}
