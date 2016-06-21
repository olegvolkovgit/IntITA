<?php

/**
 * This is the model class for table "messages_revision_request".
 *
 * The followings are the available columns in table 'messages_revision_request':
 * @property integer $id_message
 * @property integer $id_revision
 * @property string $date_approved
 * @property integer $user_approved
 * @property integer $cancelled
 *
 * The followings are the available model relations:
 * @property Messages $message0
 * @property StudentReg $userApproved
 * @property RevisionLecture $idRevision
 */
class MessagesRevisionRequest extends Messages implements IMessage, IRequest
{
    private $template = 'revision'. DIRECTORY_SEPARATOR . '_revisionRequest';
    private $approvedTemplate = 'revision'. DIRECTORY_SEPARATOR . '_revisionRequestApproved';
    private $cancelledTemplate = 'revision'. DIRECTORY_SEPARATOR . '_revisionRequestCancelled';
    const TYPE = MessagesType::REVISION_REQUEST;
    private $receivers = array();
    private $revision;
    private $message;

    const DELETED = 1;
    const ACTIVE = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages_revision_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_message, id_revision', 'required'),
            array('id_message, id_revision, user_approved, cancelled', 'numerical', 'integerOnly' => true),
            array('date_approved', 'safe'),
            // The following rule is used by search().
            array('id_message, id_revision, date_approved, user_approved, cancelled', 'safe', 'on' => 'search'),
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
            'userApproved' => array(self::BELONGS_TO, 'StudentReg', 'user_approved'),
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
            'date_approved' => 'Date Approved',
            'user_approved' => 'User Approved',
            'cancelled' => '0 - actual, 1 - cancelled',
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
        $criteria->compare('id_revision', $this->id_revision);
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
     * @return MessagesRevisionRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'id_message';
    }

    public function build(RevisionLecture $revision, StudentReg $user, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->build($user->id, self::TYPE, $chained, $original);

        $this->revision = $revision;
        $this->id_revision = $revision->id_revision;
        $this->receivers = MessageReceiver::requestsReceiversArray();
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
        $sender->renderBodyTemplate($this->template, array($this->message0->sender0, $this->revision));

        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver)) {
                $sender->send($receiver->email, '', 'Запит на затвердження ревізії', '');
            }
        }

        $this->message->draft = 0;
        return $this->message->save();
    }

    //not supported
    public function read(StudentReg $receiver)
    {
        return false;
    }

    //not supported
    public function deleteMessage(StudentReg $receiver)
    {
        return false;
    }

    //not supported
    public function reply(StudentReg $receiver)
    {
        return false;
    }

    //not supported
    public function forward(StudentReg $receiver)
    {
        return false;
    }

    public static function notApprovedRequests()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('date_approved IS NULL');
        $criteria->addCondition('cancelled=' . MessagesRevisionRequest::ACTIVE);

        return MessagesRevisionRequest::model()->findAll($criteria);
    }

    public function setDeleted()
    {
        $this->cancelled = self::DELETED;
        if ($this->save()) {
            $this->message()->sender0->notify($this->cancelledTemplate, array($this->idRevision),
                'Запит на затвердження ревізії лекції відхилено');
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public function approve(StudentReg $userApprove)
    {
        $this->idRevision->approve(Yii::app()->user);
        $this->user_approved = $userApprove->id;
        $this->date_approved = date("Y-m-d H:i:s");
        if ($this->save()) {
            $this->message()->sender0->notify($this->approvedTemplate,
                array($this->idRevision),
                'Запит на затвердження ревізії лекції успішно підтверджено');
            return "Запит успішно підтверджений.";
        }

        return "Операцію не вдалося виконати";
    }

    public function isRequestOpen($params)
    {
        $revision = $params[0];
        return (Yii::app()->db->createCommand(array(
                'select' => 'count(*)',
                'from' => 'messages_revision_request mr',
                'join' => 'LEFT JOIN messages m ON m.id = mr.id_message',
                'where' => 'mr.id_revision=' . $revision->id_revision . ' and cancelled=' . self::ACTIVE .
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
        return "Запит на затвердження ревізії лекції";
    }

    public function module()
    {
        return $this->idRevision->module;
    }

    public function type()
    {
        return Request::REVISION_REQUEST;
    }

    public function subject()
    {
        return "Запит на призначення викладача-консультанта для модуля";
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

    public function message()
    {
        return $this->message0;
    }

    public function isApproved()
    {
        if ($this->date_approved != null && $this->user_approved != null) {
            return true;
        } else {
            return false;
        }
    }

    public function isDeleted()
    {
        return $this->cancelled == self::DELETED;
    }

    public function statusToString()
    {
        if ($this->isDeleted()) {
            return 'видалений';
        } else {
            if ($this->isApproved()) {
                return 'підтверджений';
            } else {
                return 'очікує затвердження';
            }
        }
    }

    public function approvedByToString()
    {
        if ($this->isApproved()) {
            return 'Підтверджено: ' . $this->userApproved->userNameWithEmail() . ' ' . date("d.m.Y H:m", strtotime($this->date_approved));
        } else {
            return '';
        }
    }
}
