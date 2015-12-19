<?php

/**
 * This is the model class for table "user_messages".
 *
 * The followings are the available columns in table 'user_messages':
 * @property integer $id_message
 * @property string $topic
 * @property string $subject
 *
 * The followings are the available model relations:
 * @property StudentReg $sender
 */
class UserMessages extends Messages implements IMessage
{
    private $receivers;

    public function build($topic, $subject, $receivers) {
        $this->subject = $subject;
        $this->topic = $topic;
        $this->receivers = $receivers;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_message, subject', 'required'),
			array('id_message', 'numerical', 'integerOnly'=>true),
			array('topic', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id_message, topic, subject', 'safe', 'on'=>'search'),
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
			'message' => array(self::BELONGS_TO, 'Messages', 'id_message'),
            'sender' => array(self::BELONGS_TO, 'StudentReg', 'sender'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'topic' => 'Topic',
			'subject' => 'Subject',
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

		$criteria->compare('id_message',$this->id_message, true);
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('subject',$this->subject,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function primaryKey(){
        return 'id_message';
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function create(){
        $this->save();

        return $this;
    }

    public function send(IMailSender $sender){

        foreach($this->receivers as $receiver){
            $this->addReceiver($receiver);
        }
    }

    public function read(StudentReg $receiver){
        if(Yii::app()->db->createCommand()->update('message_receiver', array('read'=> date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->message->id, ':receiver'=>$receiver->id)) == 1)
            return true;
        else {
            return false;
        }
    }

    public function deleteMessage(StudentReg $receiver){
        if(Yii::app()->db->createCommand()->update('message_receiver', array('deleted'=> date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->message->id, ':receiver'=>$receiver->id)) == 1)
            return true;
        else {
            return false;
        }
    }

    public function reply(StudentReg $receiver){

    }

    public function forward(StudentReg $receiver){

    }
}
