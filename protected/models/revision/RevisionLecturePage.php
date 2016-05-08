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
			array('id_revision, page_order', 'required'),
			array('id_page, id_parent_page, id_revision, page_order, video, quiz', 'numerical', 'integerOnly'=>true),
			array('page_title', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page, id_parent_page, id_revision, page_title, page_order, video, quiz', 'safe', 'on'=>'search'),
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
            throw new RevisionLecturePageException('400',$this->getValidationErrors());
        }
    }

    /**
     * Initialises page
     * @param $idRevision
     * @param int $order
     * @throws RevisionLecturePageException
     */
    public function initialize($idRevision, $order = 1) {
		//default values
		$this->page_title = "";
		$this->video = null;
		$this->quiz = null;
        $this->id_parent_page = null;

        $this->page_order = $order;

		$this->id_revision = $idRevision;

		$this->saveCheck();
	}

    /**
     * Clone revision
     * Returns new page instance or current instance if the page is not cloneable
     * @param null $idNewRevision
     * @return RevisionLecturePage
     * @throws Exception
     */
    public function clonePage($idNewRevision = null) {

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

            $newRevision->saveCheck();

            $quiz = $this->getQuiz();
            if ($quiz != null) {
                $newQuiz = $quiz->cloneLectureElement($newRevision->id);
                $newRevision->quiz = $newQuiz->id;
            }

            if ($this->video != null) {
                $newVideo = RevisionLectureElement::model()->findByPk($this->video)->cloneLectureElement($newRevision->id);
                $newRevision->video = $newVideo->id;
            }

            foreach ($this->lectureElements as $lectureElement) {
                $newLectureElement = $lectureElement->cloneLectureElement($newRevision->id);
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
     * @throws RevisionLecturePageException
     * @throws RevisionLectureElementException
     */
//    public function saveVideo($url) {
//        if ($this->video != null) {
//            $videoElement = RevisionLectureElement::model()->findByPk($this->video);
//            $videoElement->html_block = $url;
//            $videoElement->setScenario('videoLink');
//            if(!$videoElement->validate())
//                throw new RevisionLectureElementException('400',implode("; ", $videoElement->getErrors()["html_block"]));
//            $videoElement->saveCheck();
//        } else {
//            $videoElement = new RevisionLectureElement();
//            $videoElement->initVideoElement($url, $this->id);
//            $this->video = $videoElement->id;
//            $this->saveCheck();
//        }
//    }
    /**
     * Delete video block
     * @throws RevisionLecturePageException
     */
//    public function deleteVideo()
//    {
//        $videoElement = RevisionLectureElement::model()->findByPk($this->video);
//        $this->video = null;
//        $this->saveCheck();
//        $videoElement->delete();
//    }

    /**
     * Sets or update title
     * @param $title
     * @throws RevisionLecturePageException
     */
    public function setTitle($title) {
        $this->page_title = $title;
        $this->saveCheck(true,'page_title');
    }

    /**
     * Adds text block
     * @param $idType
     * @param $html_block
     * @return RevisionLectureElement
     * @throws RevisionLectureElementException
     */
    public function addTextBlock($idType, $html_block) {
        $order = $this->getNextOrder();

        $element = new RevisionLectureElement();
        $element->id_type = $idType;
        $element->block_order = $order;
        $element->html_block = $html_block;
        $element->id_page = $this->id;
        $element->saveCheck();

        return $element;
    }

    /**
     * Moves page up
     * @throws RevisionLecturePageException
     */
    public function moveUp() {

        $criteria = new CDbCriteria(array(
            "condition" => "page_order<:page_order AND id_revision=:id_revision",
            "params" => array(':page_order' => $this->page_order, ':id_revision' => $this->id_revision),
            'order' => 'page_order DESC',
            'limit' => '1'
        ));

        $prevPage = RevisionLecturePage::model()->find($criteria);

        if ($prevPage) {
            $this->swapPageOrder($this, $prevPage);
        }
    }

    /**
     * Move page down
     * @throws RevisionLecturePageException
     */
    public function moveDown() {

        $criteria = new CDbCriteria(array(
            "condition" => "page_order>:page_order AND id_revision=:id_revision",
            "params" => array(':page_order' => $this->page_order, ':id_revision' => $this->id_revision),
            'order' => 'page_order ASC',
            'limit' => '1'
        ));

        $nextPage = RevisionLecturePage::model()->find($criteria);

        if ($nextPage) {
            $this->swapPageOrder($this, $nextPage);
        }
    }

    /**
     * Returns quiz instance
     * @return RevisionLectureElement
     */
    public function getQuiz() {
        return RevisionLectureElement::model()->findByPk($this->quiz);
    }

    /**
     * Returns video instance
     * @return RevisionLectureElement static
     */
    public function getVideo() {
        return RevisionLectureElement::model()->findByPk($this->video);
    }

    /**
     * Shift element up
     * @param $idElement
     */
    public function upElement($idElement) {
        foreach ($this->lectureElements as $key => $lectureElement) {
            if ($lectureElement->id == $idElement) {
                if ($key == 0) {
                    return;
                }
                $this->swapElements($lectureElement, $this->lectureElements[$key-1]);
                return;
            }
        }
    }

    /**
     * Shift element down
     * @param $idElement
     */
    public function downElement($idElement) {
        foreach ($this->lectureElements as $key => $lectureElement) {
            if ($lectureElement->id == $idElement) {
                if ($key == count($this->lectureElements)-1) {
                    return;
                }

                $this->swapElements($lectureElement, $this->lectureElements[$key+1]);

            }
        }
    }

    /**
     * Deletes lecture element
     * @param $idElement
     * @throws CDbException
     */
    public function deleteElement($idElement) {
       foreach ($this->lectureElements as $lectureElement) {
           if ($lectureElement->id == $idElement) {
               $lectureElement->delete();
               return;
           }
       }
    }

    /**
     * @param $idNewLecture
     * @param $idUserCreated
     * @return LecturePage
     */
    public function savePageModelToRegularDB($idNewLecture, $idUserCreated) {
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
        $quiz = $this->getQuiz();
        if ($quiz) {
            $newQuiz = $quiz->saveElementModelToRegularDB($idNewLecture, $idUserCreated);
            $newPage->quiz = $newQuiz->id_block;
            $newPage->save();
        }

        //lecture_page_lecture_element
        if (!empty($idNewElements)) {
            $builder = Yii::app()->db->schema->getCommandBuilder();
            $command = $builder->createMultipleInsertCommand('lecture_element_lecture_page', $idNewElements);
            $command->query();
        }

        return $newPage;
    }

    /**
     * @param $idType
     * @param $html_block
     * @param $quiz
     * @throws CDbException
     * @throws RevisionLecturePageException
     */
    public function addLectureElement($idType, $html_block, $quiz) {

        switch($idType) {
            case LectureElement::VIDEO:
                if ($this->video) {
                    throw new RevisionLecturePageException('Неможливо додати відео. На цій сторінці вже існує відео-блок.');
                }
                $order = 0;
                break;
            case LectureElement::TEST:
            case LectureElement::PLAIN_TASK:
            case LectureElement::SKIP_TASK:
            case LectureElement::TASK:
                if ($this->quiz) {
                    throw new RevisionLecturePageException('Неможливо додати тест. На цій сторінці вже існує блок тесту.');
                }
                $order = 0;
                break;
            default:
                $order = $this->getNextOrder();
                break;
        }

        $newElement = RevisionLectureElement::create($idType, $order, $html_block, $this->id, $quiz);

        if ($newElement->isQuiz()) {
            $this->quiz = $newElement->id;
            $this->update(['quiz']);
        }

        if ($newElement->isVideo()) {
            $this->video = $newElement->id;
            $this->update(['video']);
        }
    }

    public function editLectureElement($idBlock, $htmlBlock, $quiz) {
        $revLectureElement = $this->getElementById($idBlock);
        if ($revLectureElement) {
            $revLectureElement->edit($htmlBlock, $quiz);
            return $revLectureElement;
        }
        return false;
    }

    /**
     * @param $idBlock
     * @return bool
     * @throws CDbException
     */
    public function deleteLectureElement($idBlock){
        $revLectureElement = $this->getElementById($idBlock);

        if ($revLectureElement->isQuiz()) {
            $this->quiz = null;
            $this->update(['quiz']);
        }

        if ($revLectureElement->isVideo()) {
            $this->video = null;
            $this->update(['video']);
        }

        if ($revLectureElement) {
            return $revLectureElement->delete();
        }

        return false;
    }

    public function beforeDelete() {
        $result = true;

        $lectureElements = $this->getLectureBody();
//        array_merge($lectureElements, );
        array_push($lectureElements, $this->getQuiz());
        array_push($lectureElements, $this->getVideo());

        foreach ($lectureElements as $lectureElement) {
            if ($lectureElement) {
                $result = $lectureElement->delete();
                if (!$result) {
                    return false;
                }
            }
        }

        return ($result && parent::beforeDelete());
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
     * Returns next order for lectureElements
     * @return int
     */
    private function getNextOrder() {
        if (count($this->lectureElements) == 0)
            return 1;
        return $this->lectureElements[count($this->lectureElements)-1]->block_order+1;
    }

    /**
     * @param RevisionLecturePage $a
     * @param RevisionLecturePage $b
     */
    private function swapPageOrder($a, $b) {

        if ($a != null && $b != null) {
            $swap = $a->page_order;
            $a->page_order = $b->page_order;
            $b->page_order = $swap;
            $a->saveCheck();
            $b->saveCheck();
        }
    }

    public function getRevisionPageVideo()
    {
        $videoLink = str_replace("watch?v=", "embed/", RevisionLectureElement::model()->findByPk($this->video)->html_block);
        $videoLink = str_replace("&feature=youtu.be", "", $videoLink);
        return $videoLink;
    }

    /**
     * @param $idBlock
     * @return null|RevisionLectureElement
     */
    private function getElementById($idBlock) {
        if ($idBlock == $this->video) {
            return $this->getVideo();
        }
        if ($idBlock == $this->quiz) {
            return $this->getQuiz();
        }
        foreach ($this->lectureElements as $lectureElement) {
            if ($lectureElement->id == $idBlock) {
                return $lectureElement;
            }
        }
        return null;
    }

    public function getValidationErrors() {
        $errors=[];
        foreach($this->getErrors() as $attribute){
            foreach($attribute as $error){
                array_push($errors,$error);
            }
        }
        return $errors[0];
    }

}
