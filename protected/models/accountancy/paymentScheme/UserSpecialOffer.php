<?php

/**
 * This is the model class for table "acc_user_special_offer_payment".
 *
 * The followings are the available columns in table 'acc_user_special_offer_payment':
 * @property integer $id
 * @property integer $userId
 * @property integer $serviceId
 * @property string $discount
 * @property integer $payCount
 * @property string $loan
 * @property string $name
 * @property integer $monthpay
 * @property string $startDate
 * @property string $endDate
 *
 * @property Service $service
 */
class UserSpecialOffer extends ASpecialOffer {

    use WithGetSchemaCalculator;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userId, serviceId', 'required'),
            array('userId, payCount, monthpay', 'numerical', 'integerOnly' => true),
            array('discount, loan', 'length', 'max' => 10),
            array('name', 'length', 'max' => 512),
            array('startDate, endDate', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, userId, serviceId, discount, payCount, loan, name, monthpay, startDate, endDate', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
            'service' => [self::HAS_ONE, 'Service', '', 'on' => 't.serviceId = service.service_id'],
            'user' => [self::HAS_ONE, 'StudentReg', '', 'on' => 't.userId = user.id'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'userId' => 'User',
            'courseId' => 'Course',
            'moduleId' => 'Module',
            'discount' => 'Discount',
            'payCount' => 'Pay Count',
            'loan' => 'Loan',
            'name' => 'Name',
            'monthpay' => 'Monthpay',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('serviceId', $this->serviceId);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('payCount', $this->payCount);
        $criteria->compare('loan', $this->loan, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('monthpay', $this->monthpay);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('endDate', $this->endDate, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserSpecialOffer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function getConditionCriteria($params) {
        $criteria = null;

        if (key_exists('user', $params) && !empty($params['user'] && !$params['user']->isGuest) &&
            key_exists('service', $params) && !empty($params['service'])) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("userId=" . $params["user"]->getId());
            $criteria->addCondition("serviceId=" . $params['service']->service_id);
            $criteria->addCondition('NOW() BETWEEN startDate and endDate');
        }

        return $criteria;
    }

    protected function getTableScope() {
        return [
            'condition' => 'userId IS NOT NULL'
        ];
    }
}
