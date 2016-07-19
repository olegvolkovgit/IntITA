<?php

/**
 * This is the model class for table "vc_lecture".
 *
 * The followings are the available columns in table 'vc_lecture':
 * @property integer $id_revision
 * @property integer $id_parent
 * @property integer $id_lecture
 * @property integer $id_module
 * @property integer $id_properties
 *
 * The followings are the available model relations:
 * @property RevisionLectureProperties $properties
 * @property RevisionLecturePage[] $lecturePages
 * @property RevisionLecture $parent
 * @property Module $module
 * @property RevisionModuleLecture $moduleOrder
 * @property RevisionStateBehavior $state
 */
class RevisionLecture extends CRevisionUnitActiveRecord {

    protected $approveResultCashed = null;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vc_lecture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_parent, id_lecture, id_module, id_properties', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_revision, id_parent, id_lecture, id_module, id_properties', 'safe', 'on' => 'search'),
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
            'parent' => array(self::HAS_ONE, 'RevisionLecture', ['id_revision'=>'id_parent']),
            'properties' => array(self::HAS_ONE, 'RevisionLectureProperties', ['id'=>'id_properties']),
			'lecturePages' => array(self::HAS_MANY, 'RevisionLecturePage', 'id_revision',
                                                        'order' => 'page_order ASC'),
            'moduleOrder' => array(self::HAS_ONE, 'RevisionModuleLecture',  'id_lecture_revision'),
            'module' => array(self::BELONGS_TO, 'Module', 'id_module')
		);
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_revision' => 'Id Revision',
            'id_parent' => 'Id Parent',
            'id_lecture' => 'Id Lecture',
            'id_module' => 'Id Module',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_revision', $this->id_revision);
        $criteria->compare('id_parent', $this->id_parent);
        $criteria->compare('id_lecture', $this->id_lecture);
        $criteria->compare('id_module', $this->id_module);
        $criteria->compare('id_properties', $this->id_properties);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RevisionLecture the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Save lecture model with error checking
     * @throws RevisionLectureException
     */
    public function saveCheck() {
        if (!$this->save()) {
            throw new RevisionLectureException(implode(", ", $this->getErrors()));
        }
    }

    /**
     * Creates new lecture according to params
     * @param $idModule
     * @param $titleUa
     * @param $titleEn
     * @param $titleRu
     * @param $user
     * @return RevisionLecture
     * @throws RevisionLectureException
     */
    public static function createNewLecture($idModule, $titleUa, $titleEn, $titleRu, $user) {
        $revLectureProperties = new RevisionLectureProperties();
        $revLectureProperties->initialize($titleUa, $titleEn, $titleRu, $user);

        $revLecture = new RevisionLecture();
        $revLecture->id_module = $idModule;
        $revLecture->id_properties = $revLectureProperties->id;

        $revLecture->saveCheck();

        $revLecturePage = new RevisionLecturePage();
        $revLecturePage->initialize($revLecture->id_revision);

        return $revLecture;
    }

    /**
     * Adds page to current lecture revision
     * @param $user
     * @return RevisionLecturePage
     */
    public function addPage($user) {
        $revLecturePage = new RevisionLecturePage();
        $revLecturePage->initialize($this->id_revision, $this->getLastPageOrder() + 1);
        $this->setUpdateDate($user);
        return $revLecturePage;
    }

    /**
     * Check conflicts into lecture revision
     * @return array with error messages or empty array
     */
    public function checkConflicts() {
        $result = array();

        //check if at least one approved page exist
        if (count($this->lecturePages) == 0) {
            array_push($result, "Не можна відправити ревізію на затвердження без жодної частини.");
        }

        //count all orders
        $orders = array();
        foreach ($this->lecturePages as $page) {
            if (isset($orders[$page->page_order])) {
                $orders[$page->page_order]['count']++;
                array_push($orders[$page->page_order]['lectures'], $page->id);
            } else {
                $orders[$page->page_order] = array('order' => $page->page_order, 'count' => 1, 'lectures' => array($page->id));
            }
            $quiz = $page->getQuiz();
            if ($quiz != null && $quiz->id_type == LectureElement::TASK) {
                $task = RevisionTask::model()->findByAttributes(array('id_lecture_element' => $quiz->id));
                if (!$task->existenceInterpreterTask()) {
                    array_push($result, "Не можна відправити ревізію на затвердження, якщо задачі не містять юніттестів");
                    break;
                }
            }
        }
        //process orders array to find collision and generate result
        foreach ($orders as $value) {
            $str = "";
            if ($value['count'] > 1) {
                $str = "Lectures ";
                foreach ($value['lectures'] as $lectureId) {
                    $str .= "id #" . $lectureId . " ";
                }
                $str .= 'has same order (' . $value['order'] . '). ';
                array_push($result, $str);
            }
        }

        $this->approveResultCashed = $result;
        return $result;
    }

    protected function getMessageClasses() {
        return array_merge(parent::getMessageClasses(), [
            'reject' => 'MessagesRejectRevision',
            'approve' => 'MessagesApproveRevision'
        ]);
    }

    /**
     * Clones $this into new db instance.
     * Returns new lecture instance
     * @param $user
     * @param bool $newModule
     * @return RevisionLecture
     * @throws Exception
     */
    public function cloneLecture($user, $newModule = false) {
        $connection = Yii::app()->db;
        $transaction = null;

        if ($connection->getCurrentTransaction() == null) {
            $transaction = $connection->beginTransaction();
        }
        try {
            $newRevision = new RevisionLecture();
            $newRevision->id_parent = !$newModule ? $this->id_revision : null;
            $newRevision->id_lecture = !$newModule ? $this->id_lecture : null;
            $newRevision->id_module = !$newModule ? $this->id_module: $newModule;

            $newProperties = $this->properties->cloneProperties($user, $newModule);
            $newRevision->id_properties = $newProperties->id;

            $newRevision->saveCheck();

            foreach ($this->lecturePages as $page) {
                $page->clonePage($newRevision->id_revision, $newModule);
            }
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

    /**
     * Returns related revisions list
     * @return RevisionLecture[]
     */
    public function getRelatedLectures() {
        return RevisionLecture::model()->with('properties')->findAllByPk($this->getRelatedIdList());
    }

    /**
     * Creates new revision from existing lecture
     * @param Lecture $lecture
     * @param $user
     * @return RevisionLecture
     * @throws Exception
     * todo refactor
     */
    public static function createNewRevisionFromLecture($lecture, $user) {

        $revLecture = null;

        $connection = Yii::app()->db;
        $transaction = null;

        if ($connection->getCurrentTransaction() == null) {
            $transaction = $connection->beginTransaction();
        }
        try {
            $revLectureProperties = new RevisionLectureProperties();
            $revLectureProperties->image = $lecture->image;
            $revLectureProperties->alias = $lecture->alias;
            $revLectureProperties->id_type = $lecture->idType;
            $revLectureProperties->is_free = $lecture->isFree;
            $revLectureProperties->title_ua = $lecture->title_ua;
            $revLectureProperties->title_ru = $lecture->title_ru;
            $revLectureProperties->title_en = $lecture->title_en;
            $revLectureProperties->start_date = new CDbExpression('NOW()');
            $revLectureProperties->id_user_created = $user->getId();
            $revLectureProperties->id_state = RevisionState::ReleasedState;
            $revLectureProperties->id_user = $user->getId();
            $revLectureProperties->change_date = new CDbExpression('NOW()');
            $revLectureProperties->saveCheck();

            $revLecture = new RevisionLecture();
            $revLecture->id_module = $lecture->idModule;
            $revLecture->id_lecture = $lecture->id;
            $revLecture->id_properties = $revLectureProperties->id;
            $revLecture->saveCheck();

            // pages

            foreach ($lecture->pages as $page) {
                $revNewPage = new RevisionLecturePage();
                $revNewPage->id_revision = $revLecture->id_revision;
                $revNewPage->page_title = $page->page_title;
                $revNewPage->page_order = $page->page_order;
                $revNewPage->saveCheck();

                $video = LectureElement::model()->findByPk($page->video);
                if ($video != null) {
                    $revVideo = new RevisionLectureElement();
                    $revVideo->id_page = $revNewPage->id;
                    $revVideo->id_type = $video->id_type;
                    $revVideo->block_order = $video->block_order;
                    $revVideo->html_block = $video->html_block;
                    $revVideo->saveCheck();
                    $revNewPage->video = $revVideo->id;
                }


                if ($page->quiz) {
                    //todo
                    $lectureElement = LectureElement::model()->findByPk($page->quiz);

                    $revLectureElement = new RevisionLectureElement();
                    $revLectureElement->id_page = $revNewPage->id;
                    $revLectureElement->id_type = $lectureElement->id_type;
                    $revLectureElement->block_order = $lectureElement->block_order;
                    $revLectureElement->html_block = $lectureElement->html_block;
                    $revLectureElement->saveCheck();

                    RevisionQuizFactory::createFromLecture($lectureElement, $revLectureElement);

                    $revNewPage->quiz = $revLectureElement->id;
                }

                foreach ($page->getLectureElements() as $lectureElement) {
                    if ($lectureElement->isTextBlock()) {
                        $revLectureElement = new RevisionLectureElement();
                        $revLectureElement->id_page = $revNewPage->id;
                        $revLectureElement->id_type = $lectureElement->id_type;
                        $revLectureElement->block_order = $lectureElement->block_order;
                        $revLectureElement->html_block = $lectureElement->html_block;
                        $revLectureElement->saveCheck();
                    }

                }

                $revNewPage->saveCheck();

            }

            if ($transaction != null) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            if ($transaction != null) {
                $transaction->rollback();
            }
            throw $e;
        } 
        return $revLecture;
    }

    /**
     * Deletes lecture related with revision with id_Lecture form regular DB
     */
    public function deleteLectureFromRegularDB() {
        //remove old data if lecture exists in regular DB
        if ($this->id_lecture != null) {
            $this->removePreviousRecords();
        }
    }

    /**
     * Returns lecture QuickUnion structure.
     * If $idModule specified - returns revisions of this module, else - all revisions
     * @param null|$idModule
     * @return array
     */
    public static function getLecturesTree($idModule = null) {
        if ($idModule != null) {
            $allIdList = Yii::app()->db->createCommand()
                ->select('id_revision, id_parent')
                ->from('vc_lecture')
                ->where('id_module=' . $idModule)
                ->queryAll();
        } else {
            $allIdList = Yii::app()->db->createCommand()
                ->select('id_revision, id_parent')
                ->from('vc_lecture')
                ->queryAll();
        }

        return RevisionLecture::getQuickUnionStructure($allIdList);
    }

    /**
     * @param integer $pageId
     * @param array $lectureElementData ['idType' => 'foo', 'html_block' => 'bar', quiz=>[] ]
     * @param $user
     * @throws RevisionLecturePageException
     */
    public function addLectureElement($pageId, $lectureElementData, $user) {
        $page = $this->getPageById($pageId);
        if ($page) {
            if (array_key_exists('quiz', $lectureElementData)) {
                $quiz = $lectureElementData['quiz'];
                /* pass module id for getting quiz uid*/
                $quiz['idModule'] = $this->id_module;
            } else {
                $quiz = null;
            }
            $page->addLectureElement($lectureElementData['idType'], $lectureElementData['html_block'], $quiz);
            $this->setUpdateDate($user);
        }
    }

    /**
     * @param integer $pageId
     * @param array $lectureElementData ['id_block' => 'foo', 'html_block' => 'bar', quiz=>[]]
     * @param $user
     */
    public function editLectureElement($pageId, $lectureElementData, $user) {
        $page = $this->getPageById($pageId);
        if ($page) {
            $quiz = array_key_exists('quiz', $lectureElementData) ? $lectureElementData['quiz'] : null;
            $page->editLectureElement($lectureElementData['id_block'], $lectureElementData['html_block'], $quiz);
            $this->setUpdateDate($user);
        }
    }

    public function deleteLectureElement($pageId, $idBlock, $user) {
        $page = $this->getPageById($pageId);
        if ($page && $page->deleteLectureElement($idBlock)) {
            $this->setUpdateDate($user);
            return true;
        }
        return false;
    }

    public function setPageTitle($idPage, $title, $user) {
        $page = $this->getPageById($idPage);
        $page->setTitle($title);
        $this->setUpdateDate($user);
    }

    public function movePageUp($idPage, $user) {
        $page = $this->getPageById($idPage);
        if ($page) {
            $page->moveUp();
            $this->setUpdateDate($user);
        }
    }

    public function movePageDown($idPage, $user) {
        $page = $this->getPageById($idPage);
        if ($page) {
            $page->moveDown();
            $this->setUpdateDate($user);
        }
    }

    public function upElement($idPage, $idElement, $user) {
        $page = $this->getPageById($idPage);
        if ($page) {
            $page->upElement($idElement);
            $this->setUpdateDate($user);
        }
    }

    public function downElement($idPage, $idElement, $user) {
        $page = $this->getPageById($idPage);
        if ($page) {
            $page->downElement($idElement);
            $this->setUpdateDate($user);
        }
    }

    public function editProperties($params, $user) {
        $filtered = [];
        foreach (RevisionLecture::getEditableProperties() as $property) {
            if (isset($params[$property])) {
                $filtered[$property] = $params[$property];
            }
        }
        $this->properties->setAttributes($filtered);
        $this->properties->saveCheck();
        $this->setUpdateDate($user);
    }

    public function deletePage($idPage, $user) {
        $page = $this->getPageById($idPage);
        if ($page && $page->delete()) {
            $this->setUpdateDate($user);
            return true;
        }
        return false;
    }

    /**
     * Returns list of properties which can be edited
     * @return array
     */
    public static function getEditableProperties() {
        return ['title_ua', 'title_ru', 'title_en'];
    }

    /**
     * Returns lecture page of this lecture by Id or null
     * @param $pageId
     * @return null|RevisionLecturePage
     */
    private function getPageById($pageId) {
        foreach ($this->lecturePages as $lecturePage) {
            if ($lecturePage->id == $pageId) {
                return $lecturePage;
            }
        }
        return null;
    }

    /**
     * Flushes current revision into regular DB.
     * @throws RevisionLectureException
     */
    public function saveToRegularDB($user) {

        //write new data
        $newLecture = $this->saveLectureModelToRegularDB();
        $idNewLecture = $newLecture->id;

        foreach ($this->lecturePages as $page) {
            $page->savePageModelToRegularDB($idNewLecture, $this->properties->id_user_created);
        }

        //remove old data if lecture exists in regular DB
        if ($this->id_lecture != null) {
            $this->removePreviousRecords();
        }

        $this->saveCheck();
        $this->setLectureIdInTree($newLecture->id);
//        $this->cancelLecturesInTree($user);

        $newLecture->refresh();

        return $newLecture;
    }

    /**
     * Creates new lecture in regular DB
     * @return Lecture
     */
    private function saveLectureModelToRegularDB($order=null) {

        $newLecture = new Lecture();
        $newLecture->idModule = $this->id_module;
        $newLecture->title_ua = $this->properties->title_ua;
        $newLecture->title_ru = $this->properties->title_ru;
        $newLecture->title_en = $this->properties->title_en;
        $newLecture->image = $this->properties->image;
        $newLecture->alias = $this->properties->alias;

        //todo order from module;
//        $newLecture->order = $this->properties->order;
        if($order){
            $newLecture->order = $order;
        }else{
            if ($this->id_lecture != null && Lecture::model()->findByPk($this->id_lecture)) {
                $newLecture->order = Lecture::model()->findByPk($this->id_lecture)->order;
            } else {
                $newLecture->order = $newLecture->lastLectureOrder() + 1;
            }
        }

        $newLecture->idType = $this->properties->id_type;
        $newLecture->isFree = $this->properties->is_free;
        $newLecture->verified = 1;
        $newLecture->save();
        return $newLecture;
    }

    /**
     * Clear regular DB from lecture (pages and elements) witch should be replaced
     * @throws CDbException
     */
    public function removePreviousRecords() {
        $oldLecture = Lecture::model()->findByPk($this->id_lecture);

        if ($oldLecture) {
            //remove lecture pages

            $oldLecturePages = LecturePage::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id_lecture));

            $builder = Yii::app()->db->schema->getCommandBuilder();
            foreach ($oldLecturePages as $oldLecturePage) {
                $command = $builder->createDeleteCommand('lecture_element_lecture_page', new CDbCriteria(array(
                    "condition" => "page=" . $oldLecturePage->id
                )));
                $command->query();
            }

            foreach ($oldLecturePages as $oldLecturePage) {
                $oldLecturePage->delete();
            }

            $oldLectureElements = LectureElement::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id_lecture));

            $quizzes = [];

            foreach ($oldLectureElements as $oldLectureElement) {

                if ($oldLectureElement->isQuiz()) {
                    if (!array_key_exists($oldLectureElement->id_type, $quizzes)) {
                        $quizzes[$oldLectureElement->id_type] = [];
                    }
                    array_push($quizzes[$oldLectureElement->id_type], $oldLectureElement->id_block);
                }
            }

            RevisionQuizFactory::deleteFromRegularDB($quizzes);

            $quizTypes = LectureElement::TEST . ', ' . LectureElement::TASK . ', ' . LectureElement::PLAIN_TASK . ', ' . LectureElement::SKIP_TASK;
            LectureElement::model()->deleteAll("id_lecture=:id_lecture AND id_type NOT IN ($quizTypes)", array(':id_lecture' => $this->id_lecture));

            $oldLecture->delete();
            $oldLecture->removeOldTemplatesDirectory();
        }
    }

    /**
     * Return root of $element in $quickUnion data structure;
     * @param array $quickUnion , key - id_revision, $quickUnion[key] == root of key element or itself if key element is root
     * @param $element
     * @return bool
     */
    private function getQURoot(&$quickUnion, $element) {
        $root = $quickUnion[$element];

        while ($root != $quickUnion[$root]) {
//            $quickUnion[$root] = $quickUnion[$quickUnion[$root]];
            $root = $quickUnion[$root];
        }

        $quickUnion[$element] = $root;

        return $root;
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
        foreach ($allIdList as $item) {
            $quickUnion[$item['id_revision']] = ($item['id_parent'] == null ? $item['id_revision'] : $item['id_parent']);
        };
        return $quickUnion;
    }

    /**
     * Returns a list of related lectures id.
     * Algorithm based on Quick-Union algorithm
     * http://algs4.cs.princeton.edu/15uf/
     * Possible ways to improve (in case of bad performance) - implement weight.
     *
     * @return array
     */
    private function getRelatedIdList() {
        //get list of ids of all lectures in the module.
        $allIdList = Yii::app()->db->createCommand()
            ->select('id_revision, id_parent')
            ->from('vc_lecture')
            ->where('id_module=' . $this->id_module)
            ->queryAll();

        $quickUnion = $this->getQuickUnionStructure($allIdList);

        // pushing in resulting array only the keys, which have the same root as $this
        $thisRoot = $this->getQURoot($quickUnion, $this->id_revision);
        $idArray = array();
        foreach ($quickUnion as $key => $value) {
            if ($thisRoot == $this->getQURoot($quickUnion, $value)) {
                array_push($idArray, $key);
            }
        }

        return $idArray;
    }

    public function getQuickUnionRevisions() {
        //get list of ids of all lectures in the module.
        $allIdList = Yii::app()->db->createCommand()
            ->select('id_revision, id_parent')
            ->from('vc_lecture')
            ->where('id_module=' . $this->id_module)
            ->queryAll();

        $quickUnion = $this->getQuickUnionStructure($allIdList);
        return $quickUnion;
    }

    public function getRelatedIdListInBranch($quickUnion) {
        // pushing in resulting array only the keys, which have the same root as $this
        $thisRoot = $this->getQURoot($quickUnion, $this->id_revision);
        $idArray = array();
        foreach ($quickUnion as $key => $value) {
            if ($thisRoot == $this->getQURoot($quickUnion, $value)) {
                array_push($idArray, $key);
            }
        }

        return $idArray;
    }

    public function getRelatedIdListFromApproved($quickUnion, $idApprovedRevision) {
        // make id_parent of approved revision as id_revision
        $quickUnion[$idApprovedRevision] = $idApprovedRevision;

        // pushing in resulting array only the keys, which have the same root as $this
        $thisRoot = $idApprovedRevision;
        $idArray = array();
        foreach ($quickUnion as $key => $value) {
            if ($thisRoot == $this->getQURoot($quickUnion, $value)) {
                array_push($idArray, $key);
            }
        }

        return $idArray;
    }

    /**
     * Return order of the last page
     * @return int
     */
    private function getLastPageOrder() {
        if (count($this->lecturePages) == 0) {
            return 0;
        }
        return $this->lecturePages[count($this->lecturePages) - 1]->page_order;
    }

    public function canCreate() {
        return (Teacher::isTeacherAuthorModule(Yii::app()->user->getId(), $this->id_module));
    }
    
    /**
     * Returns last approved lecture in branch
     * @param integer $idLecture
     * @return RevisionLecture|null
     */
    public static function getParentRevisionForLecture($idLecture) {

        $criteria = new CDbCriteria;
        $criteria->alias = 'vc_lecture';
        $criteria->condition = 'id_lecture=' . $idLecture;
        $criteria->with = array('properties');
        $criteria->order = 'properties.change_date DESC';
        $criteria->addCondition('properties.id_state = ' . RevisionState::ReleasedState);
        $criteria->limit = 1;

        $revisions = RevisionLecture::model()->find($criteria);
        return isset($revisions) ? $revisions : null;
    }

    public function getApprovedRevision($array) {
        $criteria = new CDbCriteria;
        $criteria->alias = 'vc_lecture';
        $criteria->addInCondition('id_revision', $array, 'OR');
        $criteria->with = array('properties');
        $criteria->order = 'properties.change_date DESC';
        $criteria->addCondition('properties.id_state = ' . RevisionState::ReleasedState);
        $criteria->limit = 1;
        return RevisionLecture::model()->find($criteria);
    }

    public static function getApprovedRevisionsInModule($idModule) {
        $criteria = new CDbCriteria;
        $criteria->alias = 'vc_lecture';
        $criteria->condition = 'id_module=' . $idModule;
        $criteria->with = array('properties');
        $criteria->order = 'properties.change_date DESC';
        $criteria->addCondition('properties.id_state = ' . RevisionState::ReleasedState);
        return RevisionLecture::model()->findAll($criteria);
    }

    /**
     * Create directory for lecture template
     * @param Lecture $newLecture
     */
    public function createDirectory($newLecture) {
        if (!file_exists(Yii::app()->basePath . "/../content/module_" . $newLecture->idModule . "/lecture_" . $newLecture->id)) {
            mkdir(Yii::app()->basePath . "/../content/module_" . $newLecture->idModule . "/lecture_" . $newLecture->id);
        }
    }

    /**
     * Create templates
     * @param Lecture $newLecture
     */
    public function createTemplates($newLecture) {
        if ($newLecture) {
            $newLecture->saveLectureContent();
        }
    }

    private function setUpdateDate($user) {
        $this->properties->setUpdateDate($user);
    }

    /**
     * Updates all revisions tree - set new id_lecture for all revisions in branch
     * @param $idLecture
     */
    private function setLectureIdInTree($idLecture) {
        $idList = $this->getRelatedIdList();
        Yii::app()->db->createCommand("UPDATE `vc_lecture` SET `id_lecture`=$idLecture WHERE `id_revision` IN (" . implode(',', $idList) . ")")
            ->execute();
    }

    /**
     * @param $user
     */
    public function cancelReleasedInTree($user) {
        $idList = $this->getRelatedIdList();
        $lectureRevisions = RevisionLecture::model()->findAllByPk($idList);
        foreach ($lectureRevisions as $lectureRevision) {
            if ($lectureRevision->isReleased()) {
                $lectureRevision->state->changeTo('approved', $user);
            }
        }
    }

    /**
     * @param $user
     */
    public function cancelProposedToReleaseInTree($user) {
        $idList = $this->getRelatedIdList();
        $lectureRevisions = RevisionLecture::model()->findAllByPk($idList);
        foreach ($lectureRevisions as $lectureRevision) {
            if ($lectureRevision->isProposedToRelease()) {
                $lectureRevision->state->changeTo('approved', $user);
            }
        }
    }

    /**
     * revisions id list after filtered
     */
    public static function getFilteredIdRevisions($status, $idModule, $idAuthor = null) {
        $sqlCancelledEditor = "(vcp.id_state = " . RevisionState::CancelledAuthorState . ")";
        $sqlCancelled = "(vcp.id_state = " . RevisionState::CancelledState . ")";
        $sqlReady = "(vcp.id_state = " . RevisionState::ReleasedState . ")";
        $sqlApproved = "(vcp.id_state = " . RevisionState::ApprovedState . ")";
        $sqlRejected = "(vcp.id_state = " . RevisionState::RejectedState . ")";
        $sqlSent = "(vcp.id_state = " . RevisionState::SendForApprovalState . ")";
        $sqlEditable = "(vcp.id_state = " . RevisionState::EditableState . ")";
        $sqlProposedToRelease = "(vcp.id_state = " . RevisionState::ReadyForRelease . ")";

        $finalSql = '';
        $authorSql = '';
        if($status){
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
                        case 'proposedToRelease';
                            $finalSql = $finalSql . ' or ' . $sqlProposedToRelease;
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

        if($idModule==null){
            $sql="SELECT DISTINCT vcl.id_revision FROM vc_lecture vcl LEFT JOIN vc_lecture_properties vcp ON vcp.id=vcl.id_properties
            WHERE (".$finalSql.")".$authorSql;
        }else{
            $sql="SELECT DISTINCT vcl.id_revision FROM vc_lecture vcl LEFT JOIN vc_lecture_properties vcp ON vcp.id=vcl.id_properties
            WHERE vcl.id_module=".$idModule." 
            and (".$finalSql.")".$authorSql;
        }
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        $actualIdList = [];
        foreach ($list as $item) {
            array_push($actualIdList, $item['id_revision']);
        }
        return $actualIdList;
    }

    public static function getRevisionsAuthors($idModule=null) {
        $authors=array();
        if ($idModule != null) {
            // @TODO
            $qs = 'SELECT DISTINCT id_user_created FROM vc_lecture_properties INNER JOIN vc_lecture ON vc_lecture.id_properties = vc_lecture_properties.id WHERE vc_lecture.id_module = '.$idModule;
            $revisions = Yii::app()->db->createCommand($qs)->queryAll();
            foreach ($revisions as $key=>$author){
                $authors[$key]['id']=$author["id_user_created"];
                $authors[$key]['authorName'] =StudentReg::getUserNamePayment($author);
            }
        } else {
            $criteria = new CDbCriteria;
            $criteria->distinct = true;
            $criteria->select = 'id_user_created';
            $revisions = RevisionLectureProperties::model()->findAll($criteria);
            foreach ($revisions as $key=>$author){
                $authors[$key]['id']=$author["id_user_created"];
                $authors[$key]['authorName'] =StudentReg::getUserNamePayment($author["id_user_created"]);
            }
        }
        return $authors;
    }

    public function saveModuleLecturesToRegularDB($user, $order=null) {

        //write new data
        $newLecture = $this->saveLectureModelToRegularDB($order);
        $idNewLecture = $newLecture->id;

        foreach ($this->lecturePages as $page) {
            $page->savePageModelToRegularDB($idNewLecture, $this->properties->id_user_created);
        }

        //remove old data if lecture exists in regular DB
//        if ($this->id_lecture != null) {
//            $this->removePreviousRecords();
//        }

        $this->saveCheck();
        $this->setLectureIdInTree($newLecture->id);
//        $this->cancelLecturesInTree($user);

        $newLecture->refresh();

        return $newLecture;
    }

    /**
     * Return true if revision can be proposed to release
     * @return bool
     */
    public function isPreReleasable() {
        if ($this->isApproved() &&
            !$this->isProposedToRelease() &&
            !$this->isReleased() &&
            !$this->isCancelled() &&
            !$this->isCancelledEditor()
        ) {
            return true;
        }
        return false;
    }
    /**
     * Return true if revision can be cancel proposed to release
     * @return bool
     */
    public function isCancellablePreReleased() {
        if ($this->isProposedToRelease() && !$this->isReleased()) {
            return true;
        }
        return false;
    }
    /**
     * Return true if revision can be cancel
     * @return bool
     */
    public function isCancellable() {
        if ($this->state->getCode() == RevisionState::ApprovedState) {
            return true;
        }
        return false;
    }
    /**
     * Return true if revision was proposed_to_release
     * @return bool
     */
    public function isProposedToRelease() {
        return $this->state->getCode() == RevisionState::ReadyForRelease;
    }

    public function canCancel() {
        return $this->state->canChange('cancel');
    }
    public function canProposedToRelease() {
        return $this->state->canChange('readyForRelease');
    }
    public function canCancelProposedToRelease() {
        return $this->state->getCode() == RevisionState::ReadyForRelease;
    }
}
