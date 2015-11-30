<?php

/**
 * This is the model class for table "skip_task".
 *
 * The followings are the available columns in table 'skip_task':
 * @property integer $id
 * @property integer $author
 * @property integer $condition
 * @property integer $question
 * @property integer $source

 *
 * The followings are the available model relations:
 * @property LectureElement $condition0
 * @property LectureElement $question0
 * @property Teacher $author0
 * @property SkipTaskAnswers[] $skipTaskAnswers
 */
class SkipTask extends Quiz
{
    public $answers;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'skip_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author, condition, question,source', 'required'),
			array('author, condition, question', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, author, condition, question', 'safe', 'on'=>'search'),
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
			'condition0' => array(self::BELONGS_TO, 'LectureElement', 'condition'),
			'question0' => array(self::BELONGS_TO, 'LectureElement', 'question'),
			'author0' => array(self::BELONGS_TO, 'Teacher', 'author'),
			'skipTaskAnswers' => array(self::HAS_MANY, 'SkipTaskAnswers', 'id_task'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author' => 'Author',
			'condition' => 'Condition',
			'question' => 'Question',
            'source' => 'Source',
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
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('author',$this->author);
		$criteria->compare('condition',$this->condition);
		$criteria->compare('question',$this->question);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SkipTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function addTask($arr){

        $this->question = $arr['questionId'];
        $this->condition = $arr['condition'];
        $this->author = $arr['author'];
        $this->answers = $arr['answers'];
        $this->source = $arr['question'];

        if ($this->save()) {
            LecturePage::addQuiz($arr['pageId'], $arr['condition']);
            SkipTaskAnswers::addAnswers($this->id, $this->answers);
            return true;
        }
        else return false;
    }

    public function getQuestionAnswers($question){
        $answers = [];
        $pattern = '/\/\*<span style=\"background:yellowgreen\">(.+?)<\/span>\*\//';

        preg_match_all($pattern, $question, $answers);

        $this->answers = $answers[1];
    }

    public function afterSave()
    {
        parent::afterSave();
        $this->id = Yii::app()->db->getLastInsertID();
    }

    public function getQuestion()
    {
        $regExp = "\/\/*(.+?)\*\//";
        $question = LectureElement::model()->findByPk($this->question)->html_block;

        preg_match_all($regExp,$question,$mathches);

        return $mathches[0];
    }

    public static function getSkipTaskIcon($user, $id_block, $editMode)
{
    if ($editMode || $user == 0) {
        return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
    } else {

        $idTask = self::model()->findByAttributes(array('condition' => $id_block))->id;
        if (SkipTaskMarks::isTaskDone($user, $idTask)) {
            return StaticFilesHelper::createPath('image', 'lecture', 'taskDone.png');
        } else {
            return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
        }
    }
}

}
