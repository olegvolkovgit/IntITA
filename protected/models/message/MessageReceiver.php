<?php

/**
 * This is the model class for table "message_receiver".
 *
 * The followings are the available columns in table 'message_receiver':
 * @property integer $id_message
 * @property integer $id_receiver
 * @property string $read
 * @property string $deleted
 */
class MessageReceiver extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message_receiver';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_message, id_receiver', 'required'),
			array('id_message, id_receiver', 'numerical', 'integerOnly'=>true),
			array('read, deleted', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_message, id_receiver, read, deleted', 'safe', 'on'=>'search'),
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
				'receiver' => array(self::BELONGS_TO, 'StudentReg', 'id_receiver'),
				'message' => array(self::BELONGS_TO, 'Messages', 'id_message'),
				'sender' => array(self::BELONGS_TO, 'StudentReg', array('sender'=>'id'), 'through' => 'message'),
				'userMessages' => array(self::BELONGS_TO, 'UserMessages', 'id_message'),
				'paymentMessage'=>array(self::BELONGS_TO, 'MessagesPayment', 'id_message'),
				'approveRevisionMessages'=>array(self::BELONGS_TO, 'MessagesApproveRevision', 'id_message'),
				'rejectRevisionMessages'=>array(self::BELONGS_TO, 'MessagesRejectRevision', 'id_message'),
				'notificationMessages'=>array(self::BELONGS_TO, 'MessagesNotifications', 'id_message'),
				'rejectModuleRevisionMessages'=>array(self::BELONGS_TO, 'MessagesRejectModuleRevision', 'id_message'),
				'payCourse' => array(self::BELONGS_TO, 'CourseService', array('service_id'=>'service_id'), 'through' => 'paymentMessage'),
				'payModule' => array(self::BELONGS_TO, 'ModuleService', array('service_id'=>'service_id'), 'through' => 'paymentMessage'),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'id_receiver' => 'Id Receiver',
			'read' => 'Read',
			'deleted' => 'Deleted',
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

		$criteria->compare('id_message',$this->id_message);
		$criteria->compare('id_receiver',$this->id_receiver);
		$criteria->compare('read',$this->read,true);
		$criteria->compare('deleted',$this->deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessageReceiver the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function requestsReceiversArray($idOrganization=null){
	    $sql=$idOrganization?' and ucm.id_organization='.$idOrganization:'';
        $criteria = new CDbCriteria();
        $criteria->alias = 'u';
        $criteria->join = 'join user_content_manager ucm on ucm.id_user=u.id';
        $criteria->addCondition('ucm.end_date IS NULL'.$sql);
        $criteria->distinct = true;

        return StudentReg::model()->findAll($criteria);
	}
}
