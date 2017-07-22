<?php

/**
 * This is the model class for table "messages_service_schemes_request".
 *
 * The followings are the available columns in table 'messages_service_schemes_request':
 * @property integer $id_message
 * @property integer $id_service
 * @property integer $id_schema_template
 * @property integer $id_user
 * @property string $date_create
 * @property string $date_checked
 * @property integer $user_checked
 * @property integer $status
 * @property string $comment
 * @property string $reject_comment
 *
 * The followings are the available model relations:
 * @property Service $service
 * @property StudentReg $user
 * @property Messages $message0
 * @property PaymentSchemeTemplate $schemesTemplate
 */
class MessagesServiceSchemesRequest extends Messages implements IMessage
{
    private $template = 'accountant'. DIRECTORY_SEPARATOR . '_newSchemesTemplateRequest';
    private $approveTemplate = 'accountant'. DIRECTORY_SEPARATOR . '_approveSchemesTemplateRequest';
    private $rejectRequestTemplate = 'accountant'. DIRECTORY_SEPARATOR . '_cancelSchemesTemplateRequest';
    private $cancelSchemesTemplate = 'accountant'. DIRECTORY_SEPARATOR . '_cancelSchemesTemplate';
    const TYPE = 13;
    private $receivers = array();
    private $schema_template;
    private $user;
    private $message;

    const NEW_REQUEST = 0;
    const IN_PROCESS = 1;
    const APPROVED = 2;
    const CANCELLED = 3;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages_service_schemes_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_message, id_service, id_user, id_schema_template', 'required'),
            array('id_message, id_service, id_user, user_checked, status', 'numerical', 'integerOnly' => true),
            array('id_message, id_service, id_user, date_checked, user_checked, status, comment, id_schema_template, reject_comment,date_create', 'safe'),
            // The following rule is used by search().
            array('id_message, id_service, id_user, date_checked, user_checked, status, comment, id_schema_template, reject_comment,date_create', 'safe', 'on' => 'search'),
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
            'service' => array(self::BELONGS_TO, 'Service', 'id_service'),
            'message0' => array(self::BELONGS_TO, 'Messages', 'id_message'),
            'coworkerChecked' => array(self::BELONGS_TO, 'StudentReg', 'user_checked'),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
            'schemesTemplate' => array(self::BELONGS_TO, 'PaymentSchemeTemplate', ['id_schema_template'=>'id']),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_message' => 'Id message',
            'id_service' => 'Id Service',
            'id_schema_template' => 'Id schema template',
            'id_user' => 'Id User',
            'date_create' => 'Date Create',
            'date_checked' => 'Date Checked',
            'user_checked' => 'User Checked',
            'status' => 'Status',
            'comment' => 'Comment',
            'reject_comment' => 'Reject Comment',
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
        $criteria->compare('id_service', $this->id_service, true);
        $criteria->compare('id_schema_template', $this->id_schema_template, true);
        $criteria->compare('id_user', $this->id_user, true);
        $criteria->compare('date_create', $this->date_create, true);
        $criteria->compare('date_checked', $this->date_checked, true);
        $criteria->compare('user_checked', $this->user_checked, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('reject_comment', $this->reject_comment, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MessagesServiceSchemesRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'id_message';
    }
    
    public function build(Service $service, PaymentSchemeTemplate $schemesTemplate, StudentReg $user, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->buildMessage($user->id, self::TYPE, $chained, $original);
        $this->id_service = $service->service_id;
        $this->id_schema_template = $schemesTemplate->id;
        $this->schema_template = $schemesTemplate;
        $this->id_user = $user->id;
        $this->user = $user;
        if($service->courseServices)
            $idOrganization=$service->courseServices->courseModel->id_organization;
        else $idOrganization=$service->moduleServices->moduleModel->id_organization;
        $this->receivers = MessagesServiceSchemesRequest::requestsReceiversArray($idOrganization);
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
        $sender->renderBodyTemplate($this->template, array($this->service, $this->user, $this->schema_template));
        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver)) {
                $sender->send($receiver->email, '', 'Запит на акційну схему проплат', '');
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

    public static function notCheckedRequests()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('status!=' . MessagesServiceSchemesRequest::IN_PROCESS);
        return MessagesServiceSchemesRequest::model()->findAll($criteria);
    }

