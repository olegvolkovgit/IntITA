<?php

/**
 * This is the model class for table "messages_written_agreements_request".
 *
 * The followings are the available columns in table 'messages_written_agreements_request':
 * @property integer $id_message
 * @property integer $id_agreement
 * @property integer $id_user
 * @property string $date_create
 * @property string $date_checked
 * @property integer $user_checked
 * @property integer $status
 * @property string $comment
 * @property string $reject_comment
 *
 * The followings are the available model relations:
 * @property UserAgreements $agreement
 * @property StudentReg $user
 * @property Messages $message0
 * @property StudentReg $coworkerChecked
 *
 */

class MessagesWrittenAgreementRequest extends Messages implements IMessage
{
    private $template = 'accountant'. DIRECTORY_SEPARATOR . '_newWrittenAgreementRequest';
    private $approveTemplate = 'accountant'. DIRECTORY_SEPARATOR . '_approveWrittenAgreementRequest';
    private $rejectRequestTemplate = 'accountant'. DIRECTORY_SEPARATOR . '_cancelWrittenAgreementRequest';

    const TYPE = 14;
    private $receivers = array();
    private $user;
    private $message;

    const NEW_REQUEST = null;
    const APPROVED = 1;
    const CANCELLED = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages_written_agreements_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_message, id_agreement, id_user', 'required'),
            array('id_message, id_agreement, id_user, user_checked, status', 'numerical', 'integerOnly' => true),
            array('id_message, id_agreement, id_user, date_checked, user_checked, status, comment, reject_comment,date_create', 'safe'),
            // The following rule is used by search().
            array('id_message, id_agreement, id_user, date_checked, user_checked, status, comment, reject_comment,date_create', 'safe', 'on' => 'search'),
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
            'agreement' => array(self::BELONGS_TO, 'UserAgreements', 'id_agreement'),
            'message0' => array(self::BELONGS_TO, 'Messages', 'id_message'),
            'coworkerChecked' => array(self::BELONGS_TO, 'StudentReg', 'user_checked'),
            'user' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
            'service' => [self::BELONGS_TO, 'Service', ['service_id' => 'service_id'], 'through' => 'agreement'],
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_message' => 'Id message',
            'id_agreement' => 'Id Agreement',
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
        $criteria->compare('id_agreement', $this->id_agreement, true);
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
     * @return MessagesWrittenAgreementRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'id_message';
    }

    public function build(UserAgreements $agreement, StudentReg $user, $chained = null, $original = null)
    {

        //create and init parent model
        $this->message = new Messages();
        $this->message->buildMessage($user->id, self::TYPE, $chained, $original);
        $this->id_agreement = $agreement->id;
        $this->id_user = $user->id;
        $this->user = $user;
        if($agreement->service->courseServices)
            $idOrganization=$agreement->service->courseServices->courseModel->id_organization;
        else $idOrganization=$agreement->service->moduleServices->moduleModel->id_organization;
        $this->receivers = MessagesWrittenAgreementRequest::requestsReceiversArray($idOrganization);
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
        $sender->renderBodyTemplate($this->template, array($this->agreement, $this->user));
        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver)) {
                $sender->send($receiver->email, '', 'Запит на затвердження паперовго договору', '');
                $this->notifyUser('newMessages-'.$receiver->id,['messages'=>1]);
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
        $criteria->addCondition('status is NULL');
        return MessagesWrittenAgreementRequest::model()->findAll($criteria);
    }

    public function setApproved($sessionTime)
    {
        $user = RegisteredUser::userById($this->message0->sender);

        $this->status = MessagesWrittenAgreementRequest::APPROVED;
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = new CDbExpression('NOW()');
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $this->save();

            $builder = new ContractingPartyBuilder();
            $contractingParty = $builder->makePrivatePerson($this->agreement->user);
            $contractingParty->bindToAgreement($this->agreement, ContractingParty::ROLE_STUDENT);
            $this->agreement->user->checkedActualUserDocuments($sessionTime);
            $this->notify($user->registrationData, 'Затвердження запиту по паперовому договору', $this->approveTemplate, array($this->agreement));

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw new \application\components\Exceptions\IntItaException(500, $e->getMessage());
        }
    }

    public function setCancelled($comment=null)
    {
        $user = RegisteredUser::userById($this->message0->sender);

        $this->status = MessagesWrittenAgreementRequest::CANCELLED;
        $this->reject_comment = $comment;
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = new CDbExpression('NOW()');
        if ($this->save()) {
            $this->notify($user->registrationData, 'Відхилено запит на затвердження паперового договору', $this->rejectRequestTemplate,
                array($this->agreement, $this->reject_comment));
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

    public function setStatus($status,$comment)
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
        $this->status = MessagesWrittenAgreementRequest::APPROVED;
        $this->user_checked = Yii::app()->user->getId();
        $this->date_checked = new CDbExpression('NOW()');
        $this->save();
    }

    public function notify(StudentReg $user, $subject, $template, $params)
    {
        $transaction = null;
        if (Yii::app()->db->getCurrentTransaction() == null) {
            $transaction = Yii::app()->db->beginTransaction();
        }
        try {
            $message = new MessagesNotifications();
            $sender = new MailTransport();
            $sender->renderBodyTemplate($template, $params);
            $message->build($subject, $sender->template(), array($user), StudentReg::model()->findByPk(Yii::app()->user->getId()));
            $message->create();

            $message->send($sender);
            if ($transaction) {
                $transaction->commit();
            }
        } catch (Exception $e) {
            if ($transaction) {
                $transaction->rollback();
            }
            throw new \application\components\Exceptions\IntItaException(500, "Повідомлення не вдалося надіслати.");
        }
    }

    public static function isRequestOpen($params)
    {
        $agreement = $params['agreement'];
        $user = $params['user'];
        return count(MessagesWrittenAgreementRequest::model()->findAllByAttributes(
            array('id_agreement'=>$agreement,'id_user'=>$user,'status'=>MessagesWrittenAgreementRequest::NEW_REQUEST)
        ));
    }

    public static function getStatus($params)
    {
        $agreement = $params['agreement'];
        $user = $params['user'];

        if(MessagesWrittenAgreementRequest::model()->findByAttributes(array('id_user'=>$user,'id_agreement'=>$agreement,'status'=>self::APPROVED))){
            return self::APPROVED;
        }else if(MessagesWrittenAgreementRequest::model()->findByAttributes(array('id_user'=>$user,'id_agreement'=>$agreement,'status'=>null))) {
            return self::NEW_REQUEST;
        }else if(MessagesWrittenAgreementRequest::model()->findByAttributes(array('id_user'=>$user,'id_agreement'=>$agreement,'status'=>self::CANCELLED))) {
            return self::CANCELLED;
        }
        return 'empty';
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
        return "Запит на затвердження паперогво договору";
    }

    public function agreement()
    {
        return $this->id_agreement;
    }

    public function type()
    {
        return Request::USER_WRITTEN_AGREEMENTS_REQUEST;
    }

    public function subject()
    {
        return "Запит на затвердженння паперового договору";
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
        return $this->status == self::NEW_REQUEST;
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
        if ($this->status==MessagesWrittenAgreementRequest::CANCELLED) {
            return true;
        } else {
            return false;
        }
    }

    public function reject()
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->status = MessagesWrittenAgreementRequest::CANCELLED;
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

    public function saveAgreementPdf($content, $user, $agreement){
        $pdf = Yii::app()->ePdf->mpdf();
        $pdf->WriteHTML($content);

        if (!file_exists(Yii::app()->basePath . "/../files/documents/agreements/".$user)) {
            mkdir(Yii::app()->basePath . "/../files/documents/agreements/".$user);
        }

        $filename=Yii::getpathOfAlias('webroot').'/files/documents/agreements/'.$user.'/a'.$agreement.'.pdf';
        $pdf->Output($filename,'F');
    }

}