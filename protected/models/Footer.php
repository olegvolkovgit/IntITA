<?php

/**
 * This is the model class for table "footer".
 *
 * The followings are the available columns in table 'footer':
 * @property integer $footer_id
 * @property string $image_social
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $image_up
 */
class Footer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'footer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_social, phone, mobile, email, image_up', 'required'),
			array('image_social, image_up', 'length', 'max'=>255),
			array('phone, mobile', 'length', 'max'=>40),
			array('email', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('footer_id, image_social, phone, mobile, email, image_up', 'safe', 'on'=>'search'),
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
			'footer_id' => 'Footer',
			'image_social' => 'Image Social',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'image_up' => 'Image Up',
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

		$criteria->compare('footer_id',$this->footer_id);
		$criteria->compare('image_social',Yii::app()->request->baseUrl.$this->image_social,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('image_up',Yii::app()->request->baseUrl.$this->image_up,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Footer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getEmail(){
        return Yii::t('footer', '0025');
    }

    public function getTel(){
        return Yii::t('footer', '0023');
    }

    public function getSkype(){
        return Yii::t('footer', '0026');
    }

    public function getMobile(){
        return Yii::t('footer', '0024');
    }
}
