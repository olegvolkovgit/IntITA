<?php

/**
 * This is the model class for table "messages_coworker_request".
 *
 * The followings are the available columns in table 'messages_coworker_request':
 * @property integer $id_message
 * @property integer $id_teacher
 * @property string $date_approved
 * @property integer $user_approved
 * @property integer $cancelled
 *
 * The followings are the available model relations:
 * @property Messages $idMessage
 * @property StudentReg $idTeacher
 * @property StudentReg $userApproved
 * @property Messages $message0
 */
class MessagesCoworkerRequest extends Messages implements IMessage, IRequest
{
    private $template =  'coworker'. DIRECTORY_SEPARATOR . '_newCoworkerRequest';
    private $approveTemplate = 'coworker'. DIRECTORY_SEPARATOR . '_approveCoworkerRequest';
    private $cancelTemplate = 'coworker'. DIRECTORY_SEPARATOR . '_cancelCoworkerRequest';
    const TYPE = MessagesType::COWORKER_REQUEST;
    private $receivers = array();
    private $author;
    private $coworker;
    private $message;
    const DELETED = 1;
    const ACTIVE = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages_coworker_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_teacher', 'required'),
            array('id_message, id_teacher, user_approved, cancelled', 'numerical', 'integerOnly' => true),
            array('date_approved', 'safe'),
            // The following rule is used by search().
            array('id_message, id_teacher, date_approved, user_approved, cancelled', 'safe', 'on' => 'search'),
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
            'idMessage' => array(self::BELONGS_TO, 'Messages', 'id_message'),
            'idTeacher' => array(self::BELONGS_TO, 'StudentReg', 'id_teacher'),
            'message0' => array(self::BELONGS_TO, 'Messages', 'id_message'),
            'userApproved' => array(self::BELONGS_TO, 'StudentReg', 'user_approved'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_message' => 'Id Message',
            'id_teacher' => 'Id Teacher',
            'date_approved' => 'Date Approved',
            'user_approved' => 'User Approved',
            'cancelled' => 'Cancelled',
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
        $criteria = new CDbCriteria;

        $criteria->compare('id_message', $this->id_message);
        $criteria->compare('id_teacher', $this->id_teacher);
        $criteria->compare('date_approved', $this->date_approved, true);
        $criteria->compare('user_approved', $this->user_approved);
        $criteria->compare('cancelled', $this->cancelled);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MessagesCoworkerRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'id_message';
    }

    public function build(StudentReg $user, StudentReg $teacher, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build($user->id, self::TYPE, $chained, $original);
        $this->author = $user;
        $this->id_teacher = $teacher->id;
        $this->coworker = $teacher;
        $this->receivers = UserAdmin::adminsArray();
    }

    public function create()
    {
        $this->message->save();
        $this->id_message = $this->message->id;
        $this->save();
        return $this;
    }

    public function send(IMailSender $sender)
    {
        $sender = new MailTransport();
        $sender->renderBodyTemplate($this->template, array($this->author, $this->coworker));

        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver->user)) {
                $sender->send($receiver->user->email, '', $this->title(), '');
            }
        }
        $this->message->draft = 0;
        return $this->message->save();
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
                array(':message' => $this->id_message, ':receiver' => $receiver->id)) == 1
        )
            return true;
        else {
            return false;
        }
    }

    public function reply(StudentReg $receiver)
    {
        return false;
    }

    public function forward(StudentReg $receiver)
    {
        return false;
    }

    public static function notApprovedRequests()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('date_approved IS NULL');
        $criteria->addCondition('cancelled=' . MessagesCoworkerRequest::ACTIVE);
        return MessagesCoworkerRequest::model()->findAll($criteria);
    }

    public function setDeleted()
    {
        $this->cancelled = MessagesCoworkerRequest::DELETED;

        if ($this->save()) {
            $this->notify($this->sender(), 'Відхилено запит на призначення співробітника',
                $this->cancelTemplate, array($this->idTeacher));
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public function setApproved()
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_approved = Yii::app()->user->getId();
        $this->date_approved = date("Y-m-d H:i:s");
        $this->save();
    }

    public function approve(StudentReg $userApprove)
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_approved = $userApprove->id;
        $this->date_approved = date("Y-m-d H:i:s");
        if ($this->save()) {
            $this->notify($this->sender(), 'Підтверджено запит на призначення співробітника',
                $this->approveTemplate, array($this->idTeacher));
                return true;
        }
        return false;
    }

    public function notify(StudentReg $user, $subject, $template, $params){
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $message = new MessagesNotifications();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($user), StudentReg::getAdminModel());
            $message->create();

            $message->send($sender);
            $transaction->commit();
        } catch (Exception $e){
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }

    /**
     * @param $params : array, first elem must be user id that must be assigned as coworker
     * @return bool
     */
    public function isRequestOpen($params)
    {
        $user = $params[0];
        return (Yii::app()->db->createCommand(array(
                'select' => 'count(*)',
                'from' => 'messages_coworker_request mr',
                'join' => 'LEFT JOIN messages m ON m.id = mr.id_message',
                'where' => 'm.sender=' . $user . ' and cancelled=' . MessagesCoworkerRequest::ACTIVE .
                    ' and date_approved IS NULL'
            ))->queryScalar() > 0) ? true : false;
    }

    public function getMessageId()
    {
        return $this->id_message;
    }

    public function sender()
    {
        return $this->message0->sender0;
    }

    public function title()
    {
        return "Запит на призначення співробітника";
    }

    // not supported
    public function module()
    {
        return null;
    }

    public function type()
    {
        return Request::COWORKER_REQUEST;
    }

    public function subject()
    {
        return "Запит на призначення співробітника";
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

    public function teacher(){
        return $this->idTeacher;
    }

    public function isApproved(){
        if($this->date_approved != null && $this->user_approved != null){
            return true;
        } else {
            return false;
        }
    }

    public function isDeleted(){
        return $this->cancelled == self::DELETED;
    }

    public function statusToString(){
        if($this->isDeleted()){
            return 'видалений';
        } else {
            if($this->isApproved()){
                return 'підтверджений';
            } else {
                return 'очікує затвердження';
            }
        }
    }


    public function approvedByToString()
    {
        if ($this->isApproved()) {
            return 'Підтверджено: ' . $this->userApproved->userNameWithEmail() . ' ' . date("d.m.Y H:i", strtotime($this->date_approved));
        } else {
            return '';
        }
    }

    public function message(){
        return $this->message0;
    }
}
