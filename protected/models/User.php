<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $firstName
 * @property string $identity
 * @property string $network
 * @property integer $state
 * @property string $full_name
 * @property string $middleName
 * @property string $secondName
 * @property string $nickname
 * @property string $birthday
 * @property string $email
 * @property string $password
 * @property string $facebook
 * @property string $googleplus
 * @property string $linkedin
 * @property string $vkontakte
 * @property string $twitter
 * @property string $phone
 * @property string $hash
 * @property string $address
 * @property string $education
 * @property string $educform
 * @property string $interests
 * @property string $aboutUs
 * @property string $aboutMy
 * @property string $avatar
 * @property string $role
 * @property string $token
 * @property string $activkey_lifetime
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Lectures[] $lectures
 * @property Response[] $responses
 * @property Response[] $responses1
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName, identity, network, state, full_name, email, hash', 'required'),
			array('state, status', 'numerical', 'integerOnly'=>true),
			array('firstName, identity, network, full_name, middleName, secondName, nickname, email, password, facebook, googleplus, linkedin, vkontakte, twitter, education, aboutMy, avatar, role', 'length', 'max'=>255),
			array('birthday', 'length', 'max'=>11),
			array('phone', 'length', 'max'=>15),
			array('hash', 'length', 'max'=>20),
			array('educform', 'length', 'max'=>60),
			array('token', 'length', 'max'=>150),
			array('address, interests, aboutUs, activkey_lifetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, firstName, identity, network, state, full_name, middleName, secondName, nickname, birthday, email, password, facebook, googleplus, linkedin, vkontakte, twitter, phone, hash, address, education, educform, interests, aboutUs, aboutMy, avatar, role, token, activkey_lifetime, status', 'safe', 'on'=>'search'),
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
			'lectures' => array(self::MANY_MANY, 'Lectures', 'permissions(id_user, id_resource)'),
			'responses' => array(self::HAS_MANY, 'Response', 'who'),
			'responses1' => array(self::HAS_MANY, 'Response', 'about'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstName' => 'First Name',
			'identity' => 'Identity',
			'network' => 'Network',
			'state' => 'State',
			'full_name' => 'Full Name',
			'middleName' => 'Middle Name',
			'secondName' => 'Second Name',
			'nickname' => 'Nickname',
			'birthday' => 'Birthday',
			'email' => 'Email',
			'password' => 'Password',
			'facebook' => 'Facebook',
			'googleplus' => 'Googleplus',
			'linkedin' => 'Linkedin',
			'vkontakte' => 'Vkontakte',
			'twitter' => 'Twitter',
			'phone' => 'Phone',
			'hash' => 'Hash',
			'address' => 'Address',
			'education' => 'Education',
			'educform' => 'Educform',
			'interests' => 'Interests',
			'aboutUs' => 'About Us',
			'aboutMy' => 'About My',
			'avatar' => 'Avatar',
			'role' => 'Role',
			'token' => 'Token',
			'activkey_lifetime' => 'Activkey Lifetime',
			'status' => 'Status',
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
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('identity',$this->identity,true);
		$criteria->compare('network',$this->network,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('secondName',$this->secondName,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('googleplus',$this->googleplus,true);
		$criteria->compare('linkedin',$this->linkedin,true);
		$criteria->compare('vkontakte',$this->vkontakte,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('educform',$this->educform,true);
		$criteria->compare('interests',$this->interests,true);
		$criteria->compare('aboutUs',$this->aboutUs,true);
		$criteria->compare('aboutMy',$this->aboutMy,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('activkey_lifetime',$this->activkey_lifetime,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
