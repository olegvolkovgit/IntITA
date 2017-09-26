<?php

/**
 * This is the model class for table "mail_templates".
 *
 * The followings are the available columns in table 'mail_templates':
 * @property integer $id
 * @property string $title
 * @property string $subject
 * @property string $text
 * @property integer $active
 * @property integer $template_type
 * @property integer $organization_id
 * @property integer $parameters
 */
class MailTemplates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_templates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text', 'required'),
			array('active, template_type, organization_id', 'numerical', 'integerOnly'=>true),
			array('title, subject', 'length', 'max'=>255),
			array('parameters', 'type'),
			array('id, title, subject, text, active, parameters', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => 'Title',
            'subject' => 'Title',
			'text' => 'Text',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('subject',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailTemplates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
