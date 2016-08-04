<?php

/**
 * This is the model class for table "vc_course_module".
 *
 * The followings are the available columns in table 'vc_course_module':
 * @property integer $id
 * @property integer $id_course_revision
 * @property integer $id_module
 * @property integer $module_order
 *
 * The followings are the available model relations:
 * @property RevisionCourse $course
 * @property RevisionModule $module
 */
class RevisionCourseModule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_course_module';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_course_revision, id_module, module_order', 'required'),
			array('id_course_revision, id_module, module_order', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_course_revision, id_module, module_order', 'safe', 'on'=>'search'),
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
			'course' => array(self::BELONGS_TO, 'RevisionCourse', 'id_course_revision'),
			'module' => array(self::HAS_ONE, 'Module', ['module_ID'=>'id_module']),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_course_revision' => 'Id Course Revision',
			'id_module' => 'Id Module',
			'module_order' => 'Module Order',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_course_revision',$this->id_course_revision);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('module_order',$this->module_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionCourseModule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function cloneCourseModule($idNewRevision = null) {

		if ($idNewRevision == null) {
			$idNewRevision = $this->id_course_revision;
		}

		$connection = Yii::app()->db;
		$transaction = null;

		if ($connection->getCurrentTransaction() == null) {
			$transaction = $connection->beginTransaction();
		}

		try {
			$newRevision = new RevisionCourseModule();

			$newRevision->id_module = $this->id_module;
			$newRevision->id_course_revision = $idNewRevision;
			$newRevision->module_order = $this->module_order;

			$newRevision->saveCheck();

			if ($transaction != null) {
				$transaction->commit();
			}
		} catch (Exception $e) {
			if ($transaction != null) {
				$transaction->rollback();
			}
			throw $e;
		}

		return $newRevision;
	}

	public function saveCourseModuleToRegularDB()
	{
		$courseModule = new CourseModules();
		$courseModule->id_course = $this->course->id_course;
		$courseModule->id_module = $this->id_module;
		$courseModule->order = $this->module_order;
		if ($courseModule->save()) {
			return $this;
		}else{
			throw new RevisionException('400','Помилка, при збережені модулів в курсі');
		}
	}

	public function saveCheck() {
		if(!$this->save()) {
			throw new RevisionException('400',$this->getValidationErrors());
		}
	}

	public function getValidationErrors() {
		$errors=[];
		foreach($this->getErrors() as $key=>$attribute){
			foreach($attribute as $error){
				array_push($errors,$key.': '.$error);
			}
		}
		return implode(", ", $errors);
	}
}
