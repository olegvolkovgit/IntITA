<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property string $create_date
 * @property integer $sender
 * @property integer $type
 * @property integer $draft
 * @property integer $chained_message_id
 * @property integer $original_message_id
 *
 * The followings are the available model relations:
 * @property StudentReg $sender0
 * @property UserMessages[] $userMessages
 * @property StudentReg[] $receivers0
 */

/* @TODO 28.11.16 Переписать к чертям все эти сообщения с наследованием, т.к. не совместимо с PHP7 */
class Messages extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sender, type, draft', 'required'),
            array('sender, type, draft, chained_message_id, original_message_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            array('id, create_date, sender, type, draft, chained_message_id, original_message_id', 'safe', 'on' => 'search'),
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
            'type0' => array(self::BELONGS_TO, 'MessagesType', 'type'),
            'sender0' => array(self::BELONGS_TO, 'StudentReg', 'sender'),
            'userMessages' => array(self::HAS_MANY, 'UserMessages', 'id_message'),
            'messageReceivers' => array(self::HAS_MANY, 'MessageReceiver', 'id_receiver'),
            'receivers0' => array(self::HAS_MANY, 'StudentReg', 'id_receiver', 'through' => 'messageReceivers'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'create_date' => 'Create Date',
            'sender' => 'Sender',
            'type' => 'Type',
            'draft' => 'Draft',
            'chained_message_id' => 'Chained Message',
            'original_message_id' => 'Original Message',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('sender', $this->sender);
        $criteria->compare('type', $this->type);
        $criteria->compare('draft', $this->draft);
        $criteria->compare('chained_message_id', $this->chained_message_id);
        $criteria->compare('original_message_id', $this->original_message_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function build($sender, $type, $chained = null, $original = null)
    {
        $this->sender = $sender;
        $this->type = $type;
        $this->draft = 1;
        $this->chained_message_id = $chained;
        $this->original_message_id = $original;
    }

    /**
     * @param $receiver receiver id
     * @return boolean
     */
    protected function addReceiver(StudentReg $receiver)
    {
        return Yii::app()->db->createCommand()->insert('message_receiver', array(
            'id_message' => $this->id_message,
            'id_receiver' => $receiver->id,
        ));
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setDraft($draft)
    {
        $this->draft = $draft;
    }

    public function setSender($id)
    {
        $this->sender = $id;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getId()
    {
        return $this->id;
    }

    public function forwarded()
    {
        return UserMessages::model()->findByPk($this->original_message_id);
    }

    public function getModel(){
        return $this;
    }

    public function accessForOrganization()
    {
        switch($this->type){
            case MessagesType::REVISION_REQUEST:
                return Yii::app()->user->model->hasAccessToOrganizationModel(MessagesRevisionRequest::model()->findByPk($this->id)->idRevision->module);
            case MessagesType::MODULE_REVISION_REQUEST:
                return Yii::app()->user->model->hasAccessToOrganizationModel(MessagesModuleRevisionRequest::model()->findByPk($this->id)->idRevision->module);
            case MessagesType::AUTHOR_REQUEST:
                return Yii::app()->user->model->hasAccessToOrganizationModel(MessagesAuthorRequest::model()->findByPk($this->id)->idModule);
            case MessagesType::TEACHER_CONSULTANT_REQUEST:
                return Yii::app()->user->model->hasAccessToOrganizationModel(MessagesTeacherConsultantRequest::model()->findByPk($this->id)->idModule);
            case MessagesType::COWORKER_REQUEST:
                throw new \application\components\Exceptions\IntItaException(403, 'Данний ти запиту не доступний для перегляду на данний час');
            default:
                return true;
        }
    }
}
