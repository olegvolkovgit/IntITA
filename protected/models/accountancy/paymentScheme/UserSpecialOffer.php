<?php

/**
 * This is the model class for table "acc_user_special_offer_payment".
 *
 * The followings are the available columns in table 'acc_user_special_offer_payment':
 * @property integer $id
 * @property integer $id_template
 * @property integer $userId
 * @property integer $serviceId
 * @property integer $serviceType
 * @property string $startDate
 * @property string $endDate
 * @property integer $id_organization
 * @property integer $id_user_approved
 * @property string $approved_date
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
            array('userId, serviceId, id_template', 'required'),
            array('userId, serviceId', 'numerical', 'integerOnly' => true),
            array('id, id_template, userId, serviceId, serviceType, startDate, endDate, id_organization, id_user_approved, approved_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_template, userId, serviceId, serviceType, startDate, endDate, id_organization, id_user_approved, approved_date', 'safe', 'on' => 'search'),
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
            'schemes' => array(self::HAS_MANY, 'TemplateSchemes', ['id_template'=>'id_template'], 'order' => 'schemes.pay_count'),
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_template' => 'ID template',
            'userId' => 'User',
            'serviceId' => 'Id service',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'id_organization' => 'ID organization',
            'id_user_approved' => 'ID користувача, котрий призначив схему',
            'approved_date' => 'Дата призначення схеми',
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
        $criteria->compare('id_template', $this->id_template);
        $criteria->compare('userId', $this->userId);
        $criteria->compare('serviceId', $this->serviceId);
        $criteria->compare('startDate', $this->startDate, true);
        $criteria->compare('endDate', $this->endDate, true);
        $criteria->compare('id_organization', $this->id_organization, true);
        $criteria->compare('id_user_approved', $this->id_user_approved, true);
        $criteria->compare('approved_date', $this->approved_date, true);

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

        if (key_exists('schemeId', $params) && !empty($params['schemeId'])) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("id=" . $params["schemeId"]);
        }

        if (key_exists('user', $params) && !empty($params['user']) &&
            key_exists('service', $params) && !empty($params['service'])) {
            $criteria = new CDbCriteria();
            $criteria->addCondition("userId=" . $params["user"]->id);
            $criteria->addCondition("serviceId=" . $params['service']->service_id);
            $criteria->addCondition('NOW() BETWEEN startDate and endDate');
        }

        return $criteria;
    }

    protected function getTableScope() {
        return [
            'condition' => 'userId IS NOT NULL and serviceId IS NOT NULL'
        ];
    }
}
