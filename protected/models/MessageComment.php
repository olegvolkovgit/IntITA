<?php

/**
 * This is the model class for table "message_comment".
 *
 * The followings are the available columns in table 'translate_comment':
 * @property integer $message_code
 * @property string $comment
 */
class MessageComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			array('message_code, comment', 'safe', 'on'=>'search'),
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
			'message_code' => 'Message Code',
			'comment' => 'Comment',
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

		$criteria->compare('message_code',$this->message_code);
		$criteria->compare('t.comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MessageComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function addMessageCodeComment($code, $comment)
    {
        $model = new MessageComment();

        $model->message_code = $code;
        $model->comment = $comment;

        $model->save();
    }

    public static function updateMessageCodeComment($code, $comment)
    {
        if (MessageComment::model()->exists('message_code=:code', array(':code' => $code))){
            MessageComment::model()->updateByPk($code, array('comment' => $comment));
        } else{
            $model = new MessageComment();

            $model->message_code = $code;
            $model->comment = $comment;

            $model->save();
        }
    }

    public static function getMessageCommentById($code){
        if (MessageComment::model()->exists('message_code=:code', array(':code' => $code))){
            return CHtml::encode(MessageComment::model()->findByPk($code)->comment);
        } else {
            return '';
        }

    }
}
