<?php

/**
 * This is the model class for table "plain_task".
 *
 * The followings are the available columns in table 'plain_task':
 * @property integer $id
 * @property integer $block_element
 * @property integer $author
 * @property integer $uid
 *
 *  @property LecturePage $lecturePage
 */
class PlainTask extends Quiz
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plain_task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block_element, author, uid', 'required'),
			array('block_element, author, uid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
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
            'lectureElement' => array(self::BELONGS_TO,'LectureElement','block_element'),
            'lecturePage' => array(self::BELONGS_TO,'LecturePage', 'block_element'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'block_element' => Yii::t('lecture','0774'),
			'author' => Yii::t('lecture','0775'),
			'uid' => 'UID',
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
	 * @return PlainTask the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function addTask($arr)
    {
        $model = new PlainTask();

        $model->author = $arr['author'];
        $model->block_element = $arr['block'];

        if($model->validate())
        {
            $model->save();
            LecturePage::addQuiz($arr['pageId'], $arr['block']);
        }
    }

    public static function getPlainTaskIcon($user, $id_block, $editMode)
    {
        if ($editMode || $user == 0) {
            return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
        } else {

            $idTask = self::model()->findByAttributes(array('block_element' => $id_block))->id;
            if (PlainTaskMarks::isTaskDone($user, $idTask)) {
                return StaticFilesHelper::createPath('image', 'lecture', 'taskDone.png');
            } else {
                return StaticFilesHelper::createPath('image', 'lecture', 'task.png');
            }
        }
    }

    public function getDescription()
    {
		return $this->lectureElement->html_block;
    }
}
