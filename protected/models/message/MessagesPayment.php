<?php

/**
 * This is the model class for table "messages_payment".
 *
 * The followings are the available columns in table 'messages_payment':
 * @property integer $id_message
 * @property integer $operation
 */
class MessagesPayment extends CActiveRecord implements IMessage
{
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
			array('id_message, operation', 'required'),
			array('id_message, operation', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			array('id_message, operation', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_message' => 'Id Message',
			'operation' => 'Operation',
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
		$criteria->compare('operation',$this->operation);

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

    public function create(){

    }

    public function send(IMailSender $sender){

    }

    public function read(StudentReg $receiver){

    }

    public function deleteMessage(StudentReg $receiver){

    }

    public function reply(StudentReg $receiver){

    }

    public function forward(StudentReg $receiver){

    }
}
