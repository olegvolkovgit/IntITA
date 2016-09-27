<?php

/**
 * This is the model class for table "chat_room".
 *
 * The followings are the available columns in table 'chat_room':
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property integer $author_id
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property ChatUser $author
 * @property ChatUser[] $chatUsers
 * @property ChatUserLastRoomDate[] $chatUserLastRoomDates
 * @property ChatUserMessage[] $chatUserMessages
 */
class ChatRoom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chat_room';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, name, type', 'required'),
			array('active, author_id, type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, name, author_id, type', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'ChatUser', 'author_id'),
			'roomUsers' => array(self::HAS_MANY, 'ChatRoomUsers','rooms_from_users_id' ),
			//'userInRoom' => array(self::HAS_MANY, 'ChatUser', array('users_id'=>'id'), 'through' => 'roomUsers'),
			//'chatUsers' => array(self::BELONGS_TO, 'ChatUser', array('users_id'=>'id'), 'through' => 'ChatRoomUsers'),
//			'chatUserLastRoomDates' => array(self::HAS_MANY, 'ChatUserLastRoomDate', 'room_id'),
//			'chatUserMessages' => array(self::HAS_MANY, 'ChatUserMessage', 'room_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'name' => 'Name',
			'author_id' => 'Author',
			'type' => 'Type',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('active',$this->active);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ChatRoom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
