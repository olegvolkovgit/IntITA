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
 * @property LecturePage[] $lecturePages
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

    public function scopes() {
        return array(
            'withApprovedPages' => array(
                'with' => 'lecturePages',
                'order' => 'page_order ASC',
                'condition' => 'id_user_approved IS NOT NULL AND id_user_cancelled IS NULL',
            ),
        );
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
    public static function createNewLecture($idModule, $order, $titleUa, $titleEn, $titleRu, $user) {
		$revLectureProperties =  new RevisionLectureProperties();
		$revLectureProperties->initialize($order, $titleUa, $titleEn, $titleRu, $user);

		$revLecture = new RevisionLecture();
		$revLecture->id_module = $idModule;
        $revLecture->id_properties = $revLectureProperties->id;

        $revLecture->saveCheck();

        $revLecturePage = new RevisionLecturePage();
        $revLecturePage->initialize($revLecture->id_revision, $user);

		return $revLecture;
	}

    /**
     * Adds page to current lecture revision
     * @param $user
     */
    public function addPage($user){
        $revLecturePage = new RevisionLecturePage();
        $revLecturePage->initialize($this->id_revision, $user, $this->getLastPageOrder()+1);
        $this->properties->setUpdateDate($user);
    }

    /**
     * Check conflicts into lecture revision
     * @return array with error messages or empty array
     */
    public function checkConflicts() {
        $result = array();

        //check page orders collision
        $approvedPages = $this->getApprovedPages();
        //check if at least one approved page exist
        if (count($approvedPages) == 0) {
            array_push($result, "There are no approved pages in this lecture");
        }

        //count all orders
        $orders = array();
        foreach ($approvedPages as $page) {
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
        $ordersList = Yii::app()->db->createCommand()
        ->select('id, order')
            ->from('lectures')
            ->where('idModule='.$this->id_module)
            ->queryAll();

        foreach ($ordersList as $item) {
            if ($item['order'] == $this->properties->order && $item['id'] != $this->id_lecture) {
                array_push($result, "This revision has the same order as lecture id #".$item['id']);
            }
        }

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
                $this->properties->send_approval_date = new CDbExpression('NOW()');;
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
                $page->clonePage($user, $newRevision->id_revision);
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
     */
    public function reject ($user) {
        if ($this->isRejectable()) {
            $this->properties->reject_date = new CDbExpression('NOW()');;
            $this->properties->id_user_rejected = $user->getId();
            $this->properties->saveCheck();
        } else {
            //todo inform user
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
                    $this->saveToRegularDB();

                    $this->properties->approve_date = new CDbExpression('NOW()');
                    $this->properties->id_user_approved = $user->getId();
                    $this->properties->saveCheck();

                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
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
            $this->properties->end_date = new CDbExpression('NOW()');;
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

//            TODO
//            $revNewPage->quiz

                $revNewPage->start_date = new CDbExpression('NOW()');
                $revNewPage->id_user_created = $user->getId();
                $revNewPage->approve_date = new CDbExpression('NOW()');
                $revNewPage->id_user_approved = $user->getId();
                $revNewPage->saveCheck();

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

            }

            $transaction->commit();
            return $revLecture;

        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function deleteLectureFromRegularDB() {
        //remove old data if lecture exists in regular DB
        if ($this->id_lecture != null) {
            $this->removePreviousRecords();
        }
    }


    /**
     * Flushes current revision into regular DB.
     * @throws RevisionLectureException
     */
    //todo refactor
    private function saveToRegularDB() {

        //remove old data if lecture exists in regular DB
        if ($this->id_lecture != null) {
            $this->removePreviousRecords();
        }

        //write new data

        $newLecture = $this->saveLectureModelToRegularDB();
        $idNewLecture = $newLecture->id;

        foreach ($this->getApprovedPages() as $page) {
            $page->savePageModelToRegularDB($idNewLecture);
        }

        $this->id_lecture = $newLecture->id;
        $this->saveCheck();
    }

    private function saveLectureModelToRegularDB() {
        //todo maybe need to store idTeacher separately in vc_* DB?
        $teacher = Teacher::model()->findByAttributes(array('user_id' => $this->properties->id_user_created));

        $newLecture = new Lecture();
        $newLecture->idModule = $this->id_module;
        $newLecture->title_ua = $this->properties->title_ua;
        $newLecture->title_ru = $this->properties->title_ru;
        $newLecture->title_en = $this->properties->title_en;
        $newLecture->idTeacher = $teacher->teacher_id;
        $newLecture->image = $this->properties->image;
        $newLecture->alias = $this->properties->alias;
        $newLecture->order = $this->properties->order;
        $newLecture->idType = $this->properties->id_type;
        $newLecture->isFree = $this->properties->is_free;
        $newLecture->save();
        return $newLecture;
    }

    /**
     * Clear regular DB from lecture (pages and elements) witch should be replaced
     * @throws CDbException
     */
    private function removePreviousRecords(){
        $oldLecture = Lecture::model()->findByPk($this->id_lecture);

        //remove lecture pages

        $oldLecturePages = LecturePage::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id_lecture));

        $builder = Yii::app()->db->schema->getCommandBuilder();
        foreach ($oldLecturePages as $oldLecturePage) {
            $command = $builder->createDeleteCommand('lecture_element_lecture_page', new CDbCriteria(array(
                "condition" => "page=" . $oldLecturePage->id
            )));
            $command->query();
        }


        $oldLectureElements = LectureElement::model()->findAll('id_lecture=:id_lecture', array(':id_lecture' => $this->id_lecture));

        foreach ($oldLecturePages as $oldLecturePage) {
            $oldLecturePage->delete();
        }

        foreach ($oldLectureElements as $oldLectureElement) {
            $oldLectureElement->delete();
        }
        $oldLecture->delete();

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

        /**
         * Return root of $element in $quickUnion data structure;
         * @param array $quickUnion, key - id_revision, $quickUnion[key] == root of key element or itself if key element is root
         * @param $element
         * @return bool
         */
        function getQURoot(&$quickUnion, $element) {
            $root = $quickUnion[$element];

            while ($root!=$quickUnion[$root]) {
                $quickUnion[$root] = $quickUnion[$quickUnion[$root]];
                $root = $quickUnion[$root];
            }

            $quickUnion[$element] = $root;

            return $root;
        };

        //get list of ids of all lectures in the module.
        $allIdList = Yii::app()->db->createCommand()
            ->select('id_revision, id_parent')
            ->from('vc_lecture')
            ->where('id_module='.$this->id_module)
            ->queryAll();


        // building union data structure;
        // array key represents the elements's id (id_revision),
        // and array value represents link to root element of this element,
        // if element is root its value equal to key

        $quickUnion = array();
        foreach($allIdList as $item) {
            $quickUnion[$item['id_revision']] = ($item['id_parent'] == null ? $item['id_revision'] : $item['id_parent']);
        };

        // pushing in resulting array only the keys, which have the same root as $this
        $thisRoot = getQURoot($quickUnion, $this->id_revision);
        $idArray = array();
        foreach ($quickUnion as $key => $value) {
            if ($thisRoot == getQURoot($quickUnion, $value)) {
                array_push($idArray, $key);
            }
        }

        return $idArray;
    }

    /**
     * Return order of the last page
     * @return int
     */
    private function getLastPageOrder(){
        return $this->lecturePages[count($this->lecturePages)-1]->page_order;
    }

    /**
     * Return true if revision can be approv
     * @return bool
     */
    private function isApprovable() {
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
    private function isRejectable() {
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
    private function isCancellable() {
        if ($this->isSended() &&
            !$this->isApproved() ||
            $this->isCancelled()) {
            return false;
        }
        return true;
    }

    /**
     * Return true if revision can be send
     * @return bool
     */
    private function isSendable() {
        if (!$this->isSended() &&
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
    private function isSended() {
        return $this->properties->id_user_sended_approval != null;
    }

    /**
     * Return true if revision was approved
     * @return bool
     */
    private function isApproved() {
        return $this->properties->id_user_approved != null;
    }

    /**
     * Return true if revision was cancelled
     * @return bool
     */
    private function isCancelled() {
        return $this->properties->id_user_cancelled != null;
    }


}