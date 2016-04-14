<?php

/**
 * This is the model class for table "vc_lecture_page".
 *
 * The followings are the available columns in table 'vc_lecture_page':
 * @property integer $id
 * @property integer $id_page
 * @property integer $id_parent_page
 * @property integer $id_revision
 * @property string $page_title
 * @property integer $page_order
 * @property integer $video
 * @property integer $quiz
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $update_date
 * @property integer $id_user_updated
 * @property string $send_approval_date
 * @property integer $id_user_sended_approval
 * @property string $reject_date
 * @property integer $id_user_rejected
 * @property string $approve_date
 * @property integer $id_user_approved
 * @property string $end_date
 * @property integer $id_user_cancelled
 *
 * The followings are the available model relations:
 * @property RevisionLectureElement[] $lectureElements
 * @property RevisionLecture $idRevision
 */

class RevisionLecturePage extends CActiveRecord
{
    const TEXT          = LectureElement::TEXT;
    const VIDEO	        = LectureElement::VIDEO;
    const CODE          = LectureElement::CODE;
    const EXAMPLE       = LectureElement::EXAMPLE;
    const TASK          = LectureElement::TASK;
    const PLAIN_TASK    = LectureElement::PLAIN_TASK;
    const INSTRUCTION   = LectureElement::INSTRUCTION;
    const LABEL	        = LectureElement::LABEL;
    const SKIP_TASK     = LectureElement::SKIP_TASK;
    const FORMULA       = LectureElement::FINAL_TEST;
    const TABLE         = LectureElement::TABLE;
    const TEST          = LectureElement::TEST;
    const FINAL_TEST    = LectureElement::FINAL_TEST;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_lecture_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_revision, page_order, start_date', 'required'),
			array('id_page, id_parent_page, id_revision, page_order, video, quiz, id_user_created, id_user_updated, id_user_sended_approval, id_user_rejected, id_user_approved, id_user_cancelled', 'numerical', 'integerOnly'=>true),
			array('page_title', 'length', 'max'=>255),
			array('updated_date, send_approval_date, reject_date, approve_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page, id_parent_page, id_revision, page_title, page_order, video, quiz, start_date, id_user_created, update_date, id_user_updated, send_approval_date, id_user_sended_approval reject_date, id_user_rejected, approve_date, id_user_approved, end_date, id_user_cancelled', 'safe', 'on'=>'search'),
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
            //todo IN condition doesn't work!;
			'lectureElements' => array(self::HAS_MANY, 'RevisionLectureElement', 'id_page',
                                                        'condition' => 'id_type=:type_text OR id_type=:type_code OR id_type=:type_example OR id_type=:type_instruction',
                                                        'params' => array(":type_text" => self::TEXT,
                                                                          ":type_code" => self::CODE,
                                                                          ":type_example" => self::EXAMPLE,
                                                                          ":type_instruction" => self::INSTRUCTION),
                                                        'order' => 'block_order ASC',
            ),
			'revision' => array(self::BELONGS_TO, 'RevisionLecture', 'id_revision'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'id_page' => 'Id Page',
            'id_parent_page' => 'Id Parent Page',
			'id_revision' => 'Id Revision',
			'page_title' => 'Page Title',
			'page_order' => 'Page Order',
			'video' => 'Video',
			'quiz' => 'Quiz',
			'start_date' => 'Start Date',
			'id_user_created' => 'Id User Created',
            'update_date' => 'Update Date',
            'id_user_updated' => 'Id User Updated',
            'send_approval_date' => 'Send Approval Date',
            'id_user_sended_approval' => 'Id User Sended Approval',
			'reject_date' => 'Reject Date',
			'id_user_rejected' => 'Id User Rejected',
			'approve_date' => 'Approve Date',
			'id_user_approved' => 'Id User Approved',
			'end_date' => 'End Date',
			'id_user_cancelled' => 'Id User Cancelled',
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
		$criteria->compare('id_page',$this->id_page);
		$criteria->compare('id_parent_page',$this->id_parent_page);
		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_order',$this->page_order);
		$criteria->compare('video',$this->video);
		$criteria->compare('quiz',$this->quiz);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_created',$this->id_user_created);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('id_user_updated',$this->id_user_updated);
		$criteria->compare('send_approval_date',$this->send_approval_date,true);
		$criteria->compare('id_user_sended_approval',$this->id_user_sended_approval);
		$criteria->compare('reject_date',$this->reject_date,true);
		$criteria->compare('id_user_rejected',$this->id_user_rejected);
		$criteria->compare('approve_date',$this->approve_date,true);
		$criteria->compare('id_user_approved',$this->id_user_approved);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('id_user_cancelled',$this->id_user_cancelled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionLecturePage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Save page model with error checking
     * @throws RevisionLectureException
     */
    public function saveCheck($runValidation=true,$attributes=null) {
        if(!$this->save($runValidation,$attributes)) {
            throw new RevisionLecturePageException(implode("; ", $this->getErrors()));
        }
    }

    /**
     * Initialises page
     * @param $idRevision
     * @param $user
     * @param int $order
     * @throws RevisionLecturePageException
     */
    public function initialize($idRevision, $user, $order=1) {
		//default values
		$this->page_title = "";
		$this->video = null;
		$this->quiz = null;
        $this->id_parent_page = null;

        $this->page_order = $order;
		$this->start_date = new CDbExpression('NOW()');;
		$this->id_user_created = $user->getId();

		$this->id_revision = $idRevision;

		$this->saveCheck();
	}

    /**
     * Clone revision
     * Returns new page instance or current instance if the page is not cloneable
     * @param $user
     * @param null $idNewRevision
     * @return RevisionLecturePage
     * @throws RevisionLecturePageException
     * @throws Exception
     */
    public function clonePage($user, $idNewRevision = null) {

        if ($idNewRevision != null && !$this->isClonable()) {
            // we shouldn't clone page in new revision if it is not cloneable
            // (was rejected or cancelled)
            return $this;
        }

        if ($idNewRevision == null) {
            $idNewRevision = $this->id_revision;
        }

        $connection = Yii::app()->db;
        $transaction = null;

        if ($connection->getCurrentTransaction() == null) {
            $transaction = $connection->beginTransaction();
        }

        try {
            $newRevision = new RevisionLecturePage();

            $newRevision->id_page = $this->id_page;
            $newRevision->id_parent_page = $this->id;
            $newRevision->id_revision = $idNewRevision;
            $newRevision->page_title = $this->page_title;
            $newRevision->page_order = $this->page_order;

            $newRevision->start_date = new CDbExpression('NOW()');;
            $newRevision->id_user_created = $user->getId();

            $newRevision->saveCheck();

            //todo copy elements - quiz;

            $quiz = $this->getQuiz();
            if ($quiz != null) {
                $newQuiz = $quiz->cloneQuiz();
            }

            if ($this->video != null) {
                $newVideo = RevisionLectureElement::model()->findByPk($this->video)->cloneVideo($newRevision->id);
                $newRevision->video = $newVideo->id;
            }

            foreach ($this->lectureElements as $lectureElement) {
                $newLectureElement = $lectureElement->cloneText($newRevision->id);
            }

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

    /**
     * Returns lecture elements which contains in lecture body.
     * Doesn't return quiz and video instance.
     * @return RevisionLectureElement[]
     */
    public function getLectureBody(){
        return $this->lectureElements;
    }

    /**
     * Adds video block or edit if the video bloc exists
     * @param $url
     * @throws RevisionLectureElementException
     * @throws RevisionLecturePageException
     */
    public function saveVideo($url, $user) {

        $this->checkEditable();

        if ($this->video != null) {
            $videoElement = RevisionLectureElement::model()->findByPk($this->video);
            $videoElement->html_block = $url;
            $videoElement->saveCheck();
        } else {
            $videoElement = new RevisionLectureElement();
            $videoElement->initVideoElement($url, $this->id);
            $this->video = $videoElement->id;
            $this->saveCheck();
        }

        $this->setUpdateDate($user);
    }

    /**
     * Sends page for approve
     * @param $user
     * @return string
     * @throws RevisionLecturePageException
     */
    public function sendForApproval($user) {
        if ($this->isSendable()) {
            $this->send_approval_date = new CDbExpression('NOW()');;
            $this->id_user_sended_approval = $user->getId();
            $this->saveCheck();
            $message = 'Відправлена на розгляд';
        } else {
            //todo inform user
            $message = 'Сторінка не може бути відправлена на затвердження';
        }
        return json_encode(array("status" => $this->getStatus(),"message" => $message));
    }

    /**
     * Returns true if page can be edited
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
     * Approves page
     * @param $user
     * @return string
     * @throws RevisionLecturePageException
     */
    public function approve($user) {
        if ($this->isApprovable()) {
            $this->approve_date = new CDbExpression('NOW()');;
            $this->id_user_approved = $user->getId();
            $this->saveCheck();
            $message = "Сторінка затверджена";
        } else {
            $message = "Данна сторінка не може бути затверджена";
            //todo inform that the page cannot be approved
        }
        return json_encode(array("status" => $this->getStatus(),"message" => $message));
    }

    /**
     * Rejects page
     * @param $user
     * @return string
     * @throws RevisionLecturePageException
     */
    public function reject($user) {
        if ($this->isRejectable()) {
            $this->reject_date = new CDbExpression('NOW()');;
            $this->id_user_rejected = $user->getId();
            $this->saveCheck();
            $message = "Сторінка відхилена";
        } else {
            $message = "Данна сторінка не може бути відхилена";
            //todo inform that the page cannot be rejected
        }
        return json_encode(array("status" => $this->getStatus(),"message" => $message));
    }

    /**
     * Cancels page
     * @param $user
     * @return string
     * @throws RevisionLecturePageException
     */
    public function cancel($user) {
        if ($this->isCancellable()) {
            $this->end_date = new CDbExpression('NOW()');;
            $this->id_user_cancelled = $user->getId();
            $this->saveCheck();
            $message = 'Сторінка скасована';
        } else {
            $message = 'Сторінка не може бути скасована';
        }
        return json_encode(array("status" => $this->getStatus(),"message" => $message));
    }

    /**
     * Sets or update title
     * @param $title
     * @throws RevisionLecturePageException
     */
    public function setTitle($title, $user) {
        $this->checkEditable();

        $this->page_title = $title;
        $this->setUpdateDate($user, false);
        $this->saveCheck();
    }

    /**
     * Adds text block
     * @param $idType
     * @param $html_block
     * @return RevisionLectureElement
     * @throws RevisionLectureElementException
     * @throws RevisionLecturePageException
     */
    public function addTextBlock($idType, $html_block, $user) {
        $this->checkEditable();

        $order = $this->getNextOrder();

        $element = new RevisionLectureElement();
        $element->id_type = $idType;
        $element->block_order = $order;
        $element->html_block = $html_block;
        $element->id_page = $this->id;
        $element->saveCheck();

        $this->setUpdateDate($user);

        return $element;
    }

    /**
     * Moves page up
     * @throws RevisionLecturePageException
     */
    public function moveUp($user) {
        $this->checkEditable();

        $this->page_order = ($this->page_order>1?$this->page_order-1:1);
        $this->setUpdateDate($user, false);

        $this->saveCheck();
    }

    /**
     * Move page down
     * @throws RevisionLecturePageException
     */
    public function moveDown($user) {
        $this->checkEditable();

        $this->page_order = $this->page_order+1;
        $this->setUpdateDate($user, false);

        $this->saveCheck();
    }

    /**
     * Returns quiz instance
     * @return static
     */
    public function getQuiz() {
        return RevisionLectureElement::model()->findByPk($this->quiz);
    }

    /**
     * Returns video instance
     * @return static
     */
    public function getVideo() {
        return RevisionLectureElement::model()->findByPk($this->video);
    }

    /**
     * Shift element up
     * @param $idElement
     */
    public function upElement($idElement, $user) {
        foreach ($this->lectureElements as $key => $lectureElement) {
            if ($lectureElement->id == $idElement) {
                if ($key == 0) {
                    return;
                }
                $this->swapElements($lectureElement, $this->lectureElements[$key-1]);
                return;
            }
        }
        $this->setUpdateDate($user);
    }

    /**
     * Shift element down
     * @param $idElement
     */
    public function downElement($idElement, $user) {
        foreach ($this->lectureElements as $key => $lectureElement) {
            if ($lectureElement->id == $idElement) {
                if ($key == count($this->lectureElements)-1) {
                    return;
                }

                $this->swapElements($lectureElement, $this->lectureElements[$key+1]);

            }
        }
        $this->setUpdateDate($user);
    }

    /**
     * Sets update date and id user.
     * @param $user - current user model
     * @param bool $isSave - true (default) if need to save of false if no need to save
     * @throws RevisionLecturePageException
     */
    public function setUpdateDate($user, $isSave = true) {
        $this->update_date = new CDbExpression('NOW()');
        $this->id_user_updated = $user->getId();
        if ($isSave) {
            $this->saveCheck();
        }
    }

    public function deleteElement($idElement, $user) {
       foreach ($this->lectureElements as $lectureElement) {
           if ($lectureElement->id == $idElement) {
               $lectureElement->delete();
               $this->setUpdateDate($user);
               return;
           }
       }
    }

    public function savePageModelToRegularDB($idNewLecture) {
        $newPage = new LecturePage();
        $newPage->id_lecture = $idNewLecture;
        $newPage->page_title = $this->page_title;
        $newPage->page_order = $this->page_order;

        //video
        if ($this->video != null) {
            $video = $this->getVideo();
            $newVideo = $video->saveElementModelToRegularDB($idNewLecture);
            $newPage->video = $newVideo->id_block;
        }

        $newPage->save();

        $idNewPage = $newPage->id;

        $idNewElements = array();

        //lecture elements
        foreach ($this->lectureElements as $element) {
            $newElement = $element->saveElementModelToRegularDB($idNewLecture);
            array_push($idNewElements, array('page'=>$idNewPage, 'element'=>$newElement->id_block));
        }

        //todo quiz

        //lecture_page_lecture_element
        if (!empty($idNewElements)) {
            $builder = Yii::app()->db->schema->getCommandBuilder();
            $command = $builder->createMultipleInsertCommand('lecture_element_lecture_page', $idNewElements);
            $command->query();
        }


        return $newPage;

    }

    /**
     * Swaps elements order
     * @param RevisionLectureElement $a
     * @param RevisionLectureElement $b
     */
    private function swapElements($a, $b) {
        if ($a != null && $b != null) {
            $swap = $a->block_order;
            $a->block_order = $b->block_order;
            $b->block_order = $swap;
            $a->saveCheck();
            $b->saveCheck();
        }
    }

    /**
     * Rises exception if page revision couldn't be changed
     * @throws RevisionLecturePageException
     */
    private function checkEditable() {
        //just to be sure. this case should be resolved in previous level;
        if (!$this->isEditable()) {
            throw new RevisionLecturePageException("Cannot modify uneditable lecture page");
        }
    }

    /**
     * Returns next order for lectureElements
     * @return int
     */
    private function getNextOrder() {
        if (count($this->lectureElements) == 0)
            return 1;
        return $this->lectureElements[count($this->lectureElements)-1]->block_order+1;
    }

    /**
     * Return true if revision can be approved
     * @return bool
     */
    public function isApprovable() {
        if ($this->isSended() &&
            !$this->isRejected() &&
            !$this->isCancelled() &&
            !$this->isApproved()) {
            return true;
        }
        return false;
    }

    /**
     * Returns a Quick Union structure of related pages id.
     * Algorithm based on Quick-Union algorithm
     * http://algs4.cs.princeton.edu/15uf/
     * It is important ot keep tree structure, so here is no optimizations
     *
     * @return array
     */
    public static function getQuickUnionStructure($allIdList) {
        // building union data structure;
        // array key represents the elements's id (id_revision),
        // and array value represents link to root element of this element,
        // if element is root its value equal to key

        $quickUnion = array();
        foreach($allIdList as $item) {
            $quickUnion[$item['id']] = ($item['id_parent_page'] == null ? $item['id'] : $item['id_parent_page']);
        };
        return $quickUnion;
    }

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
    private function isClonable() {
        return (!$this->isRejected() && !$this->isCancelled());
    }

    /**
     * Return true if revision was rejected
     * @return bool
     */
    private function isRejected() {
        return $this->id_user_rejected != null;
    }

    /**
     * Return true if revision was sended
     * @return bool
     */
    private function isSended() {
        return $this->id_user_sended_approval != null;
    }

    /**
     * Return true if revision was approved
     * @return bool
     */
    private function isApproved() {
        return $this->id_user_approved != null;
    }

    /**
     * Return true if revision was cancelled
     * @return bool
     */
    private function isCancelled() {
        return $this->id_user_cancelled != null;
    }
}
