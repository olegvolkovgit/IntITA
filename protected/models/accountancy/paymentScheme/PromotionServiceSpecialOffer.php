<?php

/**
 * @property integer $id
 * @property integer $id_template
 * @property integer $serviceId
 * @property integer $serviceType
 * @property string $userId
 * @property string $startDate
 * @property string $endDate
 *
 */
class PromotionServiceSpecialOffer extends ASpecialOffer {

    use WithGetSchemaCalculator;

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_template', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_template, userId, serviceId, serviceType, startDate, endDate', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return [
			'schemes' => array(self::HAS_MANY, 'TemplateSchemes', ['id_template'=>'id_template'], 'order' => 'schemes.pay_count'),
        ];
	}

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_template' => 'ID template',
			'userId' => 'User',
			'serviceId' => 'Id service',
			'serviceType' => 'Service type',
			'startDate' => 'Start Date',
			'endDate' => 'End Date',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('id_template', $this->id_template);
		$criteria->compare('userId', $this->userId);
		$criteria->compare('serviceId', $this->serviceId);
		$criteria->compare('serviceType', $this->serviceType);
		$criteria->compare('startDate', $this->startDate, true);
		$criteria->compare('endDate', $this->endDate, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSpecialOffer the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    protected function getConditionCriteria($params) {
        $criteria = null;
		$id=null;

		if (isset($params['service']->course_id)) {
			$id=PaymentScheme::PROMOTIONAL_COURSE_SCHEME;
		} else if (isset($params['service']->module_id)) {
			$id=PaymentScheme::PROMOTIONAL_MODULE_SCHEME;
		}

		$criteria = $criteria ? $criteria : new CDbCriteria();
		$criteria->addCondition("id=" . $id);
		$criteria->addCondition('NOW() BETWEEN startDate and endDate');
		$criteria->order = 'startDate DESC';

        return $criteria;
    }

    protected function getTableScope() {
        return [
            'condition' => 'userId IS NULL AND serviceId IS NULL'
        ];
    }
}