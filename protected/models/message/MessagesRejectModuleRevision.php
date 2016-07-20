<?php

/**
 * This is the model class for table "messages_reject_module_revision".
 *
 * The followings are the available columns in table 'messages_reject_module_revision':
 * @property integer $id_message
 * @property integer $id_revision
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Messages $message0
 * @property RevisionModule $idRevision
 */
class MessagesRejectModuleRevision extends Messages implements IMessage
{
	private $message;
	private $template = 'revision/_rejectModuleRevisionNotification';
	private $subject;
	private $receiver;
    private $revision;
	const TYPE = MessagesType::REJECT_MODULE_REVISION;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages_reject_module_revision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_revision', 'required'),
			array('id_message, id_revision', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_message, id_revision, comment', 'safe', 'on'=>'search'),
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
			'idRevision' => array(self::BELONGS_TO, 'RevisionModule', 'id_revision'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'id_revision' => 'Id Revision',
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
        $criteria=new CDbCriteria;

		$criteria->compare('id_message',$this->id_message);
		$criteria->compare('id_revision',$this->id_revision);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessagesRejectRevision the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function primaryKey()
    {
        return 'id_message';
    }

    public function build(StudentReg $userRejected, RevisionModule $revision, $comment = "", $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build($userRejected->id, self::TYPE, $chained, $original);

        $this->revision = $revision;
        $this->id_revision = $revision->id_module_revision;
        $this->comment = $comment;
        $this->subject = $this->subject();
        $this->receiver = StudentReg::model()->findByPk($revision->properties->id_user_created);
    }

    public function create(){
        $this->message->save();
        $this->id_message =  $this->message->id;
        $this->id_message;

        $this->save();
        return $this;
    }

    public function send(IMailSender $sender){
        $sender->renderBodyTemplate($this->template, array($this->message0->sender0, $this->revision,
            substr($this->comment, 0, 50)));

        if ($this->addReceiver($this->receiver)) {
            $sender->send($this->receiver->email, '', $this->subject, '');
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
        return "Ревізію модуля №".$this->id_revision." відхилено";
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
        $sender = new MailTransport();
        $sender->renderBodyTemplate($this->template, array($this->message0->sender0, $this->idRevision,
            substr($this->comment, 0, 50)));
        return $sender->template();
    }

    public function type(){
        return MessagesType::REJECT_MODULE_REVISION;
    }

    public function sendModuleRevisionRejectMessage(RevisionModule $revision, $comment){
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $this->build(Yii::app()->user->model->registrationData, $revision, $comment);
            $this->create();
            $sender = new MailTransport();

            $this->send($sender);
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Лист з причиною відхилення ревізії надіслати не вдалося.");
        }
    }
}
