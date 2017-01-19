<?php

/**
 * This is the model class for table "mailbox".
 *
 * The followings are the available columns in table 'mailbox':
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $maildir
 * @property string $quota
 * @property string $domain
 * @property string $rank
 * @property string $created
 * @property string $expired
 * @property integer $active
 */
class Mailbox extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

    public function getDbConnection(){
        return Yii::app()->dbMail   ;
    }

	public function tableName()
	{
		return 'mailbox';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active', 'numerical', 'integerOnly'=>true),
            array('username', 'unique','message'=>'Такий e-mail вже існує'),
			array('username, password, name, maildir, domain, rank', 'length', 'max'=>255),
			array('quota', 'length', 'max'=>20),
			array('created, expired', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username, password, name, maildir, quota, domain, rank, created, expired, active', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'maildir' => 'Maildir',
			'quota' => 'Quota',
			'domain' => 'Domain',
			'rank' => 'Rank',
			'created' => 'Created',
			'expired' => 'Expired',
			'active' => 'Active',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('maildir',$this->maildir,true);
		$criteria->compare('quota',$this->quota,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('rank',$this->rank,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('expired',$this->expired,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mailbox the static model class
	 */

	private function hashPassword($password){
        $cryptAgorythm = Yii::app()->params['dovecotPasswordScheme'];
        if (Yii::app()->params['dovecotPasswordScheme']=='sha')
            $cryptAgorythm = 'sha1';
        $salt = substr(sha1(rand()), 0, 16);
        return "{S".strtoupper(Yii::app()->params['dovecotPasswordScheme'])."}" . base64_encode(hash($cryptAgorythm, $password . $salt, true) . $salt);
    }

    public function setPassword($password){
        $this->password = $this->hashPassword($password);
        $this->save();
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
