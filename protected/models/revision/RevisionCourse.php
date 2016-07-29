<?php

/**
 * This is the model class for table "vc_course".
 *
 * The followings are the available columns in table 'vc_course':
 * @property integer $id_course_revision
 * @property integer $id_parent
 * @property integer $id_course
 * @property integer $id_properties
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property RevisionCourseProperties $properties
 * @property RevisionCourseModule[] $courseModules
 */
class RevisionCourse extends CRevisionUnitActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_course, id_properties', 'required'),
			array('id_parent, id_course, id_properties', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_course_revision, id_parent, id_course, id_properties', 'safe', 'on'=>'search'),
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
			'course' => array(self::BELONGS_TO, 'Course', 'id_course'),
			'properties' => array(self::HAS_ONE, 'RevisionCourseProperties', ['id'=>'id_properties']),
			'courseModules' => array(self::HAS_MANY, 'RevisionCourseModule', 'id_course_revision',
                'order' => 'module_order ASC'
                ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_course_revision' => 'Id Course Revision',
			'id_parent' => 'Id Parent',
			'id_course' => 'Id Course',
			'id_properties' => 'Id Properties',
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

		$criteria->compare('id_course_revision',$this->id_course_revision);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_course',$this->id_course);
		$criteria->compare('id_properties',$this->id_properties);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionCourse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getCourseRevisionsAuthors($idCourse=null) {
		$authors=array();
		if ($idCourse != null) {
			$qs = 'SELECT DISTINCT id_user_created FROM `vc_course` `t` LEFT OUTER JOIN `vc_course_properties` `properties` ON (`properties`.`id` = `t`.`id_properties`) WHERE id_course = '.$idCourse;
			$revisions = Yii::app()->db->createCommand($qs)->queryAll();

			foreach ($revisions as $key=>$author){
				$authors[$key]['id']=$author["id_user_created"];
				$authors[$key]['authorName'] =StudentReg::getUserNamePayment($author);
			}
		} else {
			$criteria = new CDbCriteria;
			$criteria->distinct = true;
			$criteria->select = 'id_user_created';
			$revisions = RevisionCourseProperties::model()->findAll($criteria);
			foreach ($revisions as $key=>$author){
				$authors[$key]['id']=$author["id_user_created"];
				$authors[$key]['authorName'] =StudentReg::getUserNamePayment($author["id_user_created"]);
			}
		}
		return $authors;
	}

	/**
	 * revisions id list after filtered
	 */
	public static function getFilteredIdRevisions($status, $idCourse=null,$idAuthor=null) {
		$sqlCancelledEditor = "(vcp.id_state = " . RevisionState::CancelledAuthorState . ")";
		$sqlCancelled = "(vcp.id_state = " . RevisionState::CancelledState . ")";
		$sqlReady = "(vcp.id_state = " . RevisionState::ReleasedState . ")";
		$sqlApproved = "(vcp.id_state = " . RevisionState::ApprovedState . ")";
		$sqlRejected = "(vcp.id_state = " . RevisionState::RejectedState . ")";
		$sqlSent = "(vcp.id_state = " . RevisionState::SendForApprovalState . ")";
		$sqlEditable = "(vcp.id_state = " . RevisionState::EditableState . ")";


		$finalSql = '';
		$authorSql = '';
		if($status) {
			foreach ($status as $key => $sql) {
				if ($sql == 'true') {
					switch ($key) {
						case 'approved':
							$finalSql = $finalSql . ' or ' . $sqlApproved;
							break;
						case 'editable';
							$finalSql = $finalSql . ' or ' . $sqlEditable;
							break;
						case 'sent';
							$finalSql = $finalSql . ' or ' . $sqlSent;
							break;
						case 'reject';
							$finalSql = $finalSql . ' or ' . $sqlRejected;
							break;
						case 'cancelled';
							$finalSql = $finalSql . ' or ' . $sqlCancelled;
							break;
						case 'cancelledEditor';
							$finalSql = $finalSql . ' or ' . $sqlCancelledEditor;
							break;
						case 'release';
							$finalSql = $finalSql . ' or ' . $sqlReady;
							break;
						default:
							$finalSql = '';
							break;
					};
				}
			}
		}

		if($idAuthor){
			$authorSql=" and (vcp.id_user_created=".$idAuthor.")";
		}
		if($idAuthor && $finalSql==''){
			$finalSql=true;
		}else{
			$finalSql = substr($finalSql, 3);
		}

		if($idCourse==null){
			$sql="SELECT DISTINCT vcc.id_course_revision FROM vc_course vcc LEFT JOIN vc_course_properties vcp ON vcp.id=vcc.id_properties
            WHERE (".$finalSql.")".$authorSql;
		}else{
			$sql="SELECT DISTINCT vcc.id_course_revision FROM vc_course vcc LEFT JOIN vc_course_properties vcp ON vcp.id=vcc.id_properties
            WHERE vcc.id_course=".$idCourse." 
            and (".$finalSql.")".$authorSql;
		}
		$list = Yii::app()->db->createCommand($sql)->queryAll();
		$actualIdList = [];
		foreach ($list as $item) {
			array_push($actualIdList, $item['id_course_revision']);
		}
		return $actualIdList;
	}

	/**
	 * Returns course QuickUnion structure.
	 * If $idCourse specified - returns revisions of this course, else - all revisions
	 * @param null|$idCourse
	 * @return array
	 */
	public static function getCourseTree($idCourse = null) {
		if ($idCourse != null) {
			$allIdList = Yii::app()->db->createCommand()
				->select('id_course_revision, id_parent')
				->from('vc_course')
				->where('id_course='.$idCourse)
				->queryAll();
		} else {
			$allIdList = Yii::app()->db->createCommand()
				->select('id_course_revision, id_parent')
				->from('vc_course')
				->queryAll();
		}

		return RevisionCourse::getQuickUnionStructure($allIdList);
	}

	/**
	 * Returns a Quick Union Structure of related lectures id.
	 * Algorithm based on Quick-Union algorithm
	 * http://algs4.cs.princeton.edu/15uf/
	 * It is important ot keep tree structure, so here is no optimizations
	 *
	 * @return array
	 */
	private static function getQuickUnionStructure($allIdList) {
		// building union data structure;
		// array key represents the elements's id (id_revision),
		// and array value represents link to root element of this element,
		// if element is root its value equal to key

		$quickUnion = array();
		foreach($allIdList as $item) {
			$quickUnion[$item['id_course_revision']] = ($item['id_parent'] == null ? $item['id_course_revision'] : $item['id_parent']);
		};
		return $quickUnion;
	}

	/**
	 * Return status accessibility for course revision
	 * @return array
	 */
	public function statusList() {
		$status=array();

		$isRevisionCreator=$this->properties->id_user_created == Yii::app()->user->getId();
		$isApprover=Yii::app()->user->model->canApprove();

		$status['canEdit'] =  $status['canCancelEdit'] = $status['canSend'] =$isRevisionCreator && $this->isEditable();
		$status['canRestoreEdit'] = $isRevisionCreator && $this->isCancelledEditor();
		$status['canCancelSend'] = $isRevisionCreator && $this->isSended();
		$status['canApprove'] = $status['canReject'] = $isApprover && $this->isSended();
		$status['canCancel'] =  $isApprover && $this->isCancellable();
		$status['canRelease'] = $isApprover && $this->isReleaseable();

		return $status;
	}

	/**
	 * Creates new revision from existing course
	 * @param Course $course
	 * @param $user
	 * @return RevisionCourse
	 * @throws Exception
	 * todo refactor
	 */
	public static function createNewRevisionFromCourse($course, $user) {

		$revCourse = null;
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$revCourseProperties = new RevisionCourseProperties();
			$revCourseProperties->title_ua = $course->title_ua;
			$revCourseProperties->title_ru = $course->title_ru;
			$revCourseProperties->title_en = $course->title_en;
			$revCourseProperties->course_img = $course->course_img;
			$revCourseProperties->alias = $course->alias;
			$revCourseProperties->language = $course->language;
			$revCourseProperties->course_price = $course->course_price;
			$revCourseProperties->for_whom_ua = $course->for_whom_ua;
			$revCourseProperties->what_you_learn_ua = $course->what_you_learn_ua;
			$revCourseProperties->what_you_get_ua = $course->what_you_get_ua;
			$revCourseProperties->for_whom_ru = $course->for_whom_ru;
			$revCourseProperties->what_you_learn_ru = $course->what_you_learn_ru;
			$revCourseProperties->what_you_get_ru = $course->what_you_get_ru;
			$revCourseProperties->for_whom_en = $course->for_whom_en;
			$revCourseProperties->what_you_learn_en = $course->what_you_learn_en;
			$revCourseProperties->what_you_get_en = $course->what_you_get_en;
			$revCourseProperties->level = $course->level;
			$revCourseProperties->course_number = $course->course_number;
			$revCourseProperties->cancelled = $course->cancelled;
			$revCourseProperties->status = $course->status;
			$revCourseProperties->start_date = new CDbExpression('NOW()');
			$revCourseProperties->id_user_created = $user->getId();
			$revCourseProperties->id_user = $user->getId();
			$revCourseProperties->change_date = new CDbExpression('NOW()');
			$revCourseProperties->id_state = RevisionState::ReleasedState;
			$revCourseProperties->saveCheck();

			$revCourse = new RevisionCourse();
			$revCourse->id_course = $course->course_ID;
			$revCourse->id_properties = $revCourseProperties->id;
			$revCourse->saveCheck();
			
			// modules
			foreach ($course->module as $key=>$module) {
				$revNewCourseModule = new RevisionCourseModule();
				$revNewCourseModule->id_module = $module->id_module;
				$revNewCourseModule->id_course_revision = $revCourse->id_course_revision;
				$revNewCourseModule->module_order =$key+1;
				$revNewCourseModule->saveCheck();
			}

			$transaction->commit();

		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		return $revCourse;
	}

	/**
	 * Clones $this into new db instance.
	 * Returns new course instance or current instance if the course is not cloneable
	 * @param $user
	 * @return RevisionCourse
	 * @throws Exception
	 */
	public function cloneCourse($user) {
		$transaction = Yii::app()->db->beginTransaction();
		try {
			$newRevision = new RevisionCourse();
			$newRevision->id_parent = $this->id_course_revision;
			$newRevision->id_course = $this->id_course;
			$newProperties = $this->properties->cloneProperties($user);
			$newRevision->id_properties = $newProperties->id;

			$newRevision->saveCheck();

			foreach ($this->courseModules as $module) {
				$module->cloneCourseModule($newRevision->id_course_revision);
			}

			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}

		return $newRevision;
	}

	public function editProperties($params, $user) {

		$filtered = [];
		foreach (RevisionCourse::getEditableProperties() as $property) {
			if (isset($params[$property])) {
				$filtered[$property] = $params[$property];
			}
		}

		$this->properties->setAttributes($filtered);
		$this->properties->saveCheck();
		$this->setUpdateDate($user);
	}

	/**
	 * Returns list of properties which can be edited
	 * @return array
	 */
	public static function getEditableProperties() {
		return ['title_ua', 'title_ru', 'title_en','for_whom_ua',
			'what_you_learn_ua','what_you_get_ua','for_whom_ru',
			'what_you_learn_ru','what_you_get_ru','for_whom_en',
			'what_you_learn_en','what_you_get_en','level'];
	}

	private function setUpdateDate($user) {
		$this->properties->setUpdateDate($user);
	}

	public function checkConflicts() {
		$result = array();
		$moduleIdList=[];

		foreach($this->courseModules as $module){
			array_push($moduleIdList, $module->id_module);
		}
		$uniqueArr=array_unique($moduleIdList);
		if(count($moduleIdList)>count($uniqueArr)){
			$result='Курс не може містити однакові модулі';
		}

		return $result;
	}

	public function editModulesList($courseModules, $user) {

		$connection = Yii::app()->db;
		$transaction = $connection->beginTransaction();

		try {
			$currentModules = [];
			foreach ($this->courseModules as $courseModule) {
				array_push($currentModules, $courseModule->id_module);
			}

			/* Remove current modules related to the course revision and insert new modules*/
			$removeCurrentModulesSQL = "DELETE FROM `vc_course_module` WHERE `id_course_revision`=".$this->id_course_revision.";";
			$rowCount = $connection->createCommand($removeCurrentModulesSQL)->execute();

			if ($rowCount != count($this->courseModules)) {
				throw new Exception('Error while delete modules #1.');
			}

			$values = [];
			foreach ($courseModules as $addModule) {
				$str = "(".$this->id_course_revision . ','. $addModule['id_module'] . ',' . $addModule['module_order'].")";
				array_push($values, $str);
			}
			if (count($values)) {
				$addLecturesSQL = "INSERT INTO `vc_course_module` (`id_course_revision`, `id_module`, `module_order`) VALUES ".implode(',', $values).";";
				$rowCount = $connection->createCommand($addLecturesSQL)->execute();

				if ($rowCount != count($values)) {
					throw new Exception('Error while delete modules #2.');
				}
			}
			$transaction->commit();
		} catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}

		$this->refresh();
	}

	public function deleteCourseModulesFromRegularDB() {
		$course=Course::model()->findByPk($this->id_course);
		//remove all modules from course
		$connection = Yii::app()->db;
		$transaction = null;

		if ($connection->getCurrentTransaction() == null) {
			$transaction = $connection->beginTransaction();
		}
		try {
			foreach ($course->module as $row){
				$row->deleteModuleFromCourse();
			}
			if ($transaction != null) {
				$transaction->commit();
				return true;
			}
		} catch (Exception $e) {
			if ($transaction != null) {
				$transaction->rollback();
			}
			throw $e;
		}
		return false;
	}
	
	public function saveCoursePropertiesToRegularDB() {
		$module=Course::model()->findByPk($this->id_course);
		$module->course_img = $this->properties->course_img;
		$module->alias = $this->properties->alias;
		$module->title_ua = $this->properties->title_ua;
		$module->title_ru = $this->properties->title_ru;
		$module->title_en = $this->properties->title_en;
		$module->for_whom_ua = $this->properties->for_whom_ua;
		$module->what_you_learn_ua = $this->properties->what_you_learn_ua;
		$module->what_you_get_ua = $this->properties->what_you_get_ua;
		$module->for_whom_ru = $this->properties->for_whom_ru;
		$module->what_you_learn_ru = $this->properties->what_you_learn_ru;
		$module->what_you_get_ru = $this->properties->what_you_get_ru;
		$module->for_whom_en = $this->properties->for_whom_en;
		$module->what_you_learn_en = $this->properties->what_you_learn_en;
		$module->what_you_get_en = $this->properties->what_you_get_en;
		$module->level = $this->properties->level;
		$module->language = $this->properties->language;
		$module->course_price = $this->properties->course_price;
		$module->cancelled = $this->properties->cancelled;
		$module->status = 1;
		$module->update();
	}

	public function cancelReleasedCourseInTree($user){
		$courseRevisions = RevisionCourse::model()->findAllByAttributes(array('id_course'=>$this->id_course));
		foreach ($courseRevisions as $courseRevision) {
			if ($courseRevision->isReleased()) {
				$courseRevision->state->changeTo('cancel', $user);
			}
		}
	}
	
	/**
	 * Returns course QuickUnion structure.
	 * If $idCourse specified - returns revisions of this course, else - all revisions
	 * @return array
	 */
	public static function getCoursesTree() {
		$allIdList = Yii::app()->db->createCommand()
			->select('id_course_revision, id_parent')
			->from('vc_course')
			->queryAll();

		return RevisionCourse::getQuickUnionStructure($allIdList);
	}
	
	/**
	 * Save properties model with error checking
	 * @throws RevisionException
	 */
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
