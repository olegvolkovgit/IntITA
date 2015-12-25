<?php

/**
 * This is the model class for table "user_messages".
 *
 * The followings are the available columns in table 'user_messages':
 * @property integer $id_message
 * @property string $text
 * @property string $subject
 *
 * The followings are the available model relations:
 * @property StudentReg $sender
 */
class UserMessages extends Messages implements IMessage
{
    private $receivers;
    private $message;
    public $mailto;

    public function build($subject, $text, $receivers, StudentReg $sender) {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build($sender->id, 1);

        $this->subject = $subject;
        $this->text = $text;
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
			array('id_message, subject, text', 'required'),
			array('id_message', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id_message, text, subject', 'safe', 'on'=>'search'),
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
			'text' => 'Text',
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
		$criteria->compare('text',$this->text,true);
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
        $this->message->save();
        $this->id_message = $this->message->id;
        $this->id_message;

        $this->save();
        return $this;
    }

    public function send(IMailSender $sender){
        //foreach($this->receivers as $receiver){
           if($this->addReceiver($this->receivers)){
               $sender->send($this->receivers->email, "Name", $this->subject, $this->text);
           }
        //}

        $this->message->draft = 0;
        $this->message->save();

        return true;
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

    /**
     * @param $receiverString string, that we got from user message form (formatted as "lastName firstName middleName email")
     * @return StudentReg model for receiver
     */
    public function parseReceiverEmail($receiverString){
        $email = explode(' ', $receiverString);
        return StudentReg::model()->findByAttributes(array('email' => $email[count($email) - 1]));
    }

	public function sender(){
		return $this->message->sender;
	}

    public function createDate(){
        return $this->message->create_date;
    }
}
