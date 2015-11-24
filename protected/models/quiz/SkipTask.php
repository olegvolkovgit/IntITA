<?php

/**
 * This is the model class for table "skip_task".
 *
 * The followings are the available columns in table 'skip_task':
 * @property integer $id
 * @property integer $author
 * @property integer $condition
 *
 * The followings are the available model relations:
 * @property LectureElement $condition0
 * @property Teacher $author0
 * @property SkipTaskAnswers[] $skipTaskAnswers
 * @property SkipTaskMarks[] $skipTaskMarks
 */
class SkipTask extends Quiz
{
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
			array('author, condition', 'required'),
			array('author, condition', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id, author, condition', 'safe', 'on'=>'search'),
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
			'author0' => array(self::BELONGS_TO, 'Teacher', 'author'),
			'skipTaskAnswers' => array(self::HAS_MANY, 'SkipTaskAnswers', 'id_task'),
			'skipTaskMarks' => array(self::HAS_MANY, 'SkipTaskMarks', 'id_task'),
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
        $model = new SkipTask();

        $model->author = $arr['author'];
        $model->condition = $arr['block'];

        if($model->validate())
        {
            $model->save();
            LecturePage::addQuiz($arr['pageId'], $arr['block']);
            return true;
        }

        return false;
    }
}