    public function setCancelled($comment=null)
    {
        $user = RegisteredUser::userById($this->message0->sender);

        $this->status = MessagesServiceSchemesRequest::CANCELLED;
        $this->reject_comment = $comment;
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = date("Y-m-d H:i:s");
        if ($this->save()) {
            $this->notify($user->registrationData, 'Відхилено запит на застосування акційної схеми проплат', $this->rejectRequestTemplate,
                array($this->service, $this->schemesTemplate,$this->reject_comment));
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = date("Y-m-d H:i:s");
        if ($this->save()) {
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public function setComment($comment=null)
    {
        $this->comment = $comment;
        if ($this->save()) {
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }
    
    public function setChecked()
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = date("Y-m-d H:i:s");
        $this->save();
    }
    
    public function approve()
    {
        $this->status = MessagesServiceSchemesRequest::APPROVED;
        date_default_timezone_set(Config::getServerTimezone());
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = date("Y-m-d H:i:s");
        return $this->save();
    }

    public function notify(StudentReg $user, $subject, $template, $params)
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $message = new MessagesNotifications();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($user), StudentReg::model()->findByPk(Yii::app()->user->getId()));
            $message->create();

            $message->send($sender);
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }

    public function isRequestOpen($params)
    {
        $service = $params['service'];
        $schemaTemplate = $params['schemaTemplate'];
        $user = $params['user'];
        return (Yii::app()->db->createCommand(array(
                'select' => 'count(*)',
                'from' => 'messages_service_schemes_request mssr',
                'where' => 'mssr.id_service=' . $service . ' and id_schema_template='.$schemaTemplate.' and mssr.id_user=' . $user . ' and status=' . MessagesServiceSchemesRequest::NEW_REQUEST
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
        return "Запит на застосування акційної схеми проплат";
    }

    public function service()
    {
        return $this->id_service;
    }

    public function type()
    {
        return Request::USER_SERVICE_SCHEMES_REQUEST;
    }

    public function subject()
    {
        return "Запит на застосування акційної схеми проплат";
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

    public function isChecked()
    {
        if ($this->date_checked != null && $this->user_checked != null) {
            return true;
        } else {
            return false;
        }
    }

    public function isCancelled()
    {
        return $this->status == self::CANCELLED;
    }

    public function isApprovable()
    {
        return ($this->status == self::NEW_REQUEST || $this->status == self::IN_PROCESS);
    }

    public function statusToString()
    {
        if ($this->isCancelled()) {
            return 'скасований';
        } else {
            if ($this->isChecked()) {
                return 'підтверджений';
            } else {
                return 'очікує затвердження';
            }
        }
    }

    public function checkedByToString()
    {
        if ($this->isChecked()) {
            return 'Підтверджено: ' . $this->coworkerChecked->userNameWithEmail() . ' ' . date("d.m.Y H:i", strtotime($this->date_checked));
        } else {
            return '';
        }
    }

    public function message(){
        return $this->message0;
    }

    public function isRejected()
    {
        if ($this->status==MessagesServiceSchemesRequest::CANCELLED) {
            return true;
        } else {
            return false;
        }
    }

    public function reject()
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->status = MessagesServiceSchemesRequest::CANCELLED;
        if ($this->save()) {
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public static function requestsReceiversArray($idOrganization=null){
        $sql=$idOrganization?' and ua.id_organization='.$idOrganization:'';
        $criteria = new CDbCriteria();
        $criteria->alias = 'u';
        $criteria->join = 'join user_accountant ua on ua.id_user=u.id';
        $criteria->addCondition('ua.end_date IS NULL'.$sql);
        $criteria->distinct = true;

        return StudentReg::model()->findAll($criteria);
    }
}