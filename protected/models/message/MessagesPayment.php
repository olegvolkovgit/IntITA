<?php

/**
 * This is the model class for table "messages_payment".
 *
 * The followings are the available columns in table 'messages_payment':
 * @property integer $id_message
 * @property integer $operation_id
 * @property integer $service_id
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
			array('id_message, operation_id, service_id', 'numerical', 'integerOnly'=>true),
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
            'service_id' => 'Service',
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
        $criteria->compare('service_id',$this->service_id);

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

    public function build($operation, StudentReg $user, IBillableObject $billableObject, $educForm = EducationForm::ONLINE,
						  $chained = null, $original = null)
    {
        //create and init parent model
		$educFormModel = EducationForm::model()->findByPk($educForm);
        $this->message = new Messages();
        $this->message->buildMessage(Config::getAdminId(), self::TYPE, $chained, $original);

        $this->operation_id = ($operation)?$operation->id:null;
        $this->subject = $billableObject->paymentMailTheme();
        $this->template = $billableObject->paymentMailTemplate();
        $this->billableObject = $billableObject;
        $this->receiver = $user;
        $this->service_id = ($billableObject->getType() == 'K')?CourseService::getService($billableObject->course_ID, $educFormModel)->service_id:
        ModuleService::model()->getService($billableObject->module_ID, $educFormModel)->service_id;
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
            $this->notifyUser('newMessages-'.$this->receiver->id,['messages'=>1]);
		}

        $this->message->draft = 0;
        return $this->message->save();
	}

	public function read(StudentReg $receiver){
        if (Yii::app()->db->createCommand()->update('message_receiver', array('read' => date("Y-m-d H:i:s")),
                'id_message=:message and id_receiver=:receiver',
                array(':message' => $this->message0->id, ':receiver' => $receiver->id)) == 1
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

    public function subject(){
        if(!$this->billableObject){
            if($this->service_id == null) {
                return "Доступ до лекцій";
            } else {
                $service = AbstractIntITAService::getServiceById($this->service_id);
                $this->billableObject = $service->getBillableObject();
            }
        }
        return $this->billableObject->paymentMailTheme();
    }

	public function message(){
		return $this->message0;
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

    public function text(){
        if(!$this->billableObject){
            if($this->service_id == null) {
                return "Вітаємо!<br> Тобі надано доступ до лекцій модуля N!.";
            } else {
                $service = AbstractIntITAService::getServiceById($this->service_id);
                $this->billableObject = $service->getBillableObject();
            }
        }
        $sender = new MailTransport();
        $sender->renderBodyTemplate($this->billableObject->paymentMailTemplate(), array($this->billableObject));
        return $sender->template();
    }

    public function type(){
        return MessagesType::PAYMENT;
    }
}
