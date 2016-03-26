<?php

/**
 * This is the model class for table "messages_payment".
 *
 * The followings are the available columns in table 'messages_payment':
 * @property integer $id_message
 * @property integer $operation_id
 *
 * The followings are the available model relations:
 * @property Operation $operation
 * @property Messages $message0
 */
class MessagesPayment extends Messages implements IMessage
{
    private $message;
    private $template;
    private $subject;
    private $receiver;
    private $billableObject;
    const TYPE = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_message', 'required'),
			array('id_message, operation_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_message, operation_id', 'safe', 'on'=>'search'),
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
			'operation' => array(self::BELONGS_TO, 'Operation', 'operation_id'),
			'message0' => array(self::BELONGS_TO, 'Messages', 'id_message'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'operation_id' => 'Operation',
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
		$criteria->compare('operation_id',$this->operation_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessagesPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function primaryKey()
    {
        return 'id_message';
    }

    public function build($operation, StudentReg $user, IBillableObject $billableObject, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build(Config::getAdminId(), self::TYPE, $chained, $original);

        $this->operation_id = ($operation)?$operation->id:null;
        $this->subject = $billableObject->paymentMailTheme();
        $this->template = $billableObject->paymentMailTemplate();
        $this->billableObject = $billableObject;
        $this->receiver = $user;
    }

	public function create(){
        $this->message->save();
        $this->id_message =  $this->message->id;
        $this->id_message;

        $this->save();
        return $this;
	}

	public function send(IMailSender $sender){
        $sender->renderBodyTemplate($this->template, array($this->billableObject));

		if ($this->addReceiver($this->receiver)) {
			$sender->send($this->receiver->email, '', $this->subject, '');
		}

        $this->message->draft = 0;
        return $this->message->save();
	}

	public function read(StudentReg $receiver){
        if (Yii::app()->db->createCommand()->update('message_receiver', array('read' => date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->message->id, ':receiver' => $receiver->id)) == 1
        )
            return true;
        else {
            return false;
        }
	}

	public function deleteMessage(StudentReg $receiver){
        if (Yii::app()->db->createCommand()->update('message_receiver', array('deleted' => date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->id_message, ':receiver' => $receiver->id)) == 1
        )
            return true;
        else {
            return false;
        }
	}

	public function reply(StudentReg $receiver){
        return false;
	}

	public function forward(StudentReg $receiver){
        return false;
	}

}
