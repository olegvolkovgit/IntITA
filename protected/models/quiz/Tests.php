<?php


/**
 * This is the model class for table "tests".
 *
 * The followings are the available columns in table 'tests':
 * @property integer $id
 * @property integer $block_element
 * @property integer $author
 * @property string $title
 * @property integer $uid
 *
 * The followings are the available model relations:
 */
class Tests extends Quiz
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author, block_element, uid', 'required'),
			array('id, block_element, author, uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, block_element, author, uid', 'safe', 'on'=>'search'),
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
			'block_element' => 'Block Element',
			'author' => 'Author',
            'uid' => 'UID'
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
		$criteria->compare('block_element',$this->block_element);
		$criteria->compare('author',$this->author);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function isLastTest($testId)
	{
		$quiz = Tests::model()->findByPk($testId)->block_element;
		$lecturePage=LecturePage::model()->findByAttributes(array('quiz' => $quiz));
		$pageOrder = $lecturePage->page_order;
		$lectureId = $lecturePage->id_lecture;

		$criteria=new CDbCriteria;
		$criteria->alias='lecture_page';
		$criteria->select='page_order';
		$criteria->condition = 'id_lecture = '.$lectureId;
		$criteria->order = 'page_order DESC';
		$lastPage=LecturePage::model()->find($criteria)->page_order;

		if($pageOrder!=$lastPage) return 0;
		else return 1;
	}

    public function addTask($arr)
    {
        $model = new Tests();

        $model->block_element = $arr['lectureElementId'];
        $model->author = $arr['author'];

        if ($model->save()) {
            LecturePage::addQuiz($arr['pageId'], $arr['lectureElementId']);
            $idTest = Tests::model()->findByAttributes(array('block_element' => $arr['lectureElementId']))->id;
            TestsAnswers::addOptions($idTest, $arr['options']);
            return true;
        }
        else return false;
    }

    public static function getTestId($block){
        return Tests::model()->findByAttributes(array('block_element' => $block))->id;
    }

    public static function getTestType($block){
        $test = Tests::getTestId($block);

        $criteria = new CDbCriteria();
        $criteria->select = 'answer';
        $criteria->addCondition('id_test = :id_test and is_valid = 1');
        $criteria->params = array(':id_test' => $test);
        $count = TestsAnswers::model()->count($criteria);

        return ($count > 1)?2:1;
    }

    public static function getTypeButton($type){
        if($type == 1){
            return 'input:radio:checked';
        }elseif ($type == 2){
            return 'input:checkbox:checked';
        }
    }

    public static function getTestIcon($user, $idBlock, $editMode)
    {
        if ($editMode || Yii::app()->user->isGuest) {
            return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
        } else {
            $idTest = Tests::model()->findByAttributes(array('block_element' => $idBlock))->id;
            if (TestsMarks::isTestDone($user, $idTest)) {
                return StaticFilesHelper::createPath('image', 'lecture', 'taskDone.png');
            } else {
                return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
            }
        }
    }

    public static function getTestCondition($block){
        return LectureElement::model()->findByPk($block)->html_block;
    }
}
