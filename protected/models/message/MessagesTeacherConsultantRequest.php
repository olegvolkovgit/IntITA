<?php

/**
 * This is the model class for table "messages_teacher_consultant_request".
 *
 * The followings are the available columns in table 'messages_teacher_consultant_request':
 * @property integer $id_message
 * @property integer $id_module
 * @property integer $id_teacher
 * @property string $date_approved
 * @property integer $user_approved
 * @property integer $cancelled
 *
 * The followings are the available model relations:
 * @property Messages $message0
 * @property Module $idModule
 * @property StudentReg $idTeacher
 * @property StudentReg $userApproved
 */
class MessagesTeacherConsultantRequest extends Messages implements IMessage, IRequest
{
    private $template = 'teacher_consultant'. DIRECTORY_SEPARATOR . '_teacherConsultantModuleRequest';
    const TYPE = MessagesType::TEACHER_CONSULTANT_REQUEST;
    private $receivers = array();
    private $module;
    private $author;
    private $teacher;
    private $message;

    const DELETED = 1;
    const ACTIVE = 0;


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages_teacher_consultant_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_message, id_module, id_teacher', 'required'),
            array('id_message, id_module, id_teacher, user_approved, cancelled', 'numerical', 'integerOnly' => true),
            array('date_approved', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_message, id_module, id_teacher, date_approved, user_approved, cancelled', 'safe', 'on' => 'search'),
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
            'idModule' => array(self::BELONGS_TO, 'Module', 'id_module'),
            'idTeacher' => array(self::BELONGS_TO, 'StudentReg', 'id_teacher'),
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
            'id_module' => 'Id Module',
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
        $criteria->compare('id_module', $this->id_module);
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
     * @return MessagesTeacherConsultantRequest the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function primaryKey()
    {
        return 'id_message';
    }

    public function build(Module $module, StudentReg $user, StudentReg $teacher, $chained = null, $original = null)
    {
        //create and init parent model
        $this->message = new Messages();
        $this->message->buildMessage($user->id, self::TYPE, $chained, $original);

        $this->module = $module;
        $this->id_module = $module->module_ID;
        $this->id_teacher = $teacher->id;
        $this->author = $user;
        $this->teacher = $teacher;
        $this->receivers = MessageReceiver::requestsReceiversArray($module->id_organization);
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
        $sender->renderBodyTemplate($this->template, array($this->module, $this->author, $this->teacher));

        foreach ($this->receivers as $receiver) {
            if ($this->addReceiver($receiver)) {
                $sender->send($receiver->email, '', 'Запит на призначення викладача-консультанта', '');
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
        $criteria->addCondition('cancelled=' . MessagesTeacherConsultantRequest::ACTIVE);

        return MessagesTeacherConsultantRequest::model()->findAll($criteria);
    }

    public function setDeleted()
    {
        $user = RegisteredUser::userById($this->id_teacher);

        $this->cancelled = MessagesTeacherConsultantRequest::DELETED;
        if($this->save()){
            $this->message()->sender0->notify('teacher_consultant'. DIRECTORY_SEPARATOR . '_teacherConsultantRequestCancelled', array($user->registrationData),
                'Запит на призначення викладача відхилено');
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
        $user = RegisteredUser::userById($this->id_teacher);
        //add rights to edit module
        $role = new TeacherConsultant();
        if (!$role->checkModule($this->id_teacher, $this->id_module)) {
            if ($user->setRoleAttribute(UserRoles::TEACHER_CONSULTANT, 'module', $this->id_module)) {
                date_default_timezone_set(Config::getServerTimezone());
                //update current request, set approved status
                $this->user_approved = $userApprove->id;
                $this->date_approved = date("Y-m-d H:i:s");
                if ($this->save()) {
                    $this->message()->sender0->notify('teacher_consultant'. DIRECTORY_SEPARATOR . '_teacherConsultantApproved', array($user->registrationData),
                        'Запит на призначення викладача успішно підтверджено');
                    return "Запит успішно підтверджений.";
                }
            }
            return "Операцію не вдалося виконати";

        } else return "Обраний викладач вже призначений викладачем-консультантом по даному модулю.";
    }

    public function isRequestOpen($params)
    {
        $module = $params[0];
        $user = $params[1];
        return (Yii::app()->db->createCommand(array(
                'select' => 'count(*)',
                'from' => 'messages_teacher_consultant_request mr',
                'join' => 'LEFT JOIN messages m ON m.id = mr.id_message',
                'where' => 'mr.id_module=' . $module . ' and mr.id_teacher=' . $user . ' and cancelled=' . MessagesTeacherConsultantRequest::ACTIVE .
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
        return "Запит на призначення консультанта";
    }

    public function module()
    {
        return $this->idModule;
    }

    public function type()
    {
        return Request::TEACHER_CONSULTANT_REQUEST;
    }

    public function subject(){
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

    public function message(){
        return $this->message0;
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

    public function isRejected()
    {
        if ($this->cancelled && !$this->user_approved) {
            return true;
        } else {
            return false;
        }
    }

    public function reject()
    {
        date_default_timezone_set(Config::getServerTimezone());
        $this->cancelled = 1;
        if ($this->save()) {
            return "Операцію успішно виконано.";
        } else {
            return "Операцію не вдалося виконати.";
        }
    }

}
