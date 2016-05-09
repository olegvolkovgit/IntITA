<?php

/**
 * This is the model class for table "vc_lecture_element".
 *
 * The followings are the available columns in table 'vc_lecture_element':
 * @property integer $id
 * @property integer $id_page
 * @property integer $id_type
 * @property integer $block_order
 * @property string  $html_block
 *
 * The followings are the available model relations:
 * @property LecturePage $idPage
 */
class RevisionLectureElement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vc_lecture_element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_page, id_type, block_order', 'required'),
			array('id_page, id_type, block_order', 'numerical', 'integerOnly'=>true),
			array('html_block', 'match', 'pattern' => '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\.\/\?\:@\-_=#])*/', 'message' => 'Поле має бути посиланням', 'on'=>'videoLink'),
			array('html_block', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page, id_type, block_order, html_block', 'safe', 'on'=>'search'),
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
			'page' => array(self::BELONGS_TO, 'RevisionLecturePage', 'id_page'),
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
			'id_type' => 'Id Type',
			'block_order' => 'Block Order',
			'html_block' => 'Html Block',
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
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('block_order',$this->block_order);
		$criteria->compare('html_block',$this->html_block,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RevisionLectureElement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Save model with error checking
     * @throws RevisionLectureException
     */
	public function saveCheck($runValidation=true,$attributes=null) {
		if (!$this->save($runValidation, $attributes)) {
			throw new RevisionLectureElementException('400',$this->getValidationErrors());
		}
	}

    /**
     * Initialize video element
     * @param $url
	 * @throws RevisionLectureElementException
     * @param $idPage
     */
    public function initVideoElement($url, $idPage) {
		$this->id_page = $idPage;
		$this->id_type = LectureElement::VIDEO;
		$this->block_order = 0;
		$this->html_block = $url;
        $this->setScenario('videoLink');
		if(!$this->validate())
			throw new RevisionLectureElementException('400',implode("; ", $this->getErrors()['html_block']));
		$this->save();
	}

    public static function create($idType, $blockOrder, $htmlBlock, $idPage=null, $quiz=null) {
        $revLectureElement = new RevisionLectureElement();
        $revLectureElement->id_page = $idPage;
        $revLectureElement->id_type = $idType;
        $revLectureElement->block_order = $blockOrder;
        $revLectureElement->html_block = $htmlBlock;
        $revLectureElement->saveCheck();

        if ($revLectureElement->isQuiz() && isset($quiz)) {
            RevisionQuizFactory::create($revLectureElement, $quiz);
        }

        return $revLectureElement;
    }

    public function edit($htmlBlock, $quiz) {
        if ($this->isQuiz()) {
            RevisionQuizFactory::edit($this, $quiz);
        }

        $this->html_block = $htmlBlock;
        $this->saveCheck();
    }

    /**
     * @return bool|void
     */
    protected function beforeDelete(){
        $result = true;
        if ($this->isQuiz()) {
            $result = RevisionQuizFactory::delete($this->id, $this->id_type);
        }
        return ($result && parent::beforeDelete());
    }


    /**
     * Clone lecture element
     * @param $idNewPage - new page revision id
     * @return RevisionLectureElement
     * @throws RevisionLectureElementException
     */
    public function cloneLectureElement($idNewPage) {
        if ($idNewPage == null) {
            $idNewPage = $this->id_page;
        }

        $clone = new RevisionLectureElement();
        $clone->id_page = $idNewPage;
        $clone->id_type = $this->id_type;
        $clone->block_order = $this->block_order;
        $clone->html_block = $this->html_block;

        $clone->saveCheck();

        if ($this->isQuiz()) {
            RevisionQuizFactory::cloneQuiz($this, $clone);
        }

        return $clone;
    }

//    public function cloneQuiz($idNewPage) {
//
//        $clone = new RevisionLectureElement();
//        $clone->id_page = $idNewPage;
//        $clone->id_type = $this->id_type;
//        $clone->block_order = $this->block_order;
//        $clone->html_block = $this->html_block;
//        $clone->saveCheck();
//
//        RevisionQuizFactory::cloneQuiz($this, $clone);
//
//        return $clone;
//    }

    /**
     * Saves lecture element to into regular DB
     * @param $idNewLecture
     * @param null $idUserCreated
     * @return LectureElement
     */
    public function saveElementModelToRegularDB($idNewLecture, $idUserCreated=null) {

        $new = new LectureElement();
        $new->id_type = $this->id_type;
        $new->id_lecture = $idNewLecture;
        $new->block_order = $this->block_order;
        $new->html_block = $this->html_block;
        $new->save();

        if ($this->isQuiz()) {
            RevisionQuizFactory::saveToRegularDB($this, $new, $idUserCreated);
        }

        return $new;
    }

    /**
     * Returns true if the lecture element is quiz
     * @return bool
     */
    public function isQuiz() {
        if ($this->id_type == LectureElement::PLAIN_TASK  || //plain task
            $this->id_type == LectureElement::TEST || //test
            $this->id_type == LectureElement::TASK  || //task
            $this->id_type == LectureElement::SKIP_TASK ) { //skip task
            return true;
        }
        else {
            return false;
        }
    }

    public function isVideo() {
        return $this->id_type == LectureElement::VIDEO;
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
