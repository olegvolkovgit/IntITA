<?php

/**
 * This is the model class for table "messages_approve_revision".
 *
 * The followings are the available columns in table 'messages_approve_revision':
 * @property integer $id_message
 * @property integer $id_revision
 *
 * The followings are the available model relations:
 * @property Messages $message0
 * @property RevisionLecture $idRevision
 */
class MessagesApproveRevision extends CActiveRecord /*extends Messages*/ implements IMessage
{
	private $message;
	private $template = 'revision'. DIRECTORY_SEPARATOR . '_approveRevisionNotification';
	private $subject;
	private $receiver;
	private $revision;
	const TYPE = MessagesType::APPROVE_REVISION;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'messages_approve_revision';
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
			array('id_message, id_revision', 'safe', 'on'=>'search'),
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
			'idRevision' => array(self::BELONGS_TO, 'RevisionLecture', 'id_revision'),
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessagesApproveRevision the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey()
	{
		return 'id_message';
	}

    //todo
	public function build(StudentReg $userApproved, RevisionLecture $revision, $chained = null, $original = null)
	{
		//create and init parent model
		$this->message = new Messages();
		$this->message->build($userApproved->id, self::TYPE, $chained, $original);

    	$this->revision = $revision;
		$this->id_revision = $revision->id_revision;
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
		$sender->renderBodyTemplate($this->template, array($this->message0->sender0, $this->revision));

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
		return "Ревізію №".$this->id_revision." затверджено";
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
		$sender->renderBodyTemplate($this->template, array($this->message0->sender0, $this->idRevision));
		return $sender->template();
	}

	public function type(){
		return MessagesType::APPROVE_REVISION;
	}
}
