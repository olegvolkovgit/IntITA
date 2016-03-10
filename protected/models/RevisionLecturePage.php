<?php

/**
 * This is the model class for table "vc_lecture_page".
 *
 * The followings are the available columns in table 'vc_lecture_page':
 * @property integer $id
 * @property integer $id_revision
 * @property string $page_title
 * @property integer $page_order
 * @property integer $video
 * @property integer $quiz
 * @property string $start_date
 * @property integer $id_user_created
 * @property string $reject_date
 * @property integer $id_user_rejected
 * @property string $approve_date
 * @property integer $id_user_approved
 * @property string $end_date
 * @property integer $id_user_cancelled
 *
 * The followings are the available model relations:
 * @property LectureElement[] $lectureElements
 * @property Lecture $idRevision
 */
class RevisionLecturePage extends CActiveRecord
{
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
			array('id_revision, page_order, video, quiz, id_user_created, id_user_rejected, id_user_approved, id_user_cancelled', 'numerical', 'integerOnly'=>true),
			array('page_title', 'length', 'max'=>255),
			array('reject_date, approve_date, end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_revision, page_title, page_order, video, quiz, start_date, id_user_created, reject_date, id_user_rejected, approve_date, id_user_approved, end_date, id_user_cancelled', 'safe', 'on'=>'search'),
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
			'lectureElements' => array(self::HAS_MANY, 'LectureElement', 'id_page'),
			'revision' => array(self::BELONGS_TO, 'Lecture', 'id_revision'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_revision' => 'Id Revision',
			'page_title' => 'Page Title',
			'page_order' => 'Page Order',
			'video' => 'Video',
			'quiz' => 'Quiz',
			'start_date' => 'Start Date',
			'id_user_created' => 'Id User Created',
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
		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_order',$this->page_order);
		$criteria->compare('video',$this->video);
		$criteria->compare('quiz',$this->quiz);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('id_user_created',$this->id_user_created);
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

	public function initialize($idRevision, $user) {
		//default value
		$this->page_title = "";
		$this->page_order = 1;
		$this->video = null;
		$this->quiz = null;

		$this->start_date = date(Yii::app()->params['dbDateFormat']);
		$this->id_user_created = $user->getId();

		$this->id_revision = $idRevision;

		if(!$this->save()) {
			throw new RevisionLecturePageException(implode("; ", $this->getErrors()));
		}
	}
}
