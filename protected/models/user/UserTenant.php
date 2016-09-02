<?php

/**
 * This is the model class for table "user_tenant".
 *
 * The followings are the available columns in table 'user_tenant':
 * @property integer $id
 * @property integer $chat_user_id
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property ChatUser $chatUser
 */
class UserTenant extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_tenant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date', 'required'),
			array('chat_user_id', 'numerical', 'integerOnly'=>true),
			array('end_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, chat_user_id, start_date, end_date', 'safe', 'on'=>'search'),
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
			'chatUser' => array(self::BELONGS_TO, 'ChatUser', 'chat_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'chat_user_id' => 'Chat User',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('chat_user_id',$this->chat_user_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserTenant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function tenantsList(){
        $sql = 'select u.id user, u.firstName, u.secondName, u.middleName, u.email, ut.start_date, ut.end_date  from user as u
                right join chat_user as cu on u.id = cu.intita_user_id
                right join user_tenant ut on ut.chat_user_id=cu.id';
        $tenants = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('rows' => array());

        foreach ($tenants as $record) {
            $row = array();
			$row["id"]=$record["user"];
            $row["name"] = trim($record["secondName"]." ".$record["firstName"]." ".$record["middleName"]);
            $row["email"] = $record["email"];
            $row["register"] = ($record["start_date"] > 0) ? date("d.m.Y",  strtotime($record["start_date"])):"невідомо";
            $row["cancelDate"] = ($record["end_date"]) ? date("d.m.Y", strtotime($record["end_date"])) : "";
            $row["profile"] = Config::getBaseUrl()."/profile/".$record["user"];
            $row["cancel"] = Yii::app()->createUrl('/_teacher/_admin/users/cancelRole');
            array_push($return['rows'], $row);
        }

        return json_encode($return);
	}
}
