<?php

/**
 * This is the model class for table "user_messages".
 *
 * The followings are the available columns in table 'user_messages':
 * @property integer $id_message
 * @property string $topic
 * @property string $subject
 *
 * The followings are the available model relations:
 * @property Messages $idMessage
 */
class UserMessages extends Messages implements IMessage
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_message, subject', 'required'),
			array('id_message', 'numerical', 'integerOnly'=>true),
			array('topic', 'length', 'max'=>255),
			// The following rule is used by search().
			array('id_message, topic, subject', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'topic' => 'Topic',
			'subject' => 'Subject',
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
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('subject',$this->subject,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function create(){

        $model->date = date("Y-m-d H:i:s");
        if($model->validate())
        {
            $model->save();
            Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0537"));
            $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
        } else {
            Yii::app()->user->setFlash('sendletter', Yii::t("letter", "0538"));
            $this->redirect(Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)));
        }

    }

    public function send(IMailSender $sender){

    }

    public function read(StudentReg $receiver){

    }

    public function deleteMessage(StudentReg $receiver){

    }

    public function reply(StudentReg $receiver){

    }

    public function sendOn(StudentReg $receiver){

    }

    protected function afterSave()
    {

        $addresse = StudentReg::model()->findByPk($this->messageReceivers)->email;

        $link = Yii::app()->createUrl('/studentreg/profile', array('idUser' => $this->addressee_id));

        $from = Yii::app()->user->name;

        $theme = "У Вас нове повідомлення на INTITA";

        $text = 'У Вас нове повідомлення на INTITA<br>'
            .'Від користувача '. $from . '<br>
            Ви зможете його переглянути <a href ='.$link.'>тут</a>';

        mail($addresse,$theme,$text);

        parent::afterSave();
    }
}
