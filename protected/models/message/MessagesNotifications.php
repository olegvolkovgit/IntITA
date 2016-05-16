<?php

/**
 * This is the model class for table "messages_notifications".
 *
 * The followings are the available columns in table 'messages_notifications':
 * @property integer $id_message
 * @property string $subject
 * @property string $text
 *
 * The followings are the available model relations:
 * @property StudentReg $sender
 * @property Messages $message0
 */
class MessagesNotifications extends Messages implements IMessage
{
	const TYPE = MessagesType::NOTIFICATION;
	//UserMessages model
    private $receivers;
    public $message;
    public $mailto;
    public $parent;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages_notifications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_message, subject, text', 'required'),
			array('id_message', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id_message, subject, text', 'safe', 'on'=>'search'),
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
            'message0' => array(self::BELONGS_TO, 'Messages', 'id_message'),
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
			'subject' => 'Subject',
			'text' => 'Text',
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

		$criteria->compare('id_message',$this->id_message);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessagesNotifications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function build($subject, $text, $receivers, StudentReg $sender, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build($sender->id, self::TYPE, $chained, $original);

        $this->subject = $subject;
        $this->text = $text;
        $this->receivers = $receivers;
        return $this;
    }

    public function create()
    {
        $this->message->save();
        $this->id_message = $this->message->id;
        $this->id_message;

        $this->save();
        return $this;
    }

    public function send(IMailSender $sender)
    {
        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver)) {
                $subject = ($this->subject)?$this->subject:"Сповіщення";
                $sender->send($receiver->email, "", $subject, "");
            }
        }

        $this->message->draft = 0;
        $this->message->save();
        return true;
    }

    public function read(StudentReg $receiver)
    {
        if (Yii::app()->db->createCommand()->update('message_receiver', array('read' => date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->id_message, ':receiver' => $receiver->id)) == 1
        )
            return true;
        else {
            return false;
        }
    }

    public function deleteMessage(StudentReg $receiver)
    {
        if (Yii::app()->db->createCommand()->update('message_receiver', array('deleted' => date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->message()->id, ':receiver' => $receiver->id)) == 1
        )
            return true;
        else {
            return false;
        }
    }

	/**
	 * Not supported.
	 * @param StudentReg $receiver
	 */
	public function reply(StudentReg $receiver){
		return null;
	}

	/**
	 * Not supported.
	 * @param StudentReg $receiver
	 */
	public function forward(StudentReg $receiver){
		return null;
	}

	/**
	 * @return int MessagesType constant code.
	 */
	public function type(){
		return self::TYPE;
	}

    // return true if message read by $receiver (param "read" is NULL)
    public function isRead(StudentReg $receiver)
    {
        $read = Yii::app()->db->createCommand()
            ->select('read')
            ->from('message_receiver')
            ->where('id_message=:message and id_receiver=:receiver',
                array(':message' => $this->id_message, ':receiver' => $receiver->id)
            )->queryRow();

        if ($read["read"])
            return true;
        else return false;
    }

    public function isDeleted(StudentReg $receiver)
    {
        $read = Yii::app()->db->createCommand()
            ->select('deleted')
            ->from('message_receiver')
            ->where('id_message=:message and id_receiver=:receiver',
                array(':message' => $this->id_message, ':receiver' => $receiver->id)
            )->queryRow();

        if ($read["deleted"])
            return true;
        else return false;
    }


    public function subject(){
        return $this->subject;
    }

    public function text(){
        return $this->text;
    }
}
