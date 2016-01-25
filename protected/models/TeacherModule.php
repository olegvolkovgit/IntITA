<?php

/**
 * This is the model class for table "teacher_module".
 *
 * The followings are the available columns in table 'teacher_module':
 * @property integer $id
 * @property integer $idTeacher
 * @property integer $idModule
 * @property string $start_time
 * @property string $end_time
 *
 * The followings are the available model relations:
 * @property Module $idModule0
 * @property Teacher $idTeacher0
 */
class TeacherModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idTeacher, idModule', 'required'),
			array('idTeacher, idModule', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, idTeacher, idModule, start_time, end_time', 'safe', 'on'=>'search'),
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
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idTeacher' => 'Id Teacher',
			'idModule' => 'Id Module',
            'start_time' => 'Start time',
            'end_time' => 'End time'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('idTeacher',$this->idTeacher);
		$criteria->compare('idModule',$this->idModule);
        $criteria->compare('start_time',$this->start_time);
        $criteria->compare('end_time',$this->end_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getCourseTeachers($modules){
        $criteria = new CDbCriteria();
        $criteria->select =  'idTeacher';
        $criteria->order = 'idTeacher';
        $criteria->addInCondition('idModule', $modules);
        $criteria->distinct = true;
        $criteria->toArray();

        $teachers = TeacherModule::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < count($teachers); $i++){
            array_push($result, $teachers[$i]["idTeacher"]);
        }
        return $result;
    }

    public static function addTeacherAccess($teacher, $module){
        $model = new TeacherModule();
        if (!TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
            ':teacher' => $teacher,
            ':module' => $module,
        ))){
            $model->idTeacher = $teacher;
            $model->idModule = $module;
            if ($model->validate()){
                $model->save();
            }
        }
    }

    public static function getAuthorModules($author){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'order' => 'idTeacher',
            'params' => array(':id' => $author),
        ))->queryAll();

        return (!empty($modules))?$modules:[];
    }

    public static function getModulesByTeacher($teacher){
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'order' => 'idModule',
            'params' => array(':id' => $teacher),
        ))->queryAll();
        $count = count($modules);
        $titleParam = Module::getModuleTitleParam();

        for($i = 0;$i < $count;$i++){
            $modules[$i]['id'] = $modules[$i]["idModule"];
            $modules[$i]['title'] = Module::model()->findByPk($modules[$i]["idModule"])->$titleParam;
        }

        return (!empty($modules))?$modules:[];
    }

    public static function cancelTeacherAccess($teacher, $module){
        if (TeacherModule::model()->exists('idTeacher=:teacher AND idModule=:module', array(
            ':teacher' => $teacher,
            ':module' => $module,
        ))){
            TeacherModule::model()->deleteAllByAttributes(array('idTeacher' => $teacher, 'idModule' => $module));
        }
    }

    public static function showTeacherModule($idTeacher)
    {
        $first = '<select class="form-control" name="module" required="true">';

        $modulelist = [];
        $criteria = new CDbCriteria;
        $criteria->alias = 'teacher_modules';
        $criteria->select = 'idModule';
        $criteria->distinct = true;
        $criteria->addCondition('idTeacher=' . $idTeacher);
        $temp = TeacherModule::model()->findAll($criteria);
        for ($i = 0; $i < count($temp); $i++) {
            array_push($modulelist, $temp[$i]->idModule);
        }

        $titleParam = Module::getModuleTitleParam();

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $result = $first . '<option value="">' . Yii::t('payments', '0606') . '</option>
                   <optgroup label="' . Yii::t('payments', '0607') . '">';
        $rows = Module::model()->findAll($criteriaData);
        foreach ($rows as $numRow => $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            $result = $result . '<option value="' . $row['module_ID'] . '">' .$row[$title]." (".$row['language'].") ".'</option>';
        };
        $last = '</select>';

        return $result . $last;
    }


}
