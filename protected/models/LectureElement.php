<?php

/**
 * This is the model class for table "lecture_element".
 *
 * The followings are the available columns in table 'lecture_element':
 * @property integer $id_block
 * @property integer $id_lecture
 * @property integer $block_order
 * @property integer $id_type
 * @property string $html_block
 *
 * The followings are the available model relations:
 * @property ElementType $idType
 */
class LectureElement extends CActiveRecord
{
    // Lecture elements types
    const TEXT          = 1;
    const VIDEO	        = 2;
    const CODE          = 3;
    const EXAMPLE       = 4;
    const TASK          = 5;
    const PLAIN_TASK    = 6;
    const INSTRUCTION   = 7;
    const LABEL	        = 8;
    const SKIP_TASK     = 9;
    const FORMULA       = 10;
    const TABLE         = 11;
    const TEST          = 12;
    const FINAL_TEST    = 13;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lecture_element';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lecture, block_order, id_type, html_block', 'required'),
			array('id_lecture, block_order, id_type', 'numerical', 'integerOnly'=>true),
            array('html_block', 'match', 'pattern' => '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\.\/\?\:@\-_=#])*/', 'on'=>'videoLink'),
			// The following rule is used by search().
			array('id_block, id_lecture, block_order, id_type, html_block', 'safe', 'on'=>'search'),
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
			'idType' => array(self::BELONGS_TO, 'ElementType', 'id_type'),
            'plainTask' => array( self::HAS_ONE, 'PlainTask', 'block_element'),
            'skipTask' => array(self::HAS_ONE,'SkipTask','condition'),
            'lecture' => array(self::BELONGS_TO, 'Lecture','id_lecture'),
        );
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_block' => 'Id Block',
            'id_lecture' => 'Id Lecture',
            'block_order' => 'Block Order',
            'id_type' => 'Id Type',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id_block', $this->id_block);
        $criteria->compare('id_lecture', $this->id_lecture);
        $criteria->compare('block_order', $this->block_order);
        $criteria->compare('id_type', $this->id_type);
        $criteria->compare('html_block', $this->html_block, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => array(
                    'block_order' => CSort::SORT_ASC,
                )
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LectureElement the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function addNewTaskBlock($idLecture, $condition)
    {
        $model = new LectureElement();

        $model->getOrder($idLecture);

        $model->id_type = LectureElement::TASK;

        $model->html_block = $condition;
        $model->id_lecture = $idLecture;

        if ($model->save(true)) {
            return LectureElement::model()->findByAttributes(array('block_order' => $model->block_order, 'id_lecture' => $idLecture))->id_block;
        } else {
            return false;
        }
    }

    public static function addNewSkipTaskBlock($idLecture, $condition)
    {
        $model = new LectureElement();

        $model->getOrder($idLecture);
        $model->id_type = LectureElement::SKIP_TASK;
        $model->html_block = $condition;
        $model->id_lecture = $idLecture;

        if ($model->save(true)) {
            return $model->id_block;
        } else {
            return false;
        }
    }

    public static function addNewTestBlock($idLecture, $condition)
    {
        $model = new LectureElement();

        $model->getOrder($idLecture);

        $model->id_type = LectureElement::TEST;

        $model->html_block = $condition;
        $model->id_lecture = $idLecture;

        if ($model->save()) {
            return LectureElement::model()->findByAttributes(array('block_order' => $model->block_order, 'id_lecture' => $idLecture))->id_block;
        } else {
            return false;
        }
    }

    /*�������� ������� �����*/
    public static function editTestBlock($idBlock, $condition)
    {
        $model = LectureElement::model()->findByPk($idBlock);

        $model->html_block = $condition;
        if ($model->validate()) {
            $model->updateByPk($idBlock, array('html_block' => $condition));
            return true;
        } else {
            return false;
        }
    }

    public static function editTaskBlock($idBlock, $condition)
    {
        $model = LectureElement::model()->findByPk($idBlock);

        $model->html_block = $condition;
        if ($model->validate()) {
            $model->updateByPk($idBlock, array('html_block' => $condition));
            return true;
        } else {
            return false;
        }
    }

    public static function getLastVideoId($idLecture)
    {
        return Yii::app()->db->createCommand()
            ->select('id_block')
            ->from('lecture_element')
            ->where('id_lecture=:id and block_order=0', array(':id' => $idLecture))
            ->order('id_block DESC')
            ->queryRow();
    }

    public static function getPrevElement($textList, $order)
    {
        $elements = LectureElement::model()->findAllByAttributes(array('id_block' => $textList));
        $result = [];
        foreach ($elements as $elementOrder) {
            if ($elementOrder->block_order < $order)
                array_push($result, $elementOrder->block_order);
        }
        if (!empty($result))
            $prevElement = max($result);
        else $prevElement = null;

        return $prevElement;
    }

    public static function getVideoLink($htmlBlock)
    {
        //if we want to load video, we finding video link
        $tempArray = explode(" ", $htmlBlock);
        for ($i = count($tempArray) - 1; $i > 0; $i--) {
            if (CommonHelper::startsWith($tempArray[$i], 'src="')) {
                $link = substr($tempArray[$i], 5, strlen($tempArray[$i]) - 1);
                return $link;
            }
        }
        return '';
    }

    public static function getImageLink($htmlBlock)
    {
        //search image source link into new block before save
        $tempArray = explode(" ", $htmlBlock);
        for ($i = count($tempArray) - 1; $i > 0; $i--) {
            if (CommonHelper::startsWith($tempArray[$i], 'src="')) {
                $link = substr($tempArray[$i], 5, strlen($tempArray[$i]) - 6);
                return $link;
            }
        }
        return '';
    }

    public static function getNextElement($textList, $order)
    {
        $elements = LectureElement::model()->findAllByAttributes(array('id_block' => $textList));
        $result = [];
        foreach ($elements as $elementOrder) {
            if ($elementOrder->block_order > $order)
                array_push($result, $elementOrder->block_order);
        }
        if (!empty($result))
            $nextElement = min($result);
        else $nextElement = null;

        return $nextElement;
    }

    public static function getNextOrder($idLecture)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'block_order DESC';
        $criteria->condition = 'id_lecture = :id';
        $criteria->params = array(':id' => $idLecture);
        $max = LectureElement::model()->find($criteria);
        if ($max)
            return $max->block_order + 1;
        else  return '1';
    }

    public static function swapBlock($idLecture, $swapElement, $order)
    {
        if ($swapElement != null) {
            $firstId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $swapElement))->id_block;
            $secondId = LectureElement::model()->findByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order))->id_block;

            LectureElement::model()->updateByPk($secondId, array('block_order' => $swapElement));
            LectureElement::model()->updateByPk($firstId, array('block_order' => $order));
        }
    }

    public static function deleteCurrentBlock($idLecture, $order, $idBlock)
    {
        //delete current block
        LectureElement::model()->deleteAllByAttributes(array('id_lecture' => $idLecture, 'block_order' => $order));
        $command = Yii::app()->db->createCommand();
        $command->delete('lecture_element_lecture_page', 'element=:id', array(':id' => $idBlock));
    }

    public function addVideo($htmlBlock, $pageOrder, $lectureId)
    {
        $this->id_lecture = $lectureId;
        $this->block_order = 0;
        $this->html_block = $htmlBlock;
        $this->id_type = LectureElement::VIDEO;
        $this->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $this->id_lecture, 'page_order' => $pageOrder))->id;
        $id = LectureElement::getLastVideoId($this->id_lecture);

        LecturePage::addVideo($pageId, $id["id_block"]);
    }

    public static function getLectureText($textList)
    {
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id_block', $textList);

        $dataProvider = new CActiveDataProvider('LectureElement');
        $dataProvider->criteria = $criteria;
        $criteria->order = 'block_order ASC';
        $dataProvider->setPagination(array(
                'pageSize' => '200',
            )
        );

        return $dataProvider;
    }

    public static function addNewPlainTask($lecture, $block_element)
    {
        $type = LectureElement::PLAIN_TASK;

        $model = new LectureElement();

        $model->getOrder($lecture);

        $model->id_type = $type;
        $model->html_block = $block_element;
        $model->id_lecture = $lecture;

        if ($model->validate()) {
            $model->save();
            return $model->id_block;
        } else return false;
    }

    private function getOrder($idLecture)
    {
        $criteria = new CDbCriteria;
        $criteria->alias = 'lecture_element';
        $criteria->select = 'block_order';
        $criteria->condition = 'id_lecture = ' . $idLecture;
        $criteria->order = 'block_order DESC';

        if (LectureElement::model()->find($criteria)) {
            $order = LectureElement::model()->find($criteria)->block_order;
        } else {
            $order = 0;
        }

        $this->block_order = ++$order;
    }

    public static function editPlainTask($id_block, $block_element)
    {
        $model = self::model()->findByPk($id_block);

        $model->html_block = $block_element;

        if ($model->validate()) {
            $model->save();

            return $model->id_block;
        } else return false;
    }

    public static function editSkipTask($idBlock, $condition)
    {
        $model = self::model()->findByPk($idBlock);

        $model->html_block = $condition;

        if ($model->validate()) {
            $model->save();

            return $model->id_block;
        } else return false;
    }

    public function getSkipTaskCondition()
    {
        return $this->html_block;
    }

    public function getSkipTaskQuestion()
    {
        $skipTask = SkipTask::model()->findByAttributes(array('condition' => $this->id_block));
        if ($skipTask) {
            return self::model()->findByPk($skipTask->question)->html_block;
        }
        return null;
    }

    public function getSkipTaskSource()
    {
        $skipTask = SkipTask::model()->findByAttributes(array('condition' => $this->id_block));
        if ($skipTask) {
            return $skipTask->source;
        }
        return null;
    }

    public static function getQuizType($id)
    {
        return LectureElement::model()->findByPk($id)->id_type;
    }


    public static function getPlainTaskByLectureId($id)
    {
        return self::model()->findByPk($id)->plainTask;
    }

    /**
     * Returns true if lecture element is quiz or false if not
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

    public function addFormula($htmlBlock, $pageOrder, $idLecture) {

        $this->id_lecture = $idLecture;
        $this->html_block = $htmlBlock;
        $this->id_type = LectureElement::FORMULA;
        $this->block_order = LectureElement::getNextOrder($idLecture);
        $this->save();

        $pageId = LecturePage::model()->findByAttributes(array('id_lecture' => $this->id_lecture, 'page_order' => $pageOrder))->id;

        LecturePage::addTextBlock($this->id_block, $pageId);
    }

    /**
     * Returns true if current model is text block
     * @return bool
     */
    public function isTextBlock() {
        return ($this->id_type == LectureElement::TEXT ||
                $this->id_type == LectureElement::CODE ||
                $this->id_type == LectureElement::INSTRUCTION ||
                $this->id_type == LectureElement::EXAMPLE);
    }


}
