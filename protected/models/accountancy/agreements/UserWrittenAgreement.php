<?php

/**
 * This is the model class for table "acc_user_written_agreement".
 *
 * The followings are the available columns in table 'acc_user_written_agreement':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_agreement
 * @property string $template_html
 * @property integer $checked_by_user
 * @property integer $checked
 * @property integer $checked_by
 * @property string $updatedAt
 * @property integer $actual
 * @property string $checked_date
 *
 * The followings are the available model relations:
 * @property UserAgreements $idAgreement
 * @property StudentReg $idUser
 */
class UserWrittenAgreement extends CActiveRecord
{
    const NOT_ACTUAL = 0;
    const ACTUAL = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'acc_user_written_agreement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_agreement', 'required'),
			array('id_user, id_agreement, checked_by_user, checked, checked_by, actual', 'numerical', 'integerOnly'=>true),
			array('template_html, checked_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, id_agreement, template_html, checked_by_user, checked, checked_by, updatedAt, actual, checked_date', 'safe', 'on'=>'search'),
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
			'idAgreement' => array(self::BELONGS_TO, 'AccUserAgreements', 'id_agreement'),
			'idUser' => array(self::BELONGS_TO, 'StudentReg', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_agreement' => 'Id Agreement',
			'template_html' => 'Template Html',
			'checked_by_user' => 'Checked By User',
			'checked' => 'Checked',
			'checked_by' => 'Checked By',
			'updatedAt' => 'Updated At',
			'actual' => 'Actual',
			'checked_date' => 'Checked Date',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_agreement',$this->id_agreement);
		$criteria->compare('template_html',$this->template_html,true);
		$criteria->compare('checked_by_user',$this->checked_by_user);
		$criteria->compare('checked',$this->checked);
		$criteria->compare('checked_by',$this->checked_by);
		$criteria->compare('updatedAt',$this->updatedAt,true);
		$criteria->compare('actual',$this->actual);
		$criteria->compare('checked_date',$this->checked_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserWrittenAgreement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
