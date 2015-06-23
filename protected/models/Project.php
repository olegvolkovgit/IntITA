<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property integer $id_leader
 * @property integer $is_completed
 * @property string $title
 * @property string $start_date
 * @property integer $mark
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Teacher $idLeader
 * @property ProjectStudent[] $projectStudents
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_leader, title, start_date, mark, comment', 'required'),
			array('id_leader, is_completed, mark', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('comment', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_leader, is_completed, title, start_date, mark, comment', 'safe', 'on'=>'search'),
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
			'idLeader' => array(self::BELONGS_TO, 'Teacher', 'id_leader'),
			'projectStudents' => array(self::HAS_MANY, 'ProjectStudent', 'project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_leader' => 'Id Leader',
			'is_completed' => 'Is Completed',
			'title' => 'Title',
			'start_date' => 'Start Date',
			'mark' => 'Mark',
			'comment' => 'Comment',
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
		$criteria->compare('id_leader',$this->id_leader);
		$criteria->compare('is_completed',$this->is_completed);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('mark',$this->mark);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getProjectsByLeader($leader){
        $projects = Yii::app()->db->createCommand(array(
            'select' => array('id', 'title'),
            'from' => 'project',
            'where' => 'id_leader=:id',
            'order' => 'id',
            'params' => array(':id' => $leader),
        ))->queryAll();

        return (!empty($projects))?$projects:[];
    }
}
