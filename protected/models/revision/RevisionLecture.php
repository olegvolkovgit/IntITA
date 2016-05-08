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
 */
class RevisionLecture extends CActiveRecord
{

    private $approveResultCashed = null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_lecture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_parent, id_lecture, id_module, id_properties', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_revision, id_parent, id_lecture, id_module, id_properties', 'safe', 'on'=>'search'),
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
			'properties' => array(self::HAS_ONE, 'RevisionLectureProperties', 'id'),
			'lecturePages' => array(self::HAS_MANY, 'RevisionLecturePage', 'id_revision',
                                                        'order' => 'page_order ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('id_lecture',$this->id_lecture);
		$criteria->compare('id_module',$this->id_module);
		$criteria->compare('id_properties',$this->id_properties);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionLecture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Save lecture model with error checking
     * @throws RevisionLectureException
     */
    public function saveCheck(){
        if (!$this->save()) {
            throw new RevisionLectureException(implode(", ", $this->getErrors()));
        }
    }

    /**
     * Creates new lecture according to params
     * @param $idModule
     * @param $order
     * @param $titleUa
     * @param $titleEn
     * @param $titleRu
     * @param $user
     * @return RevisionLecture
     * @throws RevisionLectureException
     */
    public static function createNewLecture($idModule, $titleUa, $titleEn, $titleRu, $user) {
		$revLectureProperties =  new RevisionLectureProperties();
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
    public function addPage($user){
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
            array_push($result, "There are no approved pages in this lecture");
        }

        //count all orders
        $orders = array();
        foreach ($this->lecturePages as $page) {
            if(isset($orders[$page->page_order])) {
                $orders[$page->page_order]['count']++;
                array_push($orders[$page->page_order]['lectures'], $page->id);
            } else {
                $orders[$page->page_order] = array('order'=>$page->page_order, 'count'=>1, 'lectures'=>array($page->id));
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

        // check lecture order collision
//        $ordersList = Yii::app()->db->createCommand()
//        ->select('id, order')
//            ->from('lectures')
//            ->where('idModule='.$this->id_module)
//            ->queryAll();
//
//        foreach ($ordersList as $item) {
//            if ($item['order'] == $this->properties->order && $item['id'] != $this->id_lecture) {
//                array_push($result, "This revision has the same order as lecture id #".$item['id']);
//            }
//        }

        $this->approveResultCashed = $result;
        return $result;
    }

    /**
     * Return only approved lectures.
     * @return array
     */
    public function getApprovedPages() {
        return array_filter($this->lecturePages, function ($lecturePage) {
            if ($lecturePage->id_user_approved != null &&
                $lecturePage->id_user_cancelled == null) {
                return true;
            }
            return false;
        });
    }

    /**
     * Returns an array of pages ready for approve
     * @return RevisionLecturePage[]
     */
    public function getSendedPages() {
        $this->lecturePages;
    }

    /**
     * Sends current revision to approve
     * @param $user
     * @throws RevisionLecturePropertiesException
     */
    public function sendForApproval($user) {
        if ($this->isSendable()) {
            if ($this->approveResultCashed === null) {
                $this->checkConflicts();
            }

            if (empty($this->approveResultCashed)) {
                $this->properties->send_approval_date = new CDbExpression('NOW()');
                $this->properties->id_user_sended_approval = $user->getId();
                $this->properties->saveCheck();
            } else {
                //todo inform user
            }
        } else {
            //todo inform user
        }
    }
    /**
     * Cancel sends current revision to approve
     * @throws RevisionLecturePropertiesException
     */
    public function cancelSendForApproval() {
        if ($this->isApprovable()) {
            $this->properties->send_approval_date = '0000-00-00 00:00:00';
            $this->properties->id_user_sended_approval = null;
            $this->properties->saveCheck();
        } else {
            //todo inform user
        }
    }

    /**
     * Clones $this into new db instance.
     * Returns new lecture instance or current instance if the lecture is not cloneable
     * @param $user
     * @return RevisionLecture
     * @throws Exception
     */
    public function cloneLecture($user) {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $newRevision = new RevisionLecture();
            $newRevision->id_parent = $this->id_revision;
            $newRevision->id_lecture = $this->id_lecture;
            $newRevision->id_module = $this->id_module;

            $newProperties = $this->properties->cloneProperties($user);
            $newRevision->id_properties = $newProperties->id;

            $newRevision->saveCheck();

            foreach ($this->lecturePages as $page) {
                $page->clonePage($newRevision->id_revision);
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }

        return $newRevision;
    }

    /**
     * Rejects lecture revision
     * @param $user
     * @throws RevisionLecturePropertiesException
     * @throws \application\components\Exceptions\IntItaException
     */
    public function reject ($user) {
        if ($this->isRejectable()) {
            $this->properties->reject_date = new CDbExpression('NOW()');;
            $this->properties->id_user_rejected = $user->getId();
            $this->properties->saveCheck();
        } else {
            //sending inform message to revision author
            $transaction = Yii::app()->db->beginTransaction();
            try {
                $message = new MessagesRejectRevision();
                $comment = '';
                $message->build(Yii::app()->user->model->registrationData, $this, $comment);
                $message->create();
                $sender = new MailTransport();

                $message->send($sender);
                $transaction->commit();
            } catch (Exception $e){
                $transaction->rollback();
                throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
            }
        }
    }

    /**
     * Approves lecture revision
     * @param $user
     * @throws RevisionLecturePropertiesException
     * @throws Exception
     */
    public function approve($user) {

        if ($this->isApprovable()) {
            if ($this->approveResultCashed === null) {
                $this->checkConflicts();
            }

            if (empty($this->approveResultCashed)) {

                $transaction = Yii::app()->db->beginTransaction();
                try {

                    $newLecture = $this->saveToRegularDB($user);

                    $this->properties->approve_date = new CDbExpression('NOW()');
                    $this->properties->id_user_approved = $user->getId();
                    $this->properties->saveCheck();

                    $transaction->commit();

                    //todo refactor - replace commit to the try block end
                    $this->createDirectory($newLecture);
                    $this->createTemplates($newLecture);

                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }

                //sending inform message to revision author
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $message = new MessagesApproveRevision();
                    $message->build(Yii::app()->user->model->registrationData, $this);
                    $message->create();
                    $sender = new MailTransport();

                    $message->send($sender);
                    $transaction->commit();
                } catch (Exception $e){
                    $transaction->rollback();
                    throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
                }
            } else {
                //todo inform user
            }
        } else {
            //todo inform user
        }
    }

    /**
     * Cancels lecture revision
     * @param $user
     * @throws RevisionLecturePropertiesException
     */
    public function cancel($user) {
        if ($this->isCancellable()) {
            $this->properties->end_date = new CDbExpression('NOW()');
            $this->properties->id_user_cancelled = $user->getId();
            $this->properties->saveCheck();
        } else {
            //todo inform user
        }
    }

    /**
     * Return true if the lecture can be edited
     * @return bool
     */
    public function isEditable() {
        if (!$this->isSended() &&
            !$this->isApproved() &&
            !$this->isCancelled() &&
            !$this->isRejected()) {
            return true;
        }
        return false;
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

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $revLectureProperties = new RevisionLectureProperties();
            $revLectureProperties->image = $lecture->image;
            $revLectureProperties->alias = $lecture->alias;
            $revLectureProperties->order = $lecture->order;
            $revLectureProperties->id_type = $lecture->idType;
            $revLectureProperties->is_free = $lecture->isFree;
            $revLectureProperties->title_ua = $lecture->title_ua;
            $revLectureProperties->title_ru = $lecture->title_ru;
            $revLectureProperties->title_en = $lecture->title_en;
            $revLectureProperties->start_date = new CDbExpression('NOW()');
            $revLectureProperties->id_user_created = $user->getId();
            $revLectureProperties->end_date = new CDbExpression('NOW()');
            $revLectureProperties->id_user_cancelled = $user->getId();
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
                    $revVideo->id_page = $revLecture->id_revision;
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

            $transaction->commit();
            return $revLecture;

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
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
                ->where('id_module='.$idModule)
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
     * Returns lecture revision status
     * @return string
     */
    public function getStatus() {
        if ($this->isCancelled()) {
            return "Скасована";
        }
        if ($this->isApproved()) {
            return "Затвердженна";
        }
        if ($this->isRejected()) {
            return "Відхилена";
        }
        if ($this->isSended()) {
            return "Відправлена на розгляд";
        }
        return 'Доступна для редагування';
    }

    /**
     * @param integer $pageId
     * @param array $lectureElementData ['idType' => 'foo', 'html_block' => 'bar', quiz=>[] ]
     * @param $user
     * @throws RevisionLecturePageException
     */
    public function addLectureElement($pageId, $lectureElementData, $user){
        $page = $this->getPageById($pageId);
        if ($page) {
            $quiz = array_key_exists('quiz', $lectureElementData)?$lectureElementData['quiz']:null;
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
            $quiz = array_key_exists('quiz', $lectureElementData)?$lectureElementData['quiz']:null;
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
    private function saveToRegularDB($user) {

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
        $this->cancelLecturesInTree($user);

        $newLecture->refresh();

        return $newLecture;
    }

    /**
     * Creates new lecture in regular DB
     * @return Lecture
     */
    private function saveLectureModelToRegularDB() {
        //todo maybe need to store idTeacher separately in vc_* DB?
//        $teacher = Teacher::model()->findByAttributes(array('user_id' => $this->properties->id_user_created));

        $newLecture = new Lecture();
        $newLecture->idModule = $this->id_module;
        $newLecture->title_ua = $this->properties->title_ua;
        $newLecture->title_ru = $this->properties->title_ru;
        $newLecture->title_en = $this->properties->title_en;
//        $newLecture->idTeacher = $teacher->teacher_id;
        $newLecture->image = $this->properties->image;
        $newLecture->alias = $this->properties->alias;
//        $newLecture->order = $this->properties->order;
        // todo
        if($this->id_lecture != null && Lecture::model()->findByPk($this->id_lecture)){
            $newLecture->order =Lecture::model()->findByPk($this->id_lecture)->order;
        }else{
            $newLecture->order =$newLecture->lastLectureOrder()+1;
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
    private function removePreviousRecords(){
        $oldLecture = Lecture::model()->findByPk($this->id_lecture);

        if($oldLecture) {
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

            $quizes = [];

            foreach ($oldLectureElements as $oldLectureElement) {

                if ($oldLectureElement->isQuiz()) {
                    if (!array_key_exists($oldLectureElement->id_type, $quizes)) {
                        $quizes[$oldLectureElement->id_type] = [];
                    }
                    array_push($quizes[$oldLectureElement->id_type], $oldLectureElement->id_block);
                }
            }

            RevisionQuizFactory::deleteFromRegularDB($quizes);

            LectureElement::model()->deleteAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id_lecture));

            $oldLecture->delete();
            $oldLecture->removeOldTemplatesDirectory();
        }
    }

    /**
     * Return root of $element in $quickUnion data structure;
     * @param array $quickUnion, key - id_revision, $quickUnion[key] == root of key element or itself if key element is root
     * @param $element
     * @return bool
     */
    private function getQURoot(&$quickUnion, $element) {
        $root = $quickUnion[$element];

        while ($root!=$quickUnion[$root]) {
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
        foreach($allIdList as $item) {
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
    private function getRelatedIdList () {
        //get list of ids of all lectures in the module.
        $allIdList = Yii::app()->db->createCommand()
            ->select('id_revision, id_parent')
            ->from('vc_lecture')
            ->where('id_module='.$this->id_module)
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
    public function getQuickUnionRevisions () {
        //get list of ids of all lectures in the module.
        $allIdList = Yii::app()->db->createCommand()
            ->select('id_revision, id_parent')
            ->from('vc_lecture')
            ->where('id_module='.$this->id_module)
            ->queryAll();

        $quickUnion = $this->getQuickUnionStructure($allIdList);
        return $quickUnion;
    }

    public function getRelatedIdListInBranch ($quickUnion) {
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

    public function getRelatedIdListFromApproved ($quickUnion, $idApprovedRevision) {
        // make id_parent of approved revision as id_revision
        $quickUnion[$idApprovedRevision]=$idApprovedRevision;

        // pushing in resulting array only the keys, which have the same root as $this
        $thisRoot=$idApprovedRevision;
        $idArray = array();
        foreach ($quickUnion as $key => $value) {
            if ($thisRoot == $this->getQURoot($quickUnion, $value)) {
                array_push($idArray, $key);
            }
        }

        return $idArray;
    }

//    private function getRelatedIdListFromApproved ($id) {
//        //make id_parent of approved revision as id_revision
//        $quickUnion[$id]=$id;
//
//        // pushing in resulting array only the keys, which have the same root as $this
//        $thisRoot=$id;
//        $idArray = array();
//        foreach ($quickUnion as $key => $value) {
//            if ($thisRoot == $this->getQURoot($quickUnion, $value)) {
//                array_push($idArray, $key);
//            }
//        }
//
//        return $idArray;
//    }

    /**
     * Return order of the last page
     * @return int
     */
    private function getLastPageOrder(){
        if(count($this->lecturePages) == 0) {
            return 0;
        }
        return $this->lecturePages[count($this->lecturePages)-1]->page_order;
    }

    /**
     * Return true if revision can be approv
     * @return bool
     */
    public function isApprovable() {
        if ($this->isSended() &&
            !$this->isRejected() &&
            !$this->isCancelled() &&
            !$this->isApproved() &&
            $this->id_module != null) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be reject
     * @return bool
     */
    public function isRejectable() {
        if ($this->isSended() &&
            !$this->isApproved() &&
            !$this->isRejected()) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be cancel
     * @return bool
     */
    public function isCancellable() {
        if ($this->isApproved() && !$this->isCancelled())
        {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be send
     * @return bool
     */
    public function isSendable() {
        if (!$this->isSended() &&
            !$this->isRejected() &&
            !$this->isApproved() &&
            !$this->isCancelled()) {
            return true;
        }
        return false;
    }

    /**
     * Return true if revision can be cancel send for approve
     * @return bool
     */
    public function isSendedCancellable() {
        if ($this->isSended() &&
            !$this->isRejected() &&
            !$this->isApproved() &&
            !$this->isCancelled()) {
            return true;
        }
        return false;
    }
    /**
     * Return true if revision can be clone
     * @return bool
     */
    private function isClonable () {
        return (!$this->isRejected() && !$this->isCancelled());
    }

    /**
     * Return true if revision was rejected
     * @return bool
     */
    private function isRejected() {
        return $this->properties->id_user_rejected != null;
    }

    /**
     * Return true if revision was sended
     * @return bool
     */
    public function isSended() {
        return $this->properties->id_user_sended_approval != null;
    }

    /**
     * Return true if revision was approved
     * @return bool
     */
    public function isApproved() {
        return $this->properties->id_user_approved != null;
    }

    /**
     * Return true if revision was cancelled
     * @return bool
     */
    private function isCancelled() {
        return $this->properties->id_user_cancelled != null;
    }

    public function canEdit() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isEditable());
    }

    public function canCancelSendForApproval() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isApprovable());
    }
    public function canSendForApproval() {
        return ($this->properties->id_user_created == Yii::app()->user->getId() && $this->isSendable());
    }
    public function canApprove() {
        return (RegisteredUser::userById(Yii::app()->user->getId())->canApprove() && $this->isApprovable());
    }
    public function canCancelRevision() {
        return (RegisteredUser::userById(Yii::app()->user->getId())->canApprove() && $this->isCancellable());
    }
    public function canRejectRevision() {
        return (RegisteredUser::userById(Yii::app()->user->getId())->canApprove() && $this->isRejectable());
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
        $criteria->order = 'properties.approve_date DESC';
        $criteria->addCondition('properties.id_user_approved IS NOT NULL');
        $criteria->limit = 1;
        
        $revisions = RevisionLecture::model()->find($criteria);
        return isset($revisions)?$revisions:null;
    }

    public function getApprovedRevision($array) {
        $criteria = new CDbCriteria;
        $criteria->alias = 'vc_lecture';
        $criteria->addInCondition('id_revision', $array, 'OR');
        $criteria->with = array('properties');
        $criteria->order = 'properties.approve_date DESC';
        $criteria->addCondition('properties.id_user_approved IS NOT NULL and
         properties.id_user_cancelled IS NULL');
        $criteria->limit = 1;
        return RevisionLecture::model()->find($criteria);
    }

    //Create directory for lecture template
    /**
     * @param Lecture $newLecture
     */
    private function createDirectory($newLecture) {
        if(!file_exists(Yii::app()->basePath . "/../content/module_".$newLecture->idModule."/lecture_".$newLecture->id)){
            mkdir(Yii::app()->basePath . "/../content/module_".$newLecture->idModule."/lecture_".$newLecture->id);
        }
    }
    //Create templates
    /**
     * @param Lecture $newLecture
     */
    private function createTemplates($newLecture) {
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
        Yii::app()->db->createCommand("UPDATE `vc_lecture` SET `id_lecture`=$idLecture WHERE `id_revision` IN (".implode(',', $idList).")")
            ->execute();
    }

    /**
     * @param $user
     */
    private function cancelLecturesInTree($user) {
        $idList = $this->getRelatedIdList();
        $lectureRevisions = RevisionLecture::model()->findAllByPk($idList);
        foreach ($lectureRevisions as $lectureRevision) {
            if ($lectureRevision->isApproved()) {
                $lectureRevision->cancel($user);
            }
        }
    }

}
